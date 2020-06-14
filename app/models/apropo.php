<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class apropo extends Model
{
    public $timestamps=false;
    protected $fillable=['apropos','mission'];
}
