<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class adresse extends Model
{
    public $timestamps=false;
    protected $fillable=['email','emailAdmin','numero','adresse','facebook','instagram','google','twiter'];
}
