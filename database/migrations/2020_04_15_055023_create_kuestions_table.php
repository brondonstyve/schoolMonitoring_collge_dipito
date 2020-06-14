<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuestions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('compte')->index()->unsigned();
            $table->bigInteger('cour')->index()->unsigned();
            $table->text('message');
            $table->foreign('cour')->references('id')->on('cours')->onDelete('cascade');
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
        Schema::dropIfExists('kuestions');
    }
}
