<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable(); // pending - sold - returned
            $table->string('transaction_code')->nullable();
            $table->string('item_code')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('company')->nullable();
            $table->string('category')->nullable();
            $table->string('item_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('quantity')->nullable();
            $table->string('suppliers_price')->nullable();
            $table->string('sellers_price')->nullable();
            $table->string('supplier_total')->nullable();
            $table->string('seller_total')->nullable();
            $table->string('discount')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_name_number')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
