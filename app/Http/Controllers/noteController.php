<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\noteRequest;
use App\Http\Requests\insererNoteRequest;
use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Matiere;
use App\models\note;
use App\models\sequence;

class noteController extends Controller
{
    public function afficherNote(){


        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }



        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }

            $utilisateur=auth()->user();
            $groupe1=classe::whereNom_classe($utilisateur->classe)
            ->get();

            if (sizeOf($groupe1)==0) {
                # code...
            }else {
                $groupe=DB::table('groupe_mats')
                ->whereFiliere($groupe1[0]->filiere)
                ->get();
            }




            $note=DB::table('notes')
            ->join('matricules','matricules.id','=','notes.compte')
            ->join('matieres','notes.matiere','=','matieres.id')
            ->select('matricules.nom as nom_prof','matieres.nom','matieres.groupe','notes.sequence','matieres.coef','notes.note','notes.matiere as id')
            ->where([
                ['notes.compte',$utilisateur->mat],
                ['notes.sequence',1]
            ])
            ->orderBy('matieres.coef','desc')
            ->get();



            $classe=DB::table('matieres')
            ->join('comptes','comptes.id','=','matieres.compte')
            ->select('matieres.nom','matieres.classe','matieres.semestre','matieres.compte','matieres.id')
            ->whereCompte($utilisateur->id)
            ->orderBy('matieres.classe','asc')
            ->get();

            $classeE=Matiere::whereClasse(auth()->user()->classe)
            ->get();

         $sekuence=DB::table('sequences')->select('nbsequence')->get();
         $sek=1;


           $ouverture=false;
            return view('index/note',compact('classeE','sek','sekuence','utilisateur','note','groupe','nombre','classe','nombreclasse','ouverture'));

    }




    public function mesNotes(passePartout $request){

        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }



        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }

            $utilisateur=auth()->user();
            $groupe1=classe::whereNom_classe($utilisateur->classe)
            ->get();

            if (sizeOf($groupe1)==0) {
                # code...
            }else {
                $groupe=DB::table('groupe_mats')
                ->whereFiliere($groupe1[0]->filiere)
                ->get();
            }




            $note=DB::table('notes')
            ->join('matricules','matricules.id','=','notes.compte')
            ->join('matieres','notes.matiere','=','matieres.id')
            ->select('matricules.nom as nom_prof','matieres.nom','matieres.groupe','matieres.coef','notes.note','notes.sequence','notes.matiere as id')
            ->where([
                ['notes.compte',$utilisateur->mat],
                ['notes.sequence',$request->sek]
            ])
            ->orderBy('matieres.coef','desc')
            ->get();



            $classe=DB::table('matieres')
            ->join('comptes','comptes.id','=','matieres.compte')
            ->select('matieres.nom','matieres.classe','matieres.semestre','matieres.compte','matieres.id')
            ->whereCompte($utilisateur->id)
            ->orderBy('matieres.classe','asc')
            ->get();

            $classeE=Matiere::whereClasse(auth()->user()->classe)
            ->get();

         $sekuence=DB::table('sequences')->select('nbsequence')->get();
         $sek=$request->sek;


           $ouverture=false;
            return view('index/note',compact('classeE','sek','sekuence','utilisateur','note','groupe','nombre','classe','nombreclasse','ouverture'));

    }
