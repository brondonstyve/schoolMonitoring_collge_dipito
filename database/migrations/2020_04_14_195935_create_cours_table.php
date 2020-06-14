<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('matiere')->index()->unsigned();
            $table->integer('compte')->index()->unsigned();
            $table->string('fichier');
            $table->string('libelle');
            $table->text('commentaire');
            $table->foreign('matiere')->references('id')->on('matieres')->onDelete('cascade');
            $table->foreign('compte')->references('id')->on('comptes')->onDelete('cascade');
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
        Schema::dropIfExists('cours');
    }
}
