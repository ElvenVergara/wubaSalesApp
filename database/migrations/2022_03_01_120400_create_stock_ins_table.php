<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();
            $table->string('po_id')->nullable();
            $table->string('company')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('issued_by')->nullable();
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
        Schema::dropIfExists('stock_ins');
    }
}
