<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatutEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statut_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('compte')->index()->unsigned();
            $table->bigInteger('evaluation')->index()->unsigned();
            $table->boolean('statut')->default(false);
            $table->foreign('compte')->references('id')->on('comptes')->onDelete('cascade');
            $table->foreign('evaluation')->references('id')->on('evaluations')->onDelete('cascade');
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
        Schema::dropIfExists('statut_evaluations');
    }
}
