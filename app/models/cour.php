<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cour extends Model
{
    protected $fillable=['matiere','compte','fichier','libelle','commentaire'];
}
