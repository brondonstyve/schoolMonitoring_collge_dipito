<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class discipline extends Model
{
    protected $fillable=['compte','matricule','motif','sanction','coupable','statut','date','nom_juge'];
}
