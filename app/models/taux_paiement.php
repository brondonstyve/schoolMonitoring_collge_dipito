<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class taux_paiement extends Model
{
    public $timestamps=false;
    protected $fillable=['filiere','niveau','libelle','montant','date','penalite'];
}
