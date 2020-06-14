<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('mat')->index()->unsigned();
            $table->string('matricule');
            $table->string('nom',50);
            $table->string('prenom',50)->nullable();
            $table->string('classe',10)->nullable();
            $table->string('email',50);
            $table->string('mot_de_passe');
            $table->string('téléphone',10)->nullable();
            $table->string('ville',50)->nullable();
            $table->string('photo')->nullable();
            $table->boolean('statut')->default(true);
            $table->string('type',30)->nullable();
            $table->string('droit',30)->nullable();
            $table->foreign('mat')->references('id')->on('matricules')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comptes');
    }
}
