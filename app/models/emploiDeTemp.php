<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class emploiDeTemp extends Model
{
    protected $fillable=['disponibilite','classe','jour','matiere','compte','tranche'];
}
