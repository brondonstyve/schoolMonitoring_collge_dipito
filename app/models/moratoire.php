<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class moratoire extends Model
{
    protected $fillable=['matricule','tranche','date','classe'];
}
