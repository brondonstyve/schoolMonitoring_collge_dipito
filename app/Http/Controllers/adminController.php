<?php

namespace App\Http\Controllers;

use App\models\Compte;
use App\models\Matricule;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class adminController extends Controller
{
    public function index(){
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if(auth()->guest()){
          Flashy::error('connectez vous!!');
          return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $compte=Compte::count();
        $compte_etu=Compte::whereType(NULL)->count();
        $etudiant=Matricule::whereClasse(NULL)->count();

         return  view('administration/accueil',compact('utilisateur','compte','compte_etu','etudiant'));
    }


}
