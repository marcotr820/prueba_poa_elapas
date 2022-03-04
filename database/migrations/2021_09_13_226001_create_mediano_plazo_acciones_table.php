<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedianoPlazoAccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediano_plazo_acciones', function (Blueprint $table) {
            $table->id();
            $table->string('accion_mediano_plazo');
            $table->unsignedBigInteger('resultado_id');
            $table->uuid('uuid')->unique()->index();
            $table->timestamps();

            $table->foreign('resultado_id')->references('id')->on('resultados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediano_plazo_acciones');
    }
}
