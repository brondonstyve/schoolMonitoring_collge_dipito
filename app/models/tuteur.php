<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class tuteur extends Model
{
    protected $fillable=['matricule','cni','nom','numero','photo','adresse'];
}
