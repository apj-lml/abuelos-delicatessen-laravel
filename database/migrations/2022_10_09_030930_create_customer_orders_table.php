<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('customer_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->string('product_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->string('email');
            $table->string('contact_no');
            $table->string('shipping_address');
            $table->integer('order_qty');
            $table->string('amount');
            $table->string('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('order_status')->default('Pending');
            $table->string('invoice_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_orders');
    }
}
