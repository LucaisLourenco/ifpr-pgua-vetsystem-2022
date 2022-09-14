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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf')->unique();
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->string('email')->unique();
            $table->dateTime('data_nascimento');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('ativo');
            $table->rememberToken();
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
        Schema::dropIfExists('clientes');
    }
};
