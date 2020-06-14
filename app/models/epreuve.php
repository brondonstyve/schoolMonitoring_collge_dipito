<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class epreuve extends Model
{
    protected $fillable=['compte','editeur','matiere','classe','epreuve','reponse','libelle','statut','id_matiere'];
}
