<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class statController extends Controller
{
    public function stat_etudiant(){

        $utilisateur=auth()->user();
        return view('administration/stat_eleve',compact('utilisateur'));
    }
}
