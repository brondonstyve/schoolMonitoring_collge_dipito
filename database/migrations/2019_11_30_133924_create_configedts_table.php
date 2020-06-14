<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigedtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configedts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tranche');
            $table->string('libelle');
            $table->string('hd');
            $table->string('hf');
            $table->integer('nbreTranche');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configedts');
    }
}
