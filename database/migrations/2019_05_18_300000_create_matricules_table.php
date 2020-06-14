<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matricules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('matricule',20)->nullable();
            $table->string('nom',50);
            $table->string('prenom',50)->nullable();
            $table->string('classe',10)->nullable();
            $table->string('annee_accademique',20)->nullable();
            $table->string('sexe',10);
            $table->string('email',50);
            $table->string('adresse',100)->nullable();
            $table->string('pays',25)->nullable();
            $table->string('ville',50)->nullable();
            $table->string('numero',15)->nullable();
            $table->date('naissance');
            $table->string('type',50)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matricules');
    }
}
