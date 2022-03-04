<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_meta');
            $table->enum('status', [0, 1])->default(1);
            $table->uuid('uuid')->unique()->index();
            $table->timestamps();
            $table->unsignedBigInteger('pilar_id');

            $table->foreign('pilar_id')->references('id')->on('pilares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metas');
    }
}
