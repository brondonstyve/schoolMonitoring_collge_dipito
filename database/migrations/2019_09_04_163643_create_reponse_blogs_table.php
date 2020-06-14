<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReponseBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponse_blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('compte')->index()->unsigned();
            $table->bigInteger('sujet')->index()->unsigned();
            $table->string('message');
            $table->foreign('sujet')->references('id')->on('blogs')->onDelete('cascade');
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
        Schema::dropIfExists('reponse_blogs');
    }
}
