<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\adresse;
use App\models\apropo;
use App\models\configedt;
use App\models\disponibilite;
use App\models\emploiDeTemp;
use App\models\sequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class configurationController extends Controller
{
    public function adresse(passePartout $re){

        $reponse=adresse::where('id','<>',null)->delete();
        $reponse=adresse::create([
            'email'=>$re->email,
            'adresse'=>$re->adresse,
            'emailAdmin'=>$re->emailAdmin,
            'numero'=>$re->numero,
            'facebook'=>$re->facebook,
            'instagram'=>$re->instagram,
            'google'=>$re->google,
            'twiter'=>$re->twitter,

        ]);

        if ($reponse) {
            Flashy::success('enregistremet éffectué avec succès');
            return redirect()->route('accueil_index_path');
        } else {
            Flashy::error('erreur');
            return redirect()->route('accueil_index_path');
        }




    }

    public function apropos(passePartout $re){

        $reponse=apropo::where('id','<>',null)->delete();
        $reponse=apropo::create([
            'apropos'=>$re->apropos,
            'mission'=>$re->mission,

        ]);

        if ($reponse) {
            Flashy::success('enregistremet éffectué avec succès');
            return redirect()->route('accueil_index_path');
        } else {
            Flashy::error('erreur');
            return redirect()->route('accueil_index_path');
        }
    }

    public function edt(passePartout $re){
        if(auth()->guest()){
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
          }

          if ($re->ajax()){

              configedt::where('id','<>',null)
              ->delete();

              for ($i=0; $i < $re->nbtranche ; $i++) {
                  $a=$i+1;
                  $reponse=configedt::create([
                      'tranche'=>"tranche".($i+1),
                      'libelle'=>$_POST["libelle$a"],
                      'hd'=>$_POST["hd$a"],
                      'hf'=>$_POST["hf$a"],
                      'nbreTranche'=>$re->nbtranche,
                  ]);
              }

              if ($reponse) {
                  emploiDeTemp::where('disponibilite','<>',null)
                  ->delete();
                  disponibilite::where('id','<>',null)
                  ->delete();
                  return response('enregistrement effectué avec succès');
              }else{
                  return response('erreur');
              }
          }
    }


    public function modifierConfEdt(){
        if(auth()->guest()){
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
          }
    }


    public function sequence(passePartout $re){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        DB::table('sequences')->delete();
        $reponse=sequence::create([
            'nbsequence'=>$re->nbsequence,
        ]);

        if ($reponse) {
            Flashy::success('enregistrement éffectué avec succès.');
            return redirect()->route('accueil_index_path');
        } else {
            Flashy::success('érreur d\'enregistrement.');
            return redirect()->route('accueil_index_path');
        }

    }
}
