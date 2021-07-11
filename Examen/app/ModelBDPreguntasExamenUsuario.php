<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelBDPreguntasExamenUsuario extends Model
{
    protected $table = 'preguntasexamenuser';
    protected $fillable = ['IdPregunta', 'IdExamen', 'IdUsuario', 'Respuesta','Puntuacion'];
	
}

