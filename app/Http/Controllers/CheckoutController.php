<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\UserProfile;
use Illuminate\Http\Request;
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
            'tab' => 'required|in:me,contact',
            'address' => 'required|array',
            'city' => 'required|array',
            'region' => 'required|array',
            'postal-code' => 'required_without:postal_code|array',
            'postal_code' => 'required_without:postal-code|array',
            'contacts' => 'required_if:tab,contact|array',
            'notes' => 'array',
            'notes.*' => 'string|nullable',
        ]);

        $userId = auth()->id();
        $orderNumber = 'ORD-' . uniqid();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors('Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = $this->calculateShipping($subtotal);
        $tax = $this->calculateTax($subtotal);
        $total = $this->calculateTotal($subtotal);

        $shippingAddresses = [];
        $notes = [];

        // Determine which postal code key is being used
        $postalCodeKey = $request->has('postal-code') ? 'postal-code' : 'postal_code';

        if ($validatedData['tab'] === 'me') {
            $shippingAddresses['me'] = [
                'address' => $validatedData['address']['me'],
                'city' => $validatedData['city']['me'],
                'region' => $validatedData['region']['me'],
                'postal_code' => $validatedData[$postalCodeKey]['me'],
            ];
            $notes['me'] = $request->input('notes.me');
        } else {
            // Debug: Log the contacts and address data
            Log::info('Contacts:', $validatedData['contacts']);
            Log::info('Address data:', $validatedData['address']);

            foreach ($validatedData['contacts'] as $contactId) {
                // Check if we have address data for this contact
                if (isset($validatedData['address'][$contactId])) {
                    $shippingAddresses[$contactId] = [
                        'address' => $validatedData['address'][$contactId],
                        'city' => $validatedData['city'][$contactId],
                        'region' => $validatedData['region'][$contactId],
                        'postal_code' => $validatedData[$postalCodeKey][$contactId] ?? null,
                    ];
                    $notes[$contactId] = $request->input("notes.$contactId");
                } else {
                    // Log a warning if we're missing data for a contact
                    Log::warning("Missing address data for contact ID: $contactId");
                }
            }
        }

        // Debug: Log the final shipping addresses
        Log::info('Final shipping addresses:', $shippingAddresses);

        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'payment_method' => $validatedData['payment_method'],
                'email_address' => $validatedData['email-address'],
                'subtotal' => $item->product->price * $item->quantity,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'product_id' => $item->product_id,
                'color_id' => $item->color_id,
                'size_id' => $item->size_id,
                'quantity' => $item->quantity,
                'contact_ids' => $validatedData['tab'] === 'me' ? null : json_encode(array_keys($shippingAddresses)),
                'shipping_addresses' => json_encode($shippingAddresses),
                'notes' => json_encode($notes),
            ]);
        }

        // Clear the cart after successful payment processing
        Cart::where('user_id', $userId)->delete();

        // Update the session cart count
        session(['cart_count' => 0]);

        // Redirect to success route with a success message
        return redirect()->route('checkout.success')->with('success', 'Order placed successfully.');
    }

    public function success()
    {
        return view('cart.success');
    }
}
