<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitulairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('matricule')->index()->unsigned();
            $table->bigInteger('classe')->index()->unsigned();
            $table->foreign('matricule')->references('id')->on('matricules')->onDelete('cascade');
            $table->foreign('classe')->references('id')->on('classes')->onDelete('cascade');
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
        Schema::dropIfExists('titulaires');
    }
}
