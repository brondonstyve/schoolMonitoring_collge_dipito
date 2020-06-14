<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCahiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cahiers', function (Blueprint $table) {
            $table->integer('compte')->index()->unsigned();
            $table->integer('matiere')->index()->unsigned();
            $table->string('libelle')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('cahiers');
    }
}
