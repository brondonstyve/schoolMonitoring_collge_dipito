<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class configedt extends Model
{
    public $timestamps=false;
    protected $fillable=['tranche','libelle','hd','hf','nbreTranche'];
}
