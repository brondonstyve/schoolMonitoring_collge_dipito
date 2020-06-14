<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule',200)->nullable();
            $table->string('nom',50);
            $table->string('prenom',50)->nullable();
            $table->string('classe',10);
            $table->string('sexe',10);
            $table->string('email',50);
            $table->string('adresse',100)->nullable();
            $table->string('pays',25);
            $table->string('ville',50);
            $table->string('numero',15);
            $table->string('libelle',25);
            $table->double('montant');
            $table->string('numero_carte',25);
            $table->date('date');
            $table->date('date_limite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}
