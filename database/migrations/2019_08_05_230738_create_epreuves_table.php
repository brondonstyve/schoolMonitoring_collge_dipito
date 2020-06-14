<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpreuvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epreuves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('compte')->index()->unsigned();
            $table->integer('id_matiere')->index()->unsigned();
            $table->string('editeur',50);
            $table->string('matiere',50);
            $table->string('classe',10);
            $table->string('epreuve');
            $table->string('reponse');
            $table->string('libelle',3);
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->foreign('compte')->references('id')->on('comptes')->onDelete('cascade');
            $table->foreign('id_matiere')->references('id')->on('matieres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epreuves');
    }
}
