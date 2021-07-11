<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelBDExamens extends Model
{
    protected $table = 'Examens';
   	protected $fillable = ['IdExamen','Titol'];
}
