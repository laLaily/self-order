<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("transactions", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("customerId")->unsigned();
            $table->timestamp("transactionDate")->useCurrent();
            $table->integer("subtotal")->default(0);
            $table->integer("tax")->default(0);
            $table->integer("totalPrice")->default(0);
            $table->enum("status", ['in progress', 'success'])->default('in progress');
            $table->string("paymentCode")->nullable();

            $table->foreign("customerId")->references("id")->on("customers");
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
};
