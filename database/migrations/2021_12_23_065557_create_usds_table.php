<?php

use App\Models\usd;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usds', function (Blueprint $table) {
            $table->id();
            $table->double('usd');
            $table->timestamps();
        });
        // $http = Http::get("https://nbu.uz/uz/exchange-rates/json/")->collect()->where('code', 'USD')->first()['cb_price'];
        usd::create([
            'usd'=> $http ?? 10800
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usds');
    }
}
