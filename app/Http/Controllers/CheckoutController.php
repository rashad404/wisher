<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $userProfile = UserProfile::where('user_id', $userId)->first();
        // dd($userProfile);
        $userEmail = auth()->user()->email;

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $this->calculateShipping($subtotal),
            'tax' => $this->calculateTax($subtotal),
            'total' => $this->calculateTotal($subtotal),
            'userProfile' => $userProfile,
            'userEmail' => $userEmail,
        ]);
    }


    private function calculateShipping($subtotal)
    {
        return $subtotal * 0.1;
    }

    private function calculateTax($subtotal)
    {
        return $subtotal * 0.07;
    }

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
    ]);

    $userId = auth()->id();
    $cartItems = Cart::where('user_id', $userId)->with('product')->get();
    $subtotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    $shipping = $this->calculateShipping($subtotal);
    $tax = $this->calculateTax($subtotal);
    $total = $this->calculateTotal($subtotal);

    // Create a new order record for each cart item
    foreach ($cartItems as $item) {
        \App\Models\Order::create([
            'user_id' => $userId,
            'payment_method' => $request->input('payment_method'),
            'email_address' => $request->input('email-address'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'region' => $request->input('region'),
            'postal_code' => $request->input('postal-code'),
            'subtotal' => $item->product->price * $item->quantity, // Set subtotal for individual item
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
            'product_id' => $item->product_id,
            'color_id' => $item->color_id,
            'size_id' => $item->size_id,
        ]);
    }

    // Optionally delete the cart items
    Cart::where('user_id', $userId)->delete();

    return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
}



    public function success()
    {
        return view('cart.success');
    }
}
