<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Calculate the total number of items in the cart
        $cartCount = $cartItems->sum('quantity');

        // Pass the data to the view
        return view('cart.index', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $this->calculateShipping($subtotal),
            'tax' => $this->calculateTax($subtotal),
            'total' => $this->calculateTotal($subtotal),
            'cartCount' => $cartCount,
        ]);
    }


    // Need to fix
    private function calculateShipping($subtotal)
    {
        return $subtotal * 0.1;
    }

    // Need to fix
    private function calculateTax($subtotal)
    {
        return $subtotal * 0.07;
    }

    // Need to fix
    private function calculateTotal($subtotal)
    {
        return $subtotal + $this->calculateShipping($subtotal) + $this->calculateTax($subtotal);
    }

    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->where('color_id', $request->color_id)
                    ->where('size_id', $request->size_id)
                    ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity
            ]);
        }

        // Update the session cart count
        $total = Cart::where('user_id', Auth::id())->sum('quantity');
        session(['cart_count' => $total]);

        return back()->with('success', 'Product added to cart.');
    }


    public function removeFromCart(Request $request, $itemId)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $itemId)->first();

        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Product not found in cart.'); // Check if this gets hit for the first item
        }

        $cartItem->delete();

        // Update the session cart count
        $total = Cart::where('user_id', Auth::id())->sum('quantity');
        session(['cart_count' => $total]);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
        ]);

        foreach ($request->quantity as $itemId => $quantity) {
            $cartItem = Cart::where('id', $itemId)->where('user_id', Auth::id())->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        // Update the session cart count
        $total = Cart::where('user_id', Auth::id())->sum('quantity');
        session(['cart_count' => $total]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }


}
