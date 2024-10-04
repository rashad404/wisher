<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('order_number');
            $table->string('payment_method');
            $table->string('email_address');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->json('contact_ids')->nullable();
            $table->json('shipping_addresses')->nullable();
            $table->json('notes')->nullable();

            // New date fields for delivery time
            $table->date('delivery_date')->nullable(); // The selected delivery date, if "Send Later" was chosen
            $table->timestamp('delivered_at')->nullable(); // Timestamp when the order was actually delivered

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
