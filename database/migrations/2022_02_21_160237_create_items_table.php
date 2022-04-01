<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('discountable')->nullable();
            $table->string('item_code')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('company')->nullable();
            $table->string('category_id')->nullable();
            $table->string('category')->nullable();
            $table->string('item_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('suppliers_price')->nullable();
            $table->string('sellers_price')->nullable();
            $table->string('vat')->nullable();
            $table->string('stock')->nullable();
            $table->string('storage')->nullable();
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
        Schema::dropIfExists('items');
    }
}
