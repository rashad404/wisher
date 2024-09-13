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

        // Pass the data to the view
        return view('cart.index', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $this->calculateShipping($subtotal),
            'tax' => $this->calculateTax($subtotal),
            'total' => $this->calculateTotal($subtotal),
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

        $total = Cart::where('user_id', Auth::id())->sum('quantity');

        return back()->with('success', 'Product added to cart.');
    }

    public function removeFromCart(Request $request, $itemId)
    {
        // dd($itemId);

        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($itemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function updateCart(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
        ]);

        // Loop through the quantities provided in the request
        foreach ($request->quantity as $itemId => $quantity) {
            // Find the cart item for the authenticated user
            $cartItem = Cart::where('id', $itemId)->where('user_id', Auth::id())->first();

            // If the cart item exists, update its quantity
            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        // Redirect back to the cart index with a success message
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

}
