<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\Mail\ContactMessageCreated;
use App\model\salaire;
use App\models\Matricule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MercurySeries\Flashy\Flashy;

class matriculeController extends Controller
{
    public function matricule(){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();

        return view('administration/matricules',compact('utilisateur'));
    }

    public function generer_matricule(passePartout $request){




            $insert= Matricule::create(
                [
                    'nom'=>$request->nom,
                    'prenom'=>$request->prenom,
                    'sexe'=>$request->sexe,
                    'email'=>$request->email,
                    'adresse'=>$request->adresse,
                    'pays'=>$request->pays,
                    'ville'=>$request->ville,
                    'numero'=>$request->numero,
                    'naissance'=>$request->naissance,
                    'type'=>$request->type,
                ]
                );

                $matricule='IAI-SC-'.date('Y').'_'.(date('Y')+1).'-'.$insert->id;

                $insert=Matricule::whereId($insert->id)
                ->update([
                    'matricule'=>$matricule,
                ]);

                $insert=Matricule::whereMatricule($matricule)->get('id');

                $insert=salaire::create([
                    'matricule'=>$insert[0]->id,
                    'salaire'=>$request->sal,
                    'horaire'=>0,
                ]);

                if($insert){

                    try {

                        sleep(0);
                        $mailable=new ContactMessageCreated($request->nom,'schoolmonitoring@gmail.com','votre matricule est :'.$matricule);
                        Mail::to($request->email)->send($mailable);
                        Flashy::success('matricule enregistré avec succès! le concerné a été notifié par mail');
                        return redirect()->route('accueil_index_path');

                        } catch (\Throwable $th) {
                            Flashy::error('erreur reseau.vérifiez votre connexion! le matricule est : '.$matricule);
                            return redirect()->route('accueil_index_path');
                        }
                }else{
                    Flashy::error('erreur ');
                     return redirect()->route('accueil_index_path');
                }
    }
}
