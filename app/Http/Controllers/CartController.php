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
        // Fetch all cart items for the authenticated user
        $cartItems = Cart::where('user_id', Auth::id())->with('product', 'color', 'size')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        // Validate the form data
        $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Check if the product is already in the cart
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->where('color_id', $request->color_id)
                    ->where('size_id', $request->size_id)
                    ->first();

        if ($cart) {
            // If product exists, increase the quantity
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            // Add new product to cart
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity
            ]);
        }

        // Calculate the updated cart total
        $total = Cart::where('user_id', Auth::id())->sum('quantity'); // Adjust as needed

        // Store the total in the session
        session(['cartTotal' => $total]);

        // Redirect back to the previous page
        return back()->with('success', 'Product added to cart.');
    }

    public function updateCart(Request $request, $cartId)
    {
        $cart = Cart::find($cartId);
        $cart->quantity = $request->quantity; // Update the quantity
        $cart->save();

        return redirect()->route('cart.index');
    }

    public function removeFromCart($cartId)
    {
        $cart = Cart::find($cartId);
        $cart->delete(); // Remove item from cart

        return redirect()->route('cart.index');
    }

    public function getCartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return $cartCount;
    }
}
