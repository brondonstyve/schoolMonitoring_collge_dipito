<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class vote extends Model
{
    public $timestamps=false;
    protected $fillable=['matricule','type','voix'];
}
