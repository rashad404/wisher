<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Paginate orders by 10 per page
        $orders = Order::where('user_id', auth()->id())
            ->with('product')
            ->paginate(10); // 10 orders per page

        // Group the paginated items by 'order_number'
        $groupedOrders = $orders->getCollection()->groupBy('order_number');

        // Replace the paginated collection with the grouped collection
        $orders->setCollection($groupedOrders);

        return view('orders.index', compact('orders'));
    }
}
