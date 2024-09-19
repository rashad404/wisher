<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('product')
            ->get()
            ->groupBy('order_number');

        return view('orders.index', compact('orders'));
    }
}
