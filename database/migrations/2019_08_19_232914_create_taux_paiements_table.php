<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTauxPaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taux_paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('filiere')->index()->unsigned();
            $table->string('niveau');
            $table->string('libelle');
            $table->double('montant');
            $table->double('penalite');
            $table->date('date');
            $table->foreign('filiere')->references('id')->on('filieres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taux_paiements');
    }
}
