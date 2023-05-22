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
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table->enum("productCategory", ["Beverage", "Food"]);
            $table->string("productName");
            $table->integer("productPrice");
            $table->integer("productStock");
            $table->timestamp("updatedAt")->nullable();
            $table->foreignId("updaterId")->nullable()->constrained("cashiers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
