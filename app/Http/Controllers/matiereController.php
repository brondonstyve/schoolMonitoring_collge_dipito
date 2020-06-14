<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\cahier;
use App\models\classe;
use App\models\Compte;
use App\models\emploiDeTemp;
use App\models\epreuve;
use App\models\groupe_mat;
use App\models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class matiereController extends Controller
{
    public function matiere(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();

        $classe=classe::join('filieres','filieres.id','=','classes.filiere')
                    ->select('classes.id','classes.filiere','classes.niveau',
                             'classes.code_classe as code_classe','filieres.nom','filieres.code as code_f')
                    ->orderBy('classes.updated_at','desc')
                    ->paginate(5);

        $prof=Compte::whereType('enseignant')
        ->select('nom','prenom','id')
        ->get();



        $rep=classe::get('nom_classe');

        return view('administration/matiere',compact('utilisateur','classe','prof','rep'));
    }

    public function enregistrer_matiere(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        if ($request->ajax()) {

            $reponse=Matiere::Where([
                ['compte',$request->prof],
                ['nom',$request->matiere],
                ['classe',$request->classe]
            ])
            ->get();
            if (sizeOf($reponse)>0) {
                return response('cette matière est deja enregistrée pour cette classe');
            } else {
                $filiere_niveau=classe::whereNom_classe($request->classe)
                ->select('filiere','niveau')
                ->get();

                $classe=classe::where([
                    ['filiere',$filiere_niveau[0]->filiere],
                    ['niveau',$filiere_niveau[0]->niveau],
                    ['nom_classe','<>',$request->classe]
                    ])
                ->select('nom_classe')
                ->get();


                $reponse=Matiere::create([
                    'compte'=>$request->prof,
                    'nom'=>$request->matiere,
                    'classe'=>$request->classe,
                    'groupe'=>$request->groupe,
                    'nombre_heure'=>$request->nbheure,
                    'filiere_niveau'=>$filiere_niveau[0]->filiere.'.'.$filiere_niveau[0]->niveau,
                    'coef'=>$request->coef,
                ]);

                for ($i=0; $i <sizeOf($classe) ; $i++) {

                    Matiere::create([
                        'compte'=>$request->prof,
                        'nom'=>$request->matiere,
                        'classe'=>$classe[$i]->nom_classe,
                        'groupe'=>$reponse->groupe,
                        'nombre_heure'=>$request->nbheure,
                        'filiere_niveau'=>$filiere_niveau[0]->filiere.'.'.$filiere_niveau[0]->niveau.'_"',
                        'coef'=>$request->coef,
                    ]);

                }




                return response('matière enregistrée avec success! et mise a jour par rapport aux autres classes');
            }



        }

    }


    //

    public function liste_matiere(passePartout $request){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $reponse=Matiere::join('comptes','comptes.id','=','matieres.compte')
            ->join('groupe_mats','groupe_mats.id','=','matieres.groupe')
            ->where([
                ['matieres.classe',$request->classe]
            ])
            ->select('matieres.id','comptes.nom as nomProf','groupe_mats.nom','groupe_mats.filiere','matieres.nom as nommatiere','matieres.classe','matieres.coef','matieres.nombre_heure')
            ->orderBy('groupe_mats.nom','asc')
            ->get();
            return response($reponse);
        }
    }

    public function modifier_matiere(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if ($request->ajax()) {


            $id=\explode('_',$request->filiere_niveau);
            $tableau=array($id[0],$id[0].'_"');

            //avant mod

            $emploi=DB::table('matieres')
            -> whereIn( 'filiere_niveau', $tableau )
            -> where('nom',$request->anc_matiere)
            ->get();


            $reponse=Matiere::whereId($request->id)
            ->update([
                'compte'=>$request->prof,
                'nom'=>$request->matiere,
                'nombre_heure'=>$request->nbheure,
                'coef'=>$request->coef,
                'groupe'=>$request->groupe,

            ]);

            if ($request->prof != $request->id_professeur) {
                emploiDeTemp::whereClasseAndCompteAndMatiere($request->cla,$request->id_professeur,$request->anc_matiere)
                ->delete();

                epreuve::whereClasseAndCompteAndMatiere($request->cla,$request->id_professeur,$request->id.'.'.$request->anc_matiere)
                ->delete();

                cahier::whereCompteAndMatiere($request->id_professeur,$request->id)
                ->update([
                    'compte'=>$request->prof,
                ]);
            }



            //mod
           $reponse=DB::table('matieres')
            -> whereIn( 'filiere_niveau', $tableau )
            -> where('nom',$request->anc_matiere)
            ->update([
                'nom'=>$request->matiere,
                'nombre_heure'=>$request->nbheure,
                'coef'=>$request->coef,
                'groupe'=>$request->groupe,
            ]);



            for ($i=0; $i < sizeOf($emploi); $i++) {
                $reponse=emploiDeTemp::whereClasseAndMatiere($emploi[$i]->classe,$emploi[$i]->nom)
                 ->update([
                    'matiere'=>$request->matiere,
                ]);
            }


            for ($i=0; $i < sizeOf($emploi); $i++) {
            $reponse=epreuve::whereMatiere($emploi[$i]->id.'.'.$emploi[$i]->nom)
            ->update([
                'matiere'=>$emploi[$i]->id.'.'.$request->matiere,
            ]);
        }




                return response('matière modifiée avec succés');
        }
    }

    public function rechercher_matiere(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $reponse=Matiere::join('comptes','comptes.id','=','matieres.compte')
            ->join('groupe_mats','groupe_mats.id','=','matieres.groupe')
            ->select('comptes.nom as nom_prof','matieres.filiere_niveau','groupe_mats.nom as nom_g','comptes.id','comptes.prenom','matieres.classe','matieres.nom','matieres.coef','matieres.nombre_heure')
            ->find($request->id);
            return response($reponse);
        }
    }


    public function supprimer_matiere(passePartout $request){
        if($request->ajax()){

            $nom=Matiere::whereId($request->id)->get();

            $id=\explode('_',$nom[0]->filiere_niveau);
            $tableau=array($id[0],$id[0].'_"');

            //avant mod


            $reponse1=DB::table('matieres')
            -> whereIn( 'filiere_niveau', $tableau )
            -> where('nom',$nom[0]->nom)
            ->get();


            $suppMat=DB::table('matieres')
            -> whereIn('filiere_niveau', $tableau )
            -> where('nom',$nom[0]->nom)
            ->delete();

            if (sizeOf($reponse1)>0) {
                for ($i=0; $i <sizeOf($reponse1) ; $i++) {
                    $reponse=emploiDeTemp::whereClasseAndMatiere($reponse1[$i]->classe,$reponse1[0]->nom)
                    ->delete();

                    $reponse=epreuve::whereClasseAndMatiere($reponse1[$i]->classe,$reponse1[$i]->id.'.'.$reponse1[0]->nom)
                    ->delete();
                }

            }


            if($suppMat){
                return response('suppression effecté avec succèss');
            }
        }
    }

    public function groupe(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $reponse=groupe_mat::whereFiliereAndNom($request->filiere,$request->nom)
        ->first();

        if($reponse){
            Flashy::error('ce groupe existe déjà pour cette filière à ce niveau');
            return redirect()->route('accueil_index_path');
        }
        $reponse=groupe_mat::create([
            'nom' => $request->nom,
            'filiere' => $request->filiere,
        ]);

        if ($reponse) {
            Flashy::success('enregistrement éffectué avec succès');
            return redirect()->route('accueil_index_path');
        }else{
            Flashy::error('erreur');
            return redirect()->route('accueil_index_path');
        }
    }

    public function charger_groupe(passePartout $request){
        $groupe=groupe_mat::whereFiliere($request->filiere)
        ->select('id','nom')
        ->get();

        return response($groupe);
    }
}
