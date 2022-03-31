<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->double('cost_price');
            $table->string('image')->default("product.png");
            $table->double('price_wholesale')->default(0);
            $table->double('price_max')->default(0);
            $table->double('price_min')->default(0);
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
        Schema::dropIfExists('prodacts');
    }
}
