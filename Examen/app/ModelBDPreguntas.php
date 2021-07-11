<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelBDPreguntas extends Model
{
    protected $table = 'preguntas';
	protected  $primaryKey = 'IdPregunta';
    protected $fillable = ['IdPregunta', 'IdExamen', 'Enunciado', 'Respuesta','Puntuacion'];

}

