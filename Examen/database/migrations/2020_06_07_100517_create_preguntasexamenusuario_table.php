<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasexamenusuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntasexamenuser', function (Blueprint $table) {
            $table->id();
			$table->integer('IdPregunta');
			$table->integer('IdExamen');
			$table->integer('IdUsuario');
			$table->string('Respuesta');
			$table->integer('Puntuacion');
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
        Schema::dropIfExists('preguntasexamenuser');
    }
}
