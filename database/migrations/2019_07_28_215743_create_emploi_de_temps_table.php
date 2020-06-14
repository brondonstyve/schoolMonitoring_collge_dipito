<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploiDeTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emploi_de_temps', function (Blueprint $table) {
            $table->integer('disponibilite')->index()->unsigned();
            $table->integer('compte')->index()->unsigned();
            $table->string('classe',10);
            $table->string('jour',10);
            $table->string('matiere',30);
            $table->tinyInteger('tranche')->default(0);
            $table->timestamps();
            $table->foreign('disponibilite')->references('id')->on('disponibilites')->onDelete('cascade');
            $table->foreign('compte')->references('id')->on('comptes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emploi_de_temps');
    }
}
