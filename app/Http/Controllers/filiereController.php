<?php

namespace App\Http\Controllers;

use App\filiere;
use App\Http\Requests\filiereRequest;
use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Compte;
use App\models\emploiDeTemp;
use App\models\epreuve;
use App\models\Matiere;
use App\models\Matricule;
use App\models\notification;
use App\models\Paiement;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class filiereController extends Controller
{
    //ajouter Filiere

    public function afficherFiliere()
    {

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $filiere = filiere::orderBy('updated_at', 'Desc')->paginate(5);

        $filiereNbre = filiere::count();

        return view('administration/filiere', compact('utilisateur', 'filiere', 'filiereNbre'));
    }

    public function enregistrerFiliere(filiereRequest $request)
    {

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if ($request->ajax()) {

            $rep=filiere::whereNomOrCode($request->nom,$request->code)
            ->first();
            if ($rep) {
                return response('Cette filière ou ce code de filière existe déjà');
            } else {
            $reponse = filiere::Create([
                'nom' => $request->nom,
                'code' => $request->code,
                'niveau'=>$request->niveau
            ]);
            return response($reponse);
        }
    }

    }

    public function supprimerFiliere(passePartout $request){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if ($request->ajax()) {
            $classe=classe::whereFiliere($request->id)
            ->count();
            if($classe > 0){
                return response('Impossible de supprimer cette filière elle contient des Classes. bien vouloir les supprimer');
            }else{
                filiere::destroy($request->id);
                return response(['message'=>'Filiere supprimé avec succès']);
            }



        }

    }

    public function chercheurFiliere(passePartout $request){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if($request->ajax()){
            $reponse=filiere::find($request->id);
            return response($reponse);
        }
    }


    public function modifierFiliere(passePartout $request){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if ($request->ajax()) {

            $reponse=filiere::where('id','<>',$request->id_fil)
            ->get();
            for ($i=0; $i < sizeOf($reponse); $i++) {
                if ($reponse[$i]->nom==$request->nom || $reponse[$i]->code==$request->code) {
                    return response('ce nom ou ce code existe deja!');
                }
            }


            $classe=classe::whereFiliere($request->id_fil)
            ->get();

             for ($i=0; $i < sizeOf($classe); $i++) {

             classe::whereId($classe[$i]->id)
             ->update([
                 'nom_classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
             ]);

             Matiere::whereClasse($classe[$i]->nom_classe)
             ->update([
                 'classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
             ]);

             emploiDeTemp::whereClasse($classe[$i]->nom_classe)
             ->update([
                'classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
            ]);

             epreuve::whereClasse($classe[$i]->nom_classe)
             ->update([
                'classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
            ]);

             Compte::whereClasse($classe[$i]->nom_classe)
             ->update([
                'classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
            ]);

             notification::whereClasse($classe[$i]->nom_classe)
             ->update([
                'classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
            ]);

            Matricule::whereClasse($classe[$i]->nom_classe)
             ->update([
                'classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
            ]);

            Paiement::whereClasse($classe[$i]->nom_classe)
             ->update([
                'classe'=>$request->code.$classe[$i]->niveau.$classe[$i]->code_classe,
            ]);

        }

        $reponse=filiere::find($request->id_fil);
        $reponse->update($request->all());

        return response('modification effectuée avec succès');
    }
}


    public function voirFiliere(passePartout $request){
        if ($request->ajax()) {
            $reponse=classe::join('filieres','filieres.id','=','classes.filiere')
            ->whereFiliere($request->id)
            ->select('filieres.id','filieres.code','filieres.nom','classes.niveau','classes.code_classe')
            ->get();
            return response($reponse);
        }
    }

    public function listeFiliere(passePartout $request){
        if($request->ajax()){
           $reponse=filiere::select('nom','id','code')->get();
           return response($reponse);
        }
    }

    public function chercheurFiliereClasse(passePartout $request){

        if($request->ajax()){
            $reponse=classe::join('filieres','filieres.id','=','classes.filiere')
            ->where([
                ['classes.filiere',$request->id],
            ])
            ->select('classes.id','filieres.code','classes.niveau','classes.code_classe')
            ->get();

            return response($reponse);
        }
    }
}
