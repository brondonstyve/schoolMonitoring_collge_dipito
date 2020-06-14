<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Compte;
use App\models\Matricule;
use App\models\notification;
use App\models\Paiement;
use App\models\titulaire;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class etudiantController extends Controller
{
    //etudiant

public function etudiant(){
    if (auth()->guest()) {
        Flashy::error('connectez vous!!');
        return redirect()->route('home');
    }

    $utilisateur = auth()->user();

    $classe=classe::join('filieres','filieres.id','=','classes.filiere')
                ->select('classes.id','classes.filiere','classes.niveau',
                         'classes.code_classe as code_classe','filieres.nom','filieres.code as code_f')
                ->orderBy('classes.updated_at','desc')
                ->paginate(5);

    return view('administration/etudiant',compact('utilisateur','classe'));
}
//
public function listeEtudiant(passePartout $request){
    if ($request->ajax()) {
        $reponse=Matricule::whereClasse($request->classe)
        ->get();
        return response($reponse);
    }

}
//
public function listeTousEtudiant(){

        $reponse=Matricule::whereType(null)
        ->get();

        $titulaire=titulaire::join('matricules','matricules.id','=','titulaires.matricule')
        ->select('matricules.nom','matricules.prenom','titulaires.classe')
        ->get();

        $utilisateur=auth()->user();

        $classe=classe::select('nom_classe','id')
        ->get();

        return view('administration/listeEleve',compact('reponse','classe','utilisateur','titulaire'));


}
//
public function rechercherEtudiant(passePartout $request){
    if ($request->ajax()) {
        $reponse=Matricule::whereMatricule($request->matricule)->first();
        return response($reponse);
    }
}
//
public function modifierEtudiant(passePartout $request){
    if($request->ajax()){
        $reponse=Matricule::whereMatricule($request->matricule)
        ->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'sexe'=>$request->sexe,
            'naissance'=>$request->date
        ]);

        $reponse=Compte::whereMatricule($request->matricule)
        ->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
        ]);

        $reponse=notification::create([
            'compte'=>0,
            'matricule'=>$request->matricule,
            'type'=>'modfication d\'informations',
            'message'=>'vos informations viennent d\'être mis à jour. veuillez les verifier',
            'classe'=>'classe',
        ]);


        return $reponse;
    }
}

//supp etudiant
public function supprimerEtudiant(passePartout $request){
    if($request->ajax()){
        $reponse=Matricule::whereMatricule($request->matricule)->delete();
        $reponse=Compte::whereMatricule($request->matricule)->delete();
        return response($reponse);
    }
}

//transfert etudiant
public function transfererEtudiant(passePartout $request){
    if ($request->ajax()) {
        $reponse1=Matricule::whereMatricule($request->matricule)
        ->update([
            'classe'=>$request->classetransfert,
        ]);

        $reponse2=Compte::whereMatricule($request->matricule)
        ->update([
            'classe'=>$request->classetransfert,
        ]);

        $reponse2=Paiement::whereMatricule($request->matricule)
        ->update([
            'classe'=>$request->classetransfert,
        ]);

        $reponse=notification::create([
            'compte'=>0,
            'matricule'=>$request->matricule,
            'type'=>'Transfert',
            'message'=>'vous vennez d\'être transferé en '.$request->classetransfert,
            'classe'=>'classe',
        ]);

        return response($reponse1);
    }
}
}
