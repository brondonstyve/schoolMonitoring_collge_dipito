<?php

namespace App\Http\Controllers;

use App\filiere;
use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Compte;
use App\models\emploiDeTemp;
use App\models\epreuve;
use App\models\Matiere;
use App\models\Matricule;
use App\models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class classeController extends Controller
{
     //* Display a listing of the resource.
    public function index()
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();
        $filiere=filiere::pluck('nom','id');

        $classe=classe::join('filieres','filieres.id','=','classes.filiere')
                    ->select('classes.id','classes.filiere','classes.niveau',
                             'classes.code_classe as code_classe','filieres.nom','filieres.code as code_f')
                    ->orderBy('classes.updated_at','desc')
                    ->paginate(5);

        return view('administration/classes',compact('utilisateur','filiere','classe'));
    }

    public function enregistrerclasse(passePartout $request){
            if($request->ajax()){
                $rep=classe::where([
                    ['filiere',$request->filiere],
                    ['niveau',0],
                    ['code_classe',$request->code_classe],

                ])
                ->first();

                if ($rep) {
                    return response('Cette classe existe déjà');
                } else {
                    $classe=filiere::whereId($request->filiere)->first();
                    $reponse=classe::create([
                        'filiere'=>$request->filiere,
                        'niveau'=>0,
                        'code_classe'=>$request->code_classe,
                        'nom_classe'=>$classe->code.' '.$request->code_classe,
                    ]);

                    //mis a jour des matieres
                    $classe_filiere=$request->filiere.'.0';
                    $filiere_classe=$classe_filiere.'_"';
                    $classe_nvel=$classe->code.' '.$request->code_classe;
                    $mis_a_jour=Matiere::whereFiliere_niveau($classe_filiere)
                    ->get();

                    for ($i=0; $i < sizeof($mis_a_jour); $i++) {
                        Matiere::create([
                            'compte'=>$mis_a_jour[$i]->compte,
                            'nom'=>$mis_a_jour[$i]->nom,
                            'classe'=>$classe_nvel,
                            'groupe'=>$mis_a_jour[$i]->groupe,
                            'nombre_heure'=>$mis_a_jour[$i]->nombre_heure,
                            'filiere_niveau'=>$filiere_classe,
                            'coef'=>$mis_a_jour[$i]->coef,
                        ]);
                    }


                    $rep=classe::join('filieres','filieres.id','=','classes.filiere')
                    ->select('classes.id','classes.filiere','classes.niveau',
                             'classes.code_classe as code_classe','filieres.nom','filieres.code as code_f')
                    ->where([
                        ['classes.id',$reponse->id]
                        ])
                    ->get();
                    return response($rep[0]);
                }

            }
    }


    //Supprimer une classe
    public function supprimerClasse(passePartout $request){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if($request->ajax()){
            $classe=classe::find($request->id);
            $nom_cl=$classe->nom_classe;
            $classe=Matricule::whereClasse($classe->nom_classe)
            ->count();

            if($classe > 0){
                return response('Impossible de supprimer cette classe elle contient des étudiants. bien vouloir les transférer avant la suppression');
            }else{
                classe::destroy($request->id);

                Matiere::whereClasse($nom_cl)
                ->delete();

                emploiDeTemp::whereClasse($nom_cl)
                ->delete();

                epreuve::whereClasse($nom_cl)
                ->delete();

                notification::whereClasse($nom_cl)
                ->delete();

                return response('Supprimé avec succès');
            }

        }
    }

    //chercher
    public function chercheurclasse(passePartout $request){

        if($request->ajax()){
            $reponse=classe::find($request->id);
            return response($reponse);
        }
    }

    //mise a jour classe
    public function modifierclasse(passePartout $request){
        if($request->ajax()){
            $reponse=classe::whereId($request->id_classe)
            ->update([
                'filiere'=>$request->filiere,
                'niveau'=>0,
                'code_classe'=>$request->code_classe,
                'description'=>$request->description,
            ]);
            return response($request->all());
        }
    }

    //lister toutes les salles

    public function listeTouteClasse(){
        $reponse=classe::get('nom_classe');
        return response($reponse);
    }


}
