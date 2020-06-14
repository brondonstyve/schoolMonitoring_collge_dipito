<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\evenement;
use App\models\notification;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class evenementController extends Controller
{
    public function evenement(){
        if (auth()->guest()) {
            Flashy::error('connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur=auth()->user();

        $date=date('Y-m-d');

        $sup=evenement::where([
            ['date','<',$date]
        ])
        ->delete();

        $evenement=evenement::orderBy('date','asc')
        ->paginate(10);


        return view('administration/evenement',compact('utilisateur','evenement'));
    }

    public function ajout_evenement(passePartout $re){


        if (auth()->guest()) {
            Flashy::error('connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur=auth()->user();

        if ($re->debut>=$re->fin) {
            Flashy::error('erreur. l\'heure de debut est suppérieur ou égale à l\'heure de fin');
            return \redirect()->route('evenement_path');
        }

        $reponse=evenement::create([
            'titre'=>$re->titre,
            'description'=>$re->description,
            'date'=>$re->date,
            'lieu'=>$re->lieu,
            'debut'=>$re->debut,
            'fin'=>$re->fin,
        ]);

        if ($re) {
            $reponse=notification::whereType('Nouvel événement')
            ->delete();

            $reponse=notification::create([
                'compte'=>0,
                'matricule'=>'public',
                'type'=>'Nouvel événement',
                'message'=>$re->titre,
                'classe'=>'classe',
            ]);
            Flashy::success('évènement ajouté avec succès');
            return \redirect()->route('evenement_path');
        }else {
            Flashy::error('erreur');
            return \redirect()->route('evenement_path');
        }
    }

    public function supp_evenement(){
        if (auth()->guest()) {
            Flashy::error('connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur=auth()->user();

        $reponse=evenement::destroy($_GET['id']);
        if ($reponse) {
            Flashy::success('suppression effectuée avec succès');
            return \redirect()->route('evenement_path');
        }else {
            Flashy::error('erreur');
            return \redirect()->route('evenement_path');
        }
    }

    public function mod_evenement(passePartout $re){
        if (auth()->guest()) {
            Flashy::error('connectez vous');
            return \redirect()->route('home');
        }

        if ($re->debut>=$re->fin) {
            Flashy::error('erreur. l\'heure de debut est suppérieur ou égale à l\'heure de fin');
            return \redirect()->route('evenement_path');
        }

        $utilisateur=auth()->user();

        $reponse=evenement::whereId($re->id)
        ->update([
            'titre'=>$re->titre,
            'description'=>$re->description,
            'date'=>$re->date,
            'lieu'=>$re->lieu,
            'debut'=>$re->debut,
            'fin'=>$re->fin,
        ]);
        if ($reponse) {
            Flashy::success('modification effectuée avec succès');
            return \redirect()->route('evenement_path');
        }else {
            Flashy::error('erreur');
            return \redirect()->route('evenement_path');
        }
    }
}
