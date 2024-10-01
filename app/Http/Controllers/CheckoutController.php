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


    // Need to fix
    private function calculateShipping($subtotal)
    {
        return $subtotal * 0.1; // 10% shipping cost
    }

    // Need to fix
    private function calculateTax($subtotal)
    {
        return $subtotal * 0.07; // 7% tax
    }

    // Need to fix
    private function calculateTotal($subtotal)
    {
        return $subtotal + $this->calculateShipping($subtotal) + $this->calculateTax($subtotal);
    }

    public function processPayment(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'payment_method' => 'required|string',
            'email-address' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'postal-code' => 'required|string',
            'contact_id' => 'nullable|exists:user_profiles,id',
        ]);

        $userId = auth()->id();
        $userProfile = UserProfile::where('user_id', $userId)->first();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = $this->calculateShipping($subtotal);
        $tax = $this->calculateTax($subtotal);
        $total = $this->calculateTotal($subtotal);

        // Generate a unique order number for all cart items in the same order
        $orderNumber = Str::uuid();

        // Use the contact ID if provided, else use the user's profile information
        $contactId = $request->input('contact_id');
        $orderAddress = $contactId ? UserProfile::find($contactId) : $userProfile; // Use user profile if no contact is selected

        foreach ($cartItems as $item) {
            // Calculate individual item subtotal
            $itemSubtotal = $item->product->price * $item->quantity;

            // Calculate proportional shipping and tax
            $itemShipping = $shipping * ($itemSubtotal / $subtotal);
            $itemTax = $tax * ($itemSubtotal / $subtotal);
            $itemTotal = $itemSubtotal + $itemShipping + $itemTax;

            Order::create([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'payment_method' => $request->input('payment_method'),
                'email_address' => $contactId ? $orderAddress->email : $request->input('email-address'),
                'address' => $contactId ? $orderAddress->address : $request->input('address'),
                'city' => $contactId ? $orderAddress->city : $request->input('city'),
                'region' => $contactId ? $orderAddress->region : $request->input('region'),
                'postal_code' => $contactId ? $orderAddress->postal_code : $request->input('postal-code'),
                'subtotal' => $itemSubtotal,
                'shipping' => $itemShipping,
                'tax' => $itemTax,
                'total' => $itemTotal,
                'product_id' => $item->product_id,
                'color_id' => $item->color_id,
                'size_id' => $item->size_id,
                'quantity' => $item->quantity,
            ]);
        }

        // Optionally delete the cart items
        Cart::where('user_id', $userId)->delete();

        // Update the session cart count
        session(['cart_count' => 0]);

        return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
    }

    public function success()
    {
        return view('cart.success');
    }
}
