<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('amout');
            $table->string('contact');
            $table->string('document');
            $table->string('tipo');
            $table->string('token')->unique()->nullable();
            $table->string('sesion')->unique()->nullable();
         //   $table->unsignedBigInteger('user_id');
         //   $table->foreign('user_id')->references('id')->on('users'); // clave foranea
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
        Schema::dropIfExists('wallets');
    }
}
