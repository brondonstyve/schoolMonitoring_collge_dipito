<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    public $timestamps=false;
    protected $fillable=['compte','matiere','note','sequence'];
}
