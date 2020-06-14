<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Appel extends Model
{
    protected $fillable=['matricule','matiere','nom_prof','absence'];
}
