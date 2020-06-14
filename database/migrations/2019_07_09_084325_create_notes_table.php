<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigInteger('compte')->index()->unsigned();
            $table->integer('matiere')->index()->unsigned();
            $table->double('note')->default(0);
            $table->String('sequence');
            $table->foreign('compte')->references('id')->on('matricules')->onDelete('cascade');
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
        Schema::dropIfExists('notes');
    }
}
