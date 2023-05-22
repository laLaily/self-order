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
            $table->foreignId("customerId")->constrained('customers');
            $table->foreignId("cashierId")->nullable()->constrained('cashiers');
            $table->timestamp("transactionDate")->useCurrent();
            $table->integer("subtotal")->default(0);
            $table->integer("tax")->default(0);
            $table->integer("totalPrice")->default(0);
            $table->enum("status", ['In progress', 'Success'])->default('in progress');
            $table->string("paymentCode")->nullable();
            $table->timestamp("updatedAt")->useCurrent();
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
