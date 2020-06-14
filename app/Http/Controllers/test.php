<?php

namespace App\Http\Controllers;

use App\models\testModel;
use App\Http\Requests\passePartout;

class test extends Controller
{
    public function afficher(){
        $collection=testModel::all();

        return view('compte/ajax/test',compact('collection','nom'));
    }

    public function inserer(passePartout $re){

        $insert=testModel::create($re->all());
        return redirect()->route('');

    }
}
