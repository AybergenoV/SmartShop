<?php

use App\Models\Consumption_category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumptionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumption_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Consumption_category::upsert([
            ['name'=> 'Boshqalar'],
            ['name'=> 'Ma\'muriy xarajatlar'],
            ['name'=> 'Ijara to\'lovlari'],
            ['name'=> 'Oylik'],
            ['name'=> 'Investitsiyalar'],
            ['name'=> 'Idora'],
            ['name'=> 'Soliqlar'],
            ['name'=> 'Uy xarajatlari']
        ],['name']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumption_categories');
    }
}
