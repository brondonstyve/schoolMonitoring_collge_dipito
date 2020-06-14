<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class evenement extends Model
{
    protected $fillable=['titre','description','date','debut','fin','lieu'];
}
