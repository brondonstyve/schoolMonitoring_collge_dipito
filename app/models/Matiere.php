<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model

{
    public $timestamps=false;

    protected $fillable=['nom','semestre','groupe','nombre_heure','compte','classe','coef','filiere_niveau'];
}
