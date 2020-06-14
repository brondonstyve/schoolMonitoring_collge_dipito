<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('matricule')->index()->unsigned();
            $table->integer('compte')->index()->unsigned();
            $table->string('motif');
            $table->string('sanction')->nullable();
            $table->boolean('coupable')->default(false);
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->date('date');
            $table->string('nom_juge')->nullable();
            $table->foreign('compte')->references('id')->on('comptes')->onDelete('cascade');
            $table->foreign('matricule')->references('id')->on('matricules')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplines');
    }
}
