<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelBDIntentoExamen extends Model
{
    protected $table = 'intentoexamen';
    protected $fillable = ['IdExamen', 'IdUsuario', 'Nota'];
}

