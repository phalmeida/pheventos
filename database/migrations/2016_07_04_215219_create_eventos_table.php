<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 100);
            $table->text('descricao');
            $table->string('link_video', 200);
            $table->integer('id_palestrante')->unsigned();
            $table->foreign('id_palestrante')->references('id')->on('palestrantes');
            $table->timestamp('dt_inicio');
            $table->timestamp('dt_fim');
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
        Schema::drop('eventos');
    }
}
