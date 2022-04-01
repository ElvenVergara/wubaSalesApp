<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable(); // Pending - Paid(Locked)
            $table->string('transaction_code')->nullable();
            $table->string('number_of_items')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('user_id')->nullable();
            $table->string('issued_by')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
