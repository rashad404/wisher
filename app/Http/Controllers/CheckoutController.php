<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $userProfile = UserProfile::where('user_id', $userId)->first();
        $userEmail = auth()->user()->email;

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Fetch contacts associated with the user
        $contacts = UserProfile::where('user_id', '!=', $userId)->get();

        return view('cart.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $this->calculateShipping($subtotal),
            'tax' => $this->calculateTax($subtotal),
            'total' => $this->calculateTotal($subtotal),
            'userProfile' => $userProfile,
            'userEmail' => $userEmail,
            'contacts' => $contacts,
        ]);
    }

    private function calculateShipping($subtotal)
    {
        return $subtotal * 0.1; // 10% shipping cost
    }

    private function calculateTax($subtotal)
    {
        return $subtotal * 0.07; // 7% tax
    }

    private function calculateTotal($subtotal)
    {
        return $subtotal + $this->calculateShipping($subtotal) + $this->calculateTax($subtotal);
    }

    public function processPayment(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'payment_method' => 'required|string',
            'email-address' => 'required|email',
            'address' => 'required|array',
            'city' => 'required|array',
            'region' => 'required|array',
            'postal_code' => 'required|array',
            'contacts' => 'required|array',
            'notes' => 'array',
            'notes.*' => 'string|nullable', // Make sure notes can be nullable
        ]);

        $userId = auth()->id();
        $orderNumber = 'ORD-' . uniqid(); // Generate a unique order number
        $subtotal = 0; // Initialize subtotal
        $cartItems = Cart::where('user_id', $userId)->get(); // Fetch cart items

        // Check if the cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors('Your cart is empty.');
        }

        // Calculate subtotal
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        $contacts = $request->input('contacts');
        $contactIds = [];

        foreach ($contacts as $contactId) {
            // Retrieve address details based on the contact ID
            $orderAddress = [
                'address' => $request->input('address')[$contactId] ?? null,
                'city' => $request->input('city')[$contactId] ?? null,
                'region' => $request->input('region')[$contactId] ?? null,
                'postal_code' => $request->input('postal_code')[$contactId] ?? null,
            ];

            // Check for null values in order address fields
            if (in_array(null, $orderAddress, true)) {
                return redirect()->back()->withErrors('Please provide all address fields for selected contacts.');
            }

            // Add the contact ID to the array
            $contactIds[] = $contactId;

            // Retrieve the note for this contact
            $note = $request->input('notes')[$contactId] ?? null;

            // Create the order for each item in the cart
            foreach ($cartItems as $item) {
                // Create order for each cart item
                Order::create([
                    'user_id' => $userId,
                    'order_number' => $orderNumber,
                    'payment_method' => $validatedData['payment_method'],
                    'email_address' => $validatedData['email-address'],
                    'address' => $orderAddress['address'],
                    'city' => $orderAddress['city'],
                    'region' => $orderAddress['region'],
                    'postal_code' => $orderAddress['postal_code'],
                    'subtotal' => $item->product->price * $item->quantity, // Item subtotal
                    'shipping' => $this->calculateShipping($subtotal), // Calculate shipping
                    'tax' => $this->calculateTax($subtotal), // Calculate tax
                    'total' => $this->calculateTotal($subtotal), // Calculate total
                    'product_id' => $item->product_id,
                    'color_id' => $item->color_id,
                    'size_id' => $item->size_id,
                    'quantity' => $item->quantity,
                    'contact_ids' => json_encode($contactIds),
                    'notes' => $note, // Save the note for the order
                ]);
            }
        }

        // Clear the cart after successful payment processing
        Cart::where('user_id', $userId)->delete();

        // Update the session cart count
        session(['cart_count' => 0]);

        return redirect()->route('checkout.success')->with('success', 'Order placed successfully.');
    }

    public function success()
    {
        return view('cart.success');
    }
}
