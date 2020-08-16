<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\cour;
use App\models\kuestion;
use App\models\Matiere;
use App\models\reponse;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class coursController extends Controller
{
    public function coursProf()
    {
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }
        $utilisateur = auth()->user();

        $cour = DB::table('matieres')
            ->distinct()
            ->select('classe')
            ->whereCompte($utilisateur->id)
            ->get();

        $course = cour::join('matieres', 'matieres.id', '=', 'cours.matiere')
            ->where([
                ['cours.compte', $utilisateur->id],
            ])
            ->select('matieres.id','cours.matiere', 'cours.id as id_cours', 'cours.fichier', 'cours.libelle', 'matieres.classe', 'matieres.nom')
            ->get();

        return view('index/coursProf', \compact('utilisateur', 'cour', 'course'));
    }

    public function matiere_prof(passePartout $re)
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $reponse = Matiere::whereCompteAndClasse($utilisateur->id, $re->classe)
            ->select('classe', 'nom', 'id')
            ->get();

        if ($reponse) {
            return response($reponse);
        }
    }

    public function enregistrerCours(passePartout $re)
    {
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        $fichier = $re->file('fichier');
        $fichierCheminPublic = '/public/cours/';
        $nomFichier = time() . $fichier->getClientOriginalName();
        $stockage = $fichier->storeAs($fichierCheminPublic, $nomFichier);

        $reponse = cour::create(
            [
                'matiere' => $re->matiere,
                'compte' => auth()->user()->id,
                'fichier' => $nomFichier,
                'libelle' => $re->libelle,
                'commentaire'=>$re->comment,
            ]
        );

        if ($reponse) {
            Flashy::success('cours enregistré avec succès');
            return redirect()->route('coursProf_path');
        } else {
            Flashy::error('erreur d\'enregistrement');
            return redirect()->route('coursProf_path');
        }

    }

    public function supprimerCours(passePartout $re)
    {
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if ($re->ajax()) {
            $reponse = cour::destroy($re->id);
            if ($reponse) {
                return 1;
            }
        }
    }

    public function supprimerToutCours()
    {
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        $reponse = cour::whereCompte(auth()->user()->id)
            ->delete();

        if ($reponse) {
            Flashy::success('opération éffectué avec succès');
            return redirect()->route('coursProf_path');
        } else {
            Flashy::error('erreur');
            return redirect()->route('coursProf_path');
        }
    }

    //etudiant

    public function coursEtu()
    {
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }
        $utilisateur = auth()->user();

        $cour = DB::table('matieres')
            ->distinct()
            ->select('nom')
            ->whereClasse($utilisateur->classe)
            ->get();

        $course = cour::join('matieres', 'matieres.id', '=', 'cours.matiere')
            ->where([
                ['matieres.classe', $utilisateur->classe],
            ])
            ->select('cours.id as id_cours','cours.commentaire','cours.libelle', 'matieres.nom as classe', 'matieres.nom', 'cours.fichier','cours.created_at','cours.matiere')
            ->orderBy('cours.id','asc')
            ->get();

        return view('index/coursEtu', \compact('utilisateur', 'cour','course'));
    }


    public function coursDetail(passePartout $re){
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }
        $utilisateur = auth()->user();

        if($utilisateur->type=='enseignant'){
        $cour_type=decrypt($re->cour);
        $cour_mat=decrypt($re->mat);

            $cours = cour::join('matieres', 'matieres.id', '=', 'cours.matiere')
        ->where([
            ['cours.matiere', $cour_mat],
        ])
        ->select('cours.id as id_cours','cours.libelle', 'matieres.nom as classe', 'matieres.nom', 'cours.fichier','cours.created_at','cours.matiere')
        ->orderBy('cours.id','asc')
        ->get();

    }else{
            $cours = cour::join('matieres', 'matieres.id', '=', 'cours.matiere')
            ->where([
                ['cours.matiere', decrypt($re->mat)],
            ])
            ->select('cours.id as id_cours','cours.libelle', 'matieres.nom as classe', 'matieres.nom', 'cours.fichier','cours.created_at','cours.matiere')
            ->orderBy('cours.id','asc')
            ->get();
        }


        $course = cour::join('matieres', 'matieres.id', '=', 'cours.matiere')
        ->where([
            ['cours.id', decrypt($re->cour)],
        ])
        ->select('cours.id as id_cours','cours.libelle', 'matieres.nom as classe', 'matieres.nom', 'cours.fichier','cours.created_at')
        ->get();


        $reponse=kuestion::join('cours','cours.id','=','kuestions.cour')
        ->join('comptes','comptes.id','=','kuestions.compte')
        ->where([
            ['kuestions.cour',decrypt($re->cour)],
        ])
        ->orderBy('kuestions.id','asc')
        ->select('cours.id','kuestions.message','kuestions.compte','kuestions.created_at',
        'kuestions.cour','kuestions.id','comptes.nom','comptes.prenom','comptes.photo')
        ->get();

        return view('index/coursDetails', \compact('utilisateur','cours','course','reponse'));
    }



    public function getDownload(passePartout $re){

        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        $reponse= cour::join('matieres', 'matieres.id', '=', 'cours.matiere')
        ->where([
            ['cours.id', $re->id],
        ])
        ->select('cours.libelle','matieres.nom', 'cours.fichier')
        ->get();

    $file= public_path().'/storage/cours/'. $reponse[0]->fichier;
    $title=$reponse[0]->libelle.'_'.$reponse[0]->nom;
    $headers = [
        'Content-Type' => 'application/pdf',
     ];

    return response()->download($file,$title,$headers);
    }

    public function kuestion(passePartout $re){
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if ($re->ajax()) {
            $reponse=kuestion::create([
                'compte'=>auth()->user()->id,
                'cour'=>$re->cour,
                'message'=>$re->comment,
            ]);

            if ($reponse) {
                return response(1);
            }

        }

    }


    public function reponse(passePartout $re){
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if ($re->ajax()) {
            $reponse=reponse::create([
                'compte'=>auth()->user()->id,
                'question'=>$re->kuestion,
                'message'=>$re->comment,
            ]);

            if ($reponse) {
                return response(1);
            }

        }

    }

    public function suite_reponse(passePartout $re){
        if ($re->ajax()) {
            if (auth()->guest()) {
                Flashy::error('connectez vous!!');
                return redirect()->route('home');
            }

            $reponse=reponse::join('comptes','comptes.id','=','reponses.compte')
            ->where([
                ['reponses.question',$re->kuestion],
            ])
            ->orderBy('reponses.id','asc')
            ->select('reponses.question','reponses.message','reponses.created_at',
            'comptes.nom','comptes.prenom','comptes.photo','reponses.id')
            ->get();

            if ($reponse) {
                return $reponse;
            }
        }
    }

    public function supp_kuestion(passePartout $re){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        if ($re->ajax()) {
            $reponse=kuestion::destroy($re->id);
            if($reponse){
                return 1;
            }
        }
    }

    public function supp_reponse(passePartout $re){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        if ($re->ajax()) {
            $reponse=reponse::destroy($re->id);
            if($reponse){
                return 1;
            }
        }
    }
}
