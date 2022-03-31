<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['seller', 'admin', 'ceo'])->default('seller');
            $table->string('phone', 14)->nullable();
            $table->string('name');
            $table->string('pincode');
            $table->double('salary')->nullable();
            $table->double('flex')->nullable();
            $table->timestamps();
        });

        Admin::create([
            'name'=>'salawat',
            'phone'=> '+998906622939',
            'role'=> 'admin',
            'pincode'=>md5(1234),
        ]);
        Admin::create([
            'name'=>'Saliq',
            'pincode'=>md5(12344),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
