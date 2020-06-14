<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGl1MatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compte')->unsigned()->default(null);
            $table->string('nom',50);
            $table->integer('semestre')->nullable();
            $table->string('classe',10);
            $table->integer('nombre_heure');
            $table->text('filiere_niveau');
            $table->bigInteger('groupe')->index()->unsigned();
            $table->integer('coef');
            $table->foreign('groupe')->references('id')->on('groupe_mats')->onDelete('cascade');
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
        Schema::dropIfExists('matieres');
    }
}
