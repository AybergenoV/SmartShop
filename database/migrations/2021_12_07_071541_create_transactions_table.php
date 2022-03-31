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
            $table->string('title')->nullable();
            $table->foreignId('basket_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->integer('count')->nullable();
            $table->double('price')->nullable();
            $table->double('card')->nullable();
            $table->double('cash')->nullable();
            $table->double('debt')->nullable();
            $table->string('from_whom')->nullable();
            $table->foreignId('from_id')->nullable();
            $table->string('to_whom')->nullable();
            $table->foreignId('to_id')->nullable();
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
