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
        Schema::create('veterinario_telefones', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('numero');
            $table->unsignedBigInteger('veterinario_id');
            $table->foreign('veterinario_id')->references('id')->on('veterinarios');
            $table->softDeletes();
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
        Schema::dropIfExists('veterinario_telefones');
    }
};
