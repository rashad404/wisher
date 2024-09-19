<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // To generate unique order numbers
use Illuminate\Support\Facades\Log; // For logging

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
        ]);

        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = $this->calculateShipping($subtotal);
        $tax = $this->calculateTax($subtotal);
        $total = $this->calculateTotal($subtotal);

        // Generate a unique order number for all cart items in the same order
        $orderNumber = Str::uuid();

        foreach ($cartItems as $item) {
            // Calculate individual item subtotal
            $itemSubtotal = $item->product->price * $item->quantity;

            // The shipping and tax for each item are allocated as follows:
            // Shipping and tax should be based on the item's subtotal relative to the overall subtotal
            $itemShipping = $shipping * ($itemSubtotal / $subtotal); // Proportional shipping
            $itemTax = $tax * ($itemSubtotal / $subtotal); // Proportional tax
            $itemTotal = $itemSubtotal + $itemShipping + $itemTax; // Total for this specific item

            Order::create([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'payment_method' => $request->input('payment_method'),
                'email_address' => $request->input('email-address'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'region' => $request->input('region'),
                'postal_code' => $request->input('postal-code'),
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

        return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
    }

    public function success()
    {
        return view('cart.success');
    }
}
