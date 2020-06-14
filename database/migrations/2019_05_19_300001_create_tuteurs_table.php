<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuteurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('matricule')->index()->unsigned();
            $table->string('cni',30);
            $table->string('nom')->default('parent');
            $table->string('numero')->nullable();
            $table->string('photo')->nullable();
            $table->string('adresse')->nullable();
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
        Schema::dropIfExists('tuteurs');
    }
}
