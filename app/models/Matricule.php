<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Matricule extends Model
{
    public $timestamps=false;
    protected $fillable=['matricule','nom','prenom','naissance','classe','annee_accademique','sexe','email','adresse','pays','ville','numero','type'];

}
