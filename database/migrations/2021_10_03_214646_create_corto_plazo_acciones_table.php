<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCortoPlazoAccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corto_plazo_acciones', function (Blueprint $table) {
            $table->id();
            $table->string('gestion', 4);
            $table->string('accion_corto_plazo');
            $table->integer('resultado_esperado');
            $table->float('presupuesto_programado', 10, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('status', [0, 1, 2, 3, 4])->default(1);

            $table->unsignedBigInteger('trabajador_id');
            $table->unsignedBigInteger('pei_objetivo_especifico_id');
            $table->uuid('uuid')->unique()->index();

            $table->foreign('trabajador_id')->references('id')->on('trabajadores');
            $table->foreign('pei_objetivo_especifico_id')->references('id')->on('pei_objetivos_especificos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corto_plazo_acciones');
    }
}
