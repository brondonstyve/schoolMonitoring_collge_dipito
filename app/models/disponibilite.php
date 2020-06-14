<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class disponibilite extends Model
{
    public $timestamps=false;
    protected $fillable=['compte','jour','tranche'];
}
