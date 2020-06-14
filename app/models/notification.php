<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable=['compte','type','message','statut','matricule','classe'];
}