/*
    $liste=DB::table('notes')
            ->join('comptes','comptes.id','=','notes.compte')
            ->join('matieres','notes.matiere','=','matieres.id')
            ->select('matieres.nom','comptes.nom as nom_prof','notes.CC','notes.SN','comptes.nom','comptes.prenom','comptes.classe')
            ->where([
                ['notes.matiere',$id],
                ['comptes.classe',$classe],
                ])
            ->get();

            $listec=DB::table('notes')
            ->join('comptes','comptes.id','=','notes.compte')
            ->join('matieres','notes.matiere','=','matieres.id')
            ->select('matieres.nom','comptes.nom as nom_prof','notes.CC','notes.SN','comptes.nom','comptes.prenom','comptes.classe')
            ->where([
                ['notes.matiere',$id],
                ['comptes.classe',$classe],
                ])
            ->count();
            */

    public function remplirNotes(noteRequest $request){

        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }


        $utilisateur=auth()->user();

         $id=$request->id;
         $classe=$request->classe;

         $sekuence=DB::table('sequences')->select('nbsequence')->get();

         if (sizeOf($sekuence)<=0) {
             Flashy::error('demander à l\'administrateur de configurer les nombres de séquence');
             return back();
         }

         $remplisseur=DB::table('notes')
            ->join('matricules','matricules.id','=','notes.compte')
            ->join('matieres','notes.matiere','=','matieres.id')
            ->select('matieres.nom','notes.note','notes.sequence','matricules.nom','matricules.prenom','matricules.classe','notes.compte')
            ->where([
                ['notes.matiere',$id],
                ['matricules.classe',$classe],
                ['notes.sequence',1],
                ])
            ->get();


         $classe=DB::table('matieres')
            ->join('comptes','comptes.id','=','matieres.compte')
            ->select('matieres.nom','matieres.classe','matieres.semestre','matieres.compte','matieres.id')
            ->whereCompte($utilisateur->id)
            ->get();


            $liste=DB::table('matricules')
            ->where([

                ['matricules.classe',$request->classe]
                ])
                ->orderBy('nom','Asc')
                ->get();

            $listec=DB::table('matricules','notes')
            ->where([
                ['matricules.classe',$request->classe]
                ])
            ->count();


            $matiiere=$request->matiiere;
            $sek=1;
            $ouverture=true;
            return view('index/note',compact('sek','id','matiiere','utilisateur','sekuence','note','nombre','classe','nombreclasse','liste','listec','ouverture','id','remplisseur'));

    }




    public function insererNotesSek(noteRequest $request){

        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }


        $utilisateur=auth()->user();

         $id=$request->id;
         $classe=$request->classe;


         $sekuence=DB::table('sequences')->select('nbsequence')->get();

         if (sizeOf($sekuence)<=0) {
             Flashy::error('demander à l\'administrateur de configurer les nombres de séquence');
             return back();
         }

         $remplisseur=DB::table('notes')
         ->join('matricules','matricules.id','=','notes.compte')
         ->join('matieres','notes.matiere','=','matieres.id')
         ->select('matieres.nom','notes.note','notes.sequence','matricules.nom','matricules.prenom','matricules.classe','notes.compte')
         ->where([
             ['notes.matiere',$id],
             ['matricules.classe',$classe],
             ['notes.sequence',$request->sek],
             ])
         ->get();


         $classe=DB::table('matieres')
            ->join('comptes','comptes.id','=','matieres.compte')
            ->select('matieres.nom','matieres.classe','matieres.semestre','matieres.compte','matieres.id')
            ->whereCompte($utilisateur->id)
            ->get();


            $liste=DB::table('matricules')
            ->where([

                ['matricules.classe',$request->classe]
                ])
                ->orderBy('nom','Asc')
                ->get();

            $listec=DB::table('matricules','notes')
            ->where([
                ['matricules.classe',$request->classe]
                ])
            ->count();


            $matiiere=$request->matiiere;
            $sek=$request->sek;
            $ouverture=true;
            return view('index/note',compact('sek','matiiere','utilisateur','sekuence','note','nombre','classe','nombreclasse','liste','listec','ouverture','id','remplisseur'));

    }





    public function insererNotes(insererNoteRequest $request){


        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }


      $a=0;

      $utilisateur=auth()->user();
        $note=DB::table('notes')
        ->join('comptes','comptes.id','=','notes.compte')
        ->join('matieres','notes.matiere','=','matieres.id')
        ->select('comptes.nom as nom_prof','matieres.nom','matieres.coef','notes.note','notes.compte','notes.matiere')
        ->where('notes.compte',$utilisateur->id)
        ->get();

        $nombre=DB::table('notes')
        ->join('comptes','comptes.id','=','notes.compte')
        ->join('matieres','notes.matiere','=','matieres.id')
        ->select('comptes.nom as nom_prof','matieres.nom','matieres.coef','notes.note','notes.compte','notes.matiere')
        ->where('notes.compte',$utilisateur->id)
        ->count();


        $classe=DB::table('matieres')
        ->join('comptes','comptes.id','=','matieres.compte')
        ->select('matieres.nom','matieres.classe','matieres.semestre','matieres.compte','matieres.id')
        ->whereCompte($utilisateur->id)
        ->get();


       $ouverture=false;

      while ($a < $request->compteur) {

         note::where(
              [
              ['compte',$_POST["id_compte$a"]],
              ['matiere',$_POST["id_matiere$a"]],
              ['sequence',$_POST["sek$a"]]
              ]
          )->delete();


          if (empty($_POST["note$a"])) {
            $enregistrement=note::create([
                'compte'=>$_POST["id_compte$a"],
                'matiere'=>$_POST["id_matiere$a"],
                'sequence'=>$_POST["sek$a"],
              ]);
          } else {
            $enregistrement=note::create([
                'compte'=>$_POST["id_compte$a"],
                'matiere'=>$_POST["id_matiere$a"],
                'note'=>$_POST["note$a"],
                'sequence'=>$_POST["sek$a"],
              ]);
          }



          $a++;
      }

        if ($enregistrement) {
            Flashy::success('Les notes ont été correctement enregistrées');
            return  redirect()->route('note_path',compact('utilisateur','note','nombre','classe','nombreclasse','ouverture'));
        } else {
            Flashy::success('Erreur d\'enregistrement');
            return  redirect()->route('note_path',compact('utilisateur','note','nombre','classe','nombreclasse','ouverture'));
        }




    }
}
