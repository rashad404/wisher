<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['status' => 'Pending', 'description' => 'Order is placed but not yet processed.'],
            ['status' => 'Processing', 'description' => 'Payment has been confirmed, and the order is being prepared.'],
            ['status' => 'Shipped', 'description' => 'Order has been dispatched to the shipping provider.'],
            ['status' => 'Delivered', 'description' => 'Order has been delivered to the customer.'],
            ['status' => 'Completed', 'description' => 'The order is fully completed and closed.'],
            ['status' => 'Cancelled', 'description' => 'Order was cancelled before shipping.'],
            ['status' => 'Failed', 'description' => 'Payment or processing failed.'],
            ['status' => 'Refunded', 'description' => 'Payment was refunded to the customer.'],
            ['status' => 'On Hold', 'description' => 'Order is temporarily on hold for any reason (e.g., awaiting payment or customer confirmation).'],
        ];

        foreach ($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}
