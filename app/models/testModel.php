<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class testModel extends Model
{
    protected $table='tests';
    protected $fillable=['nom','classe'];
    public $timestamps=false;
}
