<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAlbuns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albuns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome')->nullable();
            $table->string('identificador_externo')->nullable();
            $table->date('data_lancamento')->nullable();
            $table->decimal('nota', 3, 2)->nullable();
            $table->string('capa')->nullable();
            $table->integer('artista_id');
            $table->timestamps();

            $table->foreign('artista_id')
                ->references('id')
                ->on('artistas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albuns');
    }
}
