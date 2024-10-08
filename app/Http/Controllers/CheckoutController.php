<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
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
        $contacts = Contact::where('user_id', $userId)->first();
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
        // dd($request->all());

        // Initialize the delivery date as null
        $deliveryDate = null;

        // Validate the request based on the tab (Me or Contact)
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
            'delivery_time_contact' => 'required_if:tab,contact|string|in:now,later',
            'delivery_date_contact' => 'nullable|date|required_if:delivery_time_contact,later',
        ]);

        $userId = auth()->id();
        $orderNumber = 'ORD-' . uniqid();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        // If the cart is empty, redirect back with an error
        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors('Your cart is empty.');
        }

        // Calculate costs
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $shipping = $this->calculateShipping($subtotal);
        $tax = $this->calculateTax($subtotal);
        $total = $this->calculateTotal($subtotal);

        // Initialize shipping address and notes arrays
        $shippingAddresses = [];
        $notes = [];
        $contactIds = [];
        $postalCodeKey = $request->has('postal-code') ? 'postal-code' : 'postal_code';

        // Handle the "Me" tab
        if ($validatedData['tab'] === 'me') {
            // Save the shipping address for the user ("me")
            $shippingAddresses['me'] = [
                'address' => $validatedData['address']['me'],
                'city' => $validatedData['city']['me'],
                'region' => $validatedData['region']['me'],
                'postal_code' => $validatedData[$postalCodeKey]['me'],
            ];
            $notes['me'] = $request->input('notes.me');
        }

        // Handle the "Contact" tab
        if ($validatedData['tab'] === 'contact') {
            // Handle contacts and their shipping addresses
            foreach ($validatedData['contacts'] as $contactId) {
                // Ensure the contact has a valid shipping address
                if (isset($validatedData['address'][$contactId])) {
                    $shippingAddresses[$contactId] = [
                        'address' => $validatedData['address'][$contactId],
                        'city' => $validatedData['city'][$contactId],
                        'region' => $validatedData['region'][$contactId],
                        'postal_code' => $validatedData[$postalCodeKey][$contactId] ?? null,
                    ];
                    $notes[$contactId] = $request->input("notes.$contactId");
                    $contactIds[] = $contactId;
                } else {
                    Log::warning("Missing address data for contact ID: $contactId");
                }
            }

            // Handle the delivery date if "Send Later" is selected
            if ($validatedData['delivery_time_contact'] === 'later') {
                $deliveryDate = $validatedData['delivery_date_contact']; // Use the selected delivery date
            } else {
                $deliveryDate = now(); // If "Send Now" is selected, set the current date as delivery date
            }
        }

        // Process each item in the cart and create the order
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
                'contact_ids' => json_encode($contactIds), // Store contact IDs as JSON
                'shipping_addresses' => json_encode($shippingAddresses), // Store all shipping addresses as JSON
                'notes' => json_encode($notes), // Store any notes as JSON
                'delivery_date' => $deliveryDate, // Store delivery date if applicable
            ]);
        }

        // Clear the cart after a successful order placement
        Cart::where('user_id', $userId)->delete();

        // Update session cart count to 0
        session(['cart_count' => 0]);

        // Redirect to success page
        return redirect()->route('checkout.success')->with('success', 'Order placed successfully.');
    }

    public function success()
    {
        return view('cart.success');
    }

    public function searchContacts(Request $request)
    {
        $query = $request->input('term');
        $userId = auth()->id();

        Log::info('Search query: ' . $query);
        Log::info('User ID: ' . $userId);

        $contacts = Contact::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'name', 'email', 'phone_number', 'address']);

        Log::info('Search results: ' . $contacts);

        return response()->json($contacts);
    }
}
