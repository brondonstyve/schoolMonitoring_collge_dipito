<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupeMatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_mats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nom');
            $table->bigInteger('filiere')->index()->unsigned();
            $table->foreign('filiere')->references('id')->on('filieres')->onDelete('cascade');
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
        Schema::dropIfExists('groupe_mats');
    }
}
