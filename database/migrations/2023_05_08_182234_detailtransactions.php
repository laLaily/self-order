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
        Schema::create("detailtransactions", function (Blueprint $table) {
            $table->bigInteger("transactionId")->unsigned();
            $table->bigInteger("productId")->unsigned();
            $table->integer("quantity");
            $table->integer("quantityPrice");

            $table->primary(["transactionId", "productId"]);

            $table->foreign("transactionId")->references("id")->on("transactions");
            $table->foreign("productId")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailtransactions');
    }
};
