<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_o_s', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('company')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('suppliers_price')->nullable();
            $table->string('total')->nullable();
            $table->string('payment_terms')->nullable();
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
        Schema::dropIfExists('p_o_s');
    }
}
