<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class evaluation extends Model
{
    protected $fillable=['epreuve','compte','dure','matiere','statut','libelle','date_evaluation'];
}
