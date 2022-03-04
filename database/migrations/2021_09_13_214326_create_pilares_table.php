<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilares', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pilar');
            $table->string('gestion_pilar');
            $table->enum('status', [0, 1])->default(1);
            $table->uuid('uuid')->unique()->index();
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
        Schema::dropIfExists('pilares');
    }
}
