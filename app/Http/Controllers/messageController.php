<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Compte;
use App\models\Paiement;
use App\models\taux_paiement;
use MercurySeries\Flashy\Flashy;

class messageController extends Controller
{
    public function message(){
        if (auth()->guest()) {
            Flashy::error('connectez vous');
            return redirect()->route('home');
        }
        $utilisateur=auth()->user();

        $resultat=classe::whereNom_classe($utilisateur->classe)
        ->select('filiere','niveau')
        ->get();

        if (sizeOf($resultat)==1) {
            $resultat=taux_paiement::whereFiliereAndNiveau($resultat[0]->filiere,$resultat[0]->niveau)
            ->get();


            $paiement=Paiement::whereMatricule($utilisateur->matricule)
            ->select('libelle','montant','date','date_limite')

            ->get();
        }

        //return $resultat;


        return view('index/message',compact('utilisateur','resultat','paiement'));
    }

    public function rechercherEmail(passePartout $request){
        if ($request->ajax()) {
            $reponse=Compte::where('email','like',$request->email.'%')->select('id','email','photo')->get();
            return response($reponse);
        }
    }
}
