<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('epreuve')->unsigned()->default(null);
            $table->integer('compte')->index()->unsigned();
            $table->integer('matiere')->index()->unsigned();
            $table->string('libelle',3);
            $table->double('dure');
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->foreign('epreuve')->references('id')->on('epreuves')->onDelete('cascade');
            $table->foreign('compte')->references('id')->on('comptes')->onDelete('cascade');
            $table->foreign('matiere')->references('id')->on('matieres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
