<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    public $timestamps=false;
    protected $fillable=['matricule','nom','prenom','classe','sexe','email','adresse','pays','ville','numero',
    'montant','libelle','numero_carte','date','date_limite'];
}
