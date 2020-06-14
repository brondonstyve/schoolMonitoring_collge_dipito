<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoratoiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moratoires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('matricule')->index()->unsigned();
            $table->string('date');
            $table->string('tranche');
            $table->string('classe');
            $table->foreign('matricule')->references('id')->on('matricules')->onDelete('cascade');
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
        Schema::dropIfExists('moratoires');
    }
}
