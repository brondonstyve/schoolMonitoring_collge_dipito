<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\epreuve;
use App\models\evaluation;
use App\models\Matiere;
use App\models\note;
use App\models\notification;
use App\models\sequence;
use App\models\statutEvaluation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class evaluationController extends Controller
{

    //--Charger la page evaluation
    public function evaluation()
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        $utilisateur = auth()->user();
        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }



        //cas du prof
        if ($utilisateur->type == "enseignant") {

            $classe_mat = DB::table('matieres')
                ->select('nom', 'classe', 'id')
                ->whereCompte($utilisateur->id)
                ->get();

            $epreuve = DB::table('epreuves')
                ->where([
                    ['compte', $utilisateur->id],
                ])
                ->orderBy('updated_at', 'desc')
                ->get();

            $prof = DB::table('comptes')
                ->select('id', 'nom', 'prenom')
                ->where([
                    ['type', 'enseignant'],
                    ['id', '<>', $utilisateur->id],
                ])
                ->get();

            //dd($prof);

            $evaluation = DB::table('evaluations')
                ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
                ->join('matieres', 'matieres.id', '=', 'evaluations.matiere')
                ->select('evaluations.id', 'evaluations.compte', 'evaluations.matiere', 'evaluations.libelle', 'evaluations.statut',
                    'epreuves.editeur', 'epreuves.matiere', 'epreuves.reponse', 'epreuves.epreuve', 'evaluations.dure', 'matieres.classe as class_mat', 'matieres.nom')
                ->where([
                    ['evaluations.compte', $utilisateur->id],
                ])
                ->orderBy('evaluations.updated_at', 'desc')
                ->get();
            //return $evaluation;

            $classe_a_evaluer = DB::table('matieres')
                ->distinct()
                ->select('classe')
                ->whereCompte($utilisateur->id)
                ->get();

            $sekuence=sequence::get('nbsequence');
            if (sizeOf($sekuence)==1) {
                $sekuence=$sekuence[0]->nbsequence;
            }else{
                $sekuence=0;
            }
            $createForm = true;
            $createEpreuve = false;
        return view('index/evaluation', compact('utilisateur', 'classe_mat', 'classe_a_evaluer',  'createForm', 'createEpreuve', 'epreuve', 'prof', 'evaluation','sekuence'));

        }
        //return $classe_a_evaluer;

        //Changement déetats
        $createForm = true;
        $createEpreuve = false;

        //cas de l'etudiant
        if ($utilisateur->type == null) {

            $evaluation = DB::table('evaluations')
                ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
                ->join('matieres', 'matieres.id', '=', 'evaluations.matiere')
                ->select('matieres.nom', 'matieres.classe', 'evaluations.compte', 'evaluations.matiere', 'evaluations.libelle', 'evaluations.dure', 'epreuves.epreuve',
                    'epreuves.editeur', 'evaluations.id', 'epreuves.reponse', 'evaluations.created_at', 'evaluations.updated_at')
                ->where([
                    ['matieres.classe', $utilisateur->classe],
                    ['evaluations.statut', true],
                ])
                ->paginate(2);

            $heure_de_debut = array();
            for ($i = 0; $i < sizeOf($evaluation); $i++) {
                $date = Carbon::create($evaluation[$i]->updated_at);
                $heure_de_debut[$i] = $date->format('Y-m-d') . '  de ' . $date->format('H:i') . ' à ' . $date->addMinutes($evaluation[$i]->dure)->format('H:i');

            }

            $test = true;
            return view('index/evaluation', compact('utilisateur', 'heure_de_debut', 'test', 'createForm', 'createEpreuve',  'evaluation'));
        }

        //$adresse=$_SERVER['REMOTE_HOST'];
        //dd($adresse) ;

    }

    //--generateur d'epreuve
    public function generateur(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        $utilisateur = auth()->user();
        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }

        $classe_a_evaluer = DB::table('matieres')
            ->distinct()
            ->select('classe')
            ->whereCompte($utilisateur->id)
            ->get();

        $epreuve = DB::table('epreuves')
            ->where([
                ['compte', $utilisateur->id],
            ])
            ->orderBy('updated_at', 'desc')
            ->get();

        $prof = DB::table('comptes')
            ->select('id', 'nom', 'prenom')
            ->where([
                ['type', 'enseignant'],
                ['id', '<>', $utilisateur->id],
            ])
            ->get();

        $matiere_classe = \explode('->', $request->matiere);
        $libelle = $request->libelle;
        $dure = $request->dure;
        $nbre_k = $request->nbre_kuestion;

        $sekuence=sequence::get('nbsequence');
            if (sizeOf($sekuence)==1) {
                $sekuence=$sekuence[0]->nbsequence;
            }else{
                $sekuence=0;
            }
        //Changement déetats
        $createForm = false;
        $createEpreuve = true;
        //dd($matiere.$libelle.$dure.$nbre_K);
        return view('index/evaluation', compact('utilisateur','sekuence','createForm', 'prof', 'epreuve', 'classe_a_evaluer', 'createEpreuve', 'libelle', 'dure', 'nbre_k', 'matiere_classe'));
    }

    //--Enregistrer epreuve
    public function enregistrer(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur = auth()->user();
        $reponse = '';
        $fichier = $request->file('fichier');
        $fichierCheminPublic = '/public/epreuve/';
        $nomFichier = time() . $fichier->getClientOriginalName();
        $stockage = $fichier->storeAs($fichierCheminPublic, $nomFichier);
        $nom = $utilisateur->nom . ' ' . $utilisateur->prenom;
        $id_epreuve = explode('.', $request->matiere);

        for ($i = 0; $i < $request->nbre; $i++) {
            $reponse = $reponse . $_POST["kcm$i"] . '.';
        }

        $eval = epreuve::create([
            'compte' => $utilisateur->id,
            'id_matiere' => $id_epreuve[0],
            'editeur' => $nom,
            'matiere' => $request->matiere,
            'classe' => $request->classe,
            'epreuve' => $nomFichier,
            'reponse' => $reponse,
            'libelle' => $request->libelle,
        ]);

        if ($eval && $stockage) {
            Flashy::success('épreuve crée avec succès');
            return redirect()->route('evaluation_path');
        } else {
            Flashy::success('échec');
            return redirect()->route('evaluation_path');
        }
    }

    //modifier les epreuve
    public function modifier(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }

        $reponse = '';
        $utilisateur = auth()->user();
        $compteur = 0;

        for ($i = 0; $i < $request->nbre; $i++) {
            $reponse = $reponse . $_POST["reponse$i"] . '.';
        }

        $id_epreuve = explode('.', $request->matiere);
        $matiere = explode('->', $request->matiere)[0];
        $classe = explode('->', $id_epreuve[1])[1];

        $modif = epreuve::whereId($request->id_epreuve)
            ->update([
                'id_matiere' => $id_epreuve[0],
                'reponse' => $reponse,
                'classe' => $classe,
                'matiere' => $matiere,
            ]);

        if ($modif) {
            Flashy::success('épreuve modifié avec succès');
            return redirect()->route('evaluation_path');
        } else {
            Flashy::success('échec de modification');
            return redirect()->route('evaluation_path');
        }

    }
    //--Envoyer epreuve
    public function envoyerEpreuve(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }

        $prof_id_nom = explode('-', $request->path_prof);

        $test_Dispo_Epreuve = epreuve::where([
            ['epreuve', $request->nomEpreuve],
            ['compte', $prof_id_nom[0]],
        ])
            ->get();
        if (sizeOf($test_Dispo_Epreuve) == 1) {
            Flashy::error('l\'enseignant ' . $request->nom . 'a déjà à sa disposition cette epreuve');
            return redirect()->route('evaluation_path');
        }

        $replikeur = epreuve::find($request->idEpreuve);
        $replikeur = $replikeur->replicate();
        $replikeur->compte = $prof_id_nom[0];
        $replikeur->classe = '';
        $resultat = $replikeur->save();
        if ($resultat) {
            Flashy::success('Fichier envoyé avec succès');
            return redirect()->route('evaluation_path');
        } else {
            Flashy::error('échec!!');
            return redirect()->route('evaluation_path');
        }

    }

    //--supprimer epreuve
    public function supprimerEpreuve(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }

        $id = $_GET["path_directori"];
        $epreuveSup = DB::table('epreuves')
            ->whereId($id)
            ->delete();

        if ($epreuveSup) {
            Flashy::success('épreuve supprimé');
            return redirect()->route('evaluation_path');
        } else {
            Flashy::error('erreur de suppression');
            return redirect()->route('evaluation_path');
        }
    }

    //--Créer l'évaluation dune classe
    public function evaluerClasse()
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $evaluation = DB::table('epreuves')
            ->whereId($_GET["path_directori"])
            ->get();

        $matiere = explode('.', $_GET['path_directoric'])[1];
        $cl=$_GET['path_dir'];

        $classe_mat = DB::table('matieres')
            ->select('id', 'nom', 'classe')
            ->whereCompteAndNomAndClasse($utilisateur->id, $matiere, $cl)
            ->get();
            $sekuence=sequence::get('nbsequence');
            if (sizeOf($sekuence)==1) {
                $sekuence=$sekuence[0]->nbsequence;
            }else{
                $sekuence=0;
            }

        $test = false;
        $test1 = true;
        return view('index/epreuve', compact('utilisateur','sekuence','evaluation', 'classe_mat', 'test', 'test1'));
    }

    //--enregistrer une evaluation
    public function enregistrerEvalution(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur = auth()->user();

        for ($i = 0; $i < $request->compteur; $i++) {
            if (!empty($_POST["classe$i"])) {
                $id_mat = explode('.', $_POST["classe$i"]);
                $env = evaluation::whereCompteAndMatiereAndLibelle($utilisateur->id, $id_mat[0], $request->libelle)
                    ->get();

                if (sizeOf($env) == 1) {
                    Flashy::error('l\'évaluation de ' . $id_mat[1] . ' existe deja');
                    return redirect()->route('evaluation_path');
                }
            }
        }

        if ($request->compteur > 0) {
            $matiere = '';
            $test = false;
            $evaluation = false;
            for ($i = 0; $i < $request->compteur; $i++) {
                if (!empty($_POST["classe$i"])) {

                    $id_mat = explode('.', $_POST["classe$i"]);

                    $env = evaluation::where([
                        ['libelle', $request->libelle],
                        ['compte', $utilisateur->id],
                        ['matiere', $id_mat[0]],
                        ['epreuve', $request->idEpreuve],

                    ])
                        ->get();

                    if (sizeOf($env) != 0) {
                        $test = true;
                        $decomp = explode('->', $_POST["classe$i"]);
                        $matiere = $matiere . $decomp[0] . ' en ' . $decomp[1];
                    } else {
                        $test = false;
                        $evaluation = evaluation::create([
                            'compte' => $utilisateur->id,
                            'epreuve' => $request->idEpreuve,
                            'matiere' => $id_mat[0],
                            'libelle' => $request->libelle,
                            'dure' => $request->dure,
                        ]);
                    }

                }
            }

            if ($test) {
                Flashy::error('detection d\'existance!! l\'évaluation de ' . $matiere . ' existe deja');
                return redirect()->route('evaluation_path');
            }

            if ($evaluation) {
                Flashy::success('évaluation enregistrée avec succès');
                return redirect()->route('evaluation_path');
            } else {
                Flashy::error('erreur de création, cocher une matière.');
                return redirect()->route('evaluation_path');
            }

        } else {
            Flashy::error('veuillez selectionner une classe');
            return back();
        }

    }

    // supprimer une evaluation
    public function supprimerEvaluation(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }

        $id = $_GET["path_direc"];
        $evaluation = DB::table('evaluations')
            ->whereId($id)
            ->delete();

        if ($evaluation) {
            Flashy::success('évaluation supprimé');
            return redirect()->route('evaluation_path');
        } else {
            Flashy::error('erreur de supp ression');
            return redirect()->route('evaluation_path');
        }
    }

    //--voir une evaluation
    public function modifierEvaluation()
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $modif_evaluation = DB::table('evaluations')
            ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
            ->join('matieres', 'matieres.id', '=', 'evaluations.matiere')
            ->select('matieres.nom', 'matieres.classe', 'evaluations.libelle', 'evaluations.dure', 'epreuves.epreuve', 'epreuves.editeur', 'evaluations.id', 'epreuves.reponse')
            ->where([
                ['evaluations.id', $_GET["path_directrieRetry"]],

            ])
            ->get();

        $classe_mat = DB::table('matieres')
            ->select('nom', 'classe')
            ->whereCompte($utilisateur->id)
            ->get();

        $test = true;
        $test1 = false;

        return view('index/epreuve', compact('utilisateur', 'test', 'test1', 'modif_evaluation', 'classe_mat'));

    }

    //modifier duree evaluation

    public function modifierDureEvaluation(passePartout $request)
    {

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }

        $id = decrypt($request->di);
        $mod = Evaluation::whereId($id)
            ->update([
                'dure' => $request->dure,
            ]);

        if ($mod) {
            Flashy::success('modification réalisé avec succèss');
            return redirect()->route('evaluation_path');
        } else {
            Flashy::error('erreur');
            return redirect()->route('evaluation_path');
        }

    }

    //supprimer toutes les evaluations

    public function supprimerToutEvaluation()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $supp = evaluation::whereCompte($utilisateur->id)
            ->delete();

        if ($supp) {
            Flashy::success('Toutes vos évaluations on été effacé avec succèss!!');
            return redirect()->route('evaluation_path');
        }
    }

    //supprimer toutes les epreuves

    public function supprimerToutEpreuve()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $supp = epreuve::whereCompte($utilisateur->id)
            ->delete();

        if ($supp) {
            Flashy::success('Toutes vos épreuves on été effacé avec succèss!!');
            return redirect()->route('evaluation_path');
        }
    }

    //composition d'un etudiant

    public function composer()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous!');
            return redirect()->route('home');
        }

        $utilisateur = auth()->user();
        $id = decrypt($_GET['path_directoriesRender']);
        $date_actuelle = Carbon::now();

        $stat = statutEvaluation::whereCompteAndEvaluation($utilisateur->id, $id)
            ->select('statut')
            ->get();

        //dd($stat);
        for ($i = 0; $i < sizeOf($stat); $i++) {
            if ($stat[0]->statut) {
                Flashy::error($utilisateur->prenom . ' vous avez déjà composé cette matière!!');
                return redirect()->route('evaluation_path');
            }
        }

        $evaluation = DB::table('evaluations')
            ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
            ->join('matieres', 'matieres.id', '=', 'evaluations.matiere')
            ->select('evaluations.id as evaluation_id', 'epreuves.id as id_epreuve', 'epreuves.epreuve as fichier', 'evaluations.libelle',
                'epreuves.id_matiere', 'epreuves.classe', 'evaluations.dure', 'evaluations.updated_at', 'matieres.nom as matiere')
            ->where([
                ['evaluations.id', $id],
            ])
            ->get();

        $nbre_k = DB::table('evaluations')
            ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
            ->select('epreuves.reponse')
            ->where([
                ['evaluations.id', $id],
            ])
            ->get();

        $nbre_k = sizeOf(explode('.', $nbre_k[0]->reponse)) - 1;

        if (sizeOf($evaluation) != 0) {

            //date de debut
            $date_de_debut = Carbon::create($evaluation[0]->updated_at);
            //temps ecoulé
            $date_de_fin = Carbon::create($evaluation[0]->updated_at)->addMinutes($evaluation[0]->dure);
            //$chrono=
            $temps_ecoule_minute = $date_de_debut->diffInMinutes($date_actuelle);
            $temps_restant = $evaluation[0]->dure - $temps_ecoule_minute;

            if ($date_actuelle < $date_de_debut) {
                Flashy::error('ce n \'est pas encore l\'heure de l\'évaluation.!!');
                return redirect()->route('evaluation_path');
            } else {
                if ($date_actuelle > $date_de_fin) {
                    Flashy::error('l\'évaluation est terminée!!');
                    return redirect()->route('evaluation_path');
                } else {

                    $stat = statutEvaluation::whereCompteAndEvaluation($utilisateur->id, $id)->get();

                    if (sizeOf($stat) == 0) {
                        //signature kil a lancé la composition
                        statutEvaluation::create([
                            'compte' => $utilisateur->id,
                            'evaluation' => $id,
                            'statut' => false,
                        ]);
                    }

                    $reponse = array('a', 'b', 'c', 'd');
                    $compo = true;
                    return view('index/composition', compact('utilisateur', 'evaluation', 'reponse', 'nbre_k', 'compo', 'temps_restant'));
                }

            }

        } else {
            echo 'l évaluation est deja terminée!!';
        }

    }

    public function composition(passePartout $request)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        if (auth()->guest()) {
            Flashy::error('Connectez vous!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();
        $id_evaluation = decrypt($request->evaluation);
        $sek=decrypt($request->sek);

        $stat = statutEvaluation::whereCompteAndEvaluation($utilisateur->id, $id_evaluation)
            ->select('statut')
            ->get();

        for ($i = 0; $i < sizeOf($stat); $i++) {
            if ($stat[0]->statut) {
                Flashy::error($utilisateur->prenom . ' vous avez déjà composé cette matière!!');
                return redirect()->route('evaluation_path');
            }
        }
        $nbre_k = decrypt($request->nbre_rep);

        $reponse_etudiant = '';

        $reponse_prof = evaluation::join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
            ->select('epreuves.reponse', 'evaluations.libelle', 'evaluations.matiere', 'evaluations.libelle', 'epreuves.matiere')
            ->where([
                ['evaluations.id', $id_evaluation],
            ])
            ->get();

        for ($i = 0; $i < $nbre_k; $i++) {
            $reponse_etudiant = $reponse_etudiant . $_POST["kcm$i"] . '.';
        }

        $libelle = $reponse_prof[0]->libelle;
        $matiere = explode('.', $reponse_prof[0]->matiere)[1];
        $id_mat = explode('.', $reponse_prof[0]->matiere)[0];
        $reponse_prof = $reponse_prof[0]->reponse;
        $rep_etud = $reponse_etudiant;
        $rep_prof = $reponse_prof;

        //si tout trouvé
        if ($reponse_prof == $reponse_etudiant) {
            $note = 20;
            $compteur = sizeOf(explode('.', $reponse_prof)) - 1;
        }
        //si non
        else {
            $note = 0;
            $reponse_prof = explode('.', $reponse_prof);
            $reponse_etudiant = explode('.', $reponse_etudiant);
            for ($i = 0; $i < sizeOf($reponse_prof) - 1; $i++) {
                if ($reponse_prof[$i] == $reponse_etudiant[$i]) {
                    $note = $note + 1;
                } else {
                    //mise a jour avec les system -0.25
                }

            }
            //sortie du for
            $compteur = $note;
            $note = ($note / (sizeOf($reponse_prof) - 1)) * 20;
            $note = number_format($note, 2);

        }



        $note_rech = note::whereCompteAndMatiereAndSequence($utilisateur->mat, $id_mat,$sek )->get();

        if (sizeOf($note_rech) == 0) {
            $maj = note::create([
                'compte' => $utilisateur->mat,
                'matiere' => $id_mat,
                "note" => $note,
                'sequence' => $sek,

            ]);
        } else {
            $maj = note::whereCompteAndMatiereAndSequence($utilisateur->mat, $id_mat,$sek)
                ->update([
                    "note" => $note,
                ]);
        }

        statutEvaluation::whereCompteAndEvaluation($utilisateur->id, $id_evaluation)
            ->update([
                'statut' => true,
            ]);

        if ($maj) {
            $compo = false;
            Flashy::success('Votre note en ' . $matiere . ' pour la séquence à été mis a jour');
            return view('index/composition', compact('note', 'utilisateur', 'rep_prof', 'rep_etud', 'compo', 'compteur', 'libelle', 'matiere'));

        } else {
            Flashy::error('Erreur');
            return redirect()->route('evaluation_path');
        }

    }

    public function programmer_eval()
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }


        $evaluation = DB::table('evaluations')
            ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
            ->join('matieres', 'matieres.id', '=', 'evaluations.matiere')
            ->select('evaluations.id as evaluation_id', 'epreuves.id as id_epreuve', 'epreuves.epreuve as fichier', 'evaluations.libelle',
                'epreuves.id_matiere', 'epreuves.classe', 'evaluations.dure', 'evaluations.updated_at', 'matieres.nom as matiere')
            ->where([
                ['evaluations.statut',true]
                ])
            ->get();

        $date_actuelle = Carbon::now();

        for ($i = 0; $i < sizeOf($evaluation); $i++) {

            //date de debut
            $date_de_debut = Carbon::create($evaluation[$i]->updated_at);
            //temps ecoulé
            $date_de_fin = Carbon::create($evaluation[$i]->updated_at)->addMinutes($evaluation[$i]->dure);


                if ($date_actuelle > $date_de_fin) {
                    evaluation::destroy($evaluation[$i]->evaluation_id);

                }

        }


        $utilisateur = auth()->user();
        $filiere = DB::table('evaluations')
            ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
            ->join('matieres', 'matieres.id', '=', 'evaluations.matiere')
            ->select('matieres.nom', 'matieres.classe', 'evaluations.id', 'evaluations.dure', 'evaluations.statut')
            ->get();

        return view('administration/evaluation', compact('utilisateur', 'filiere'));
    }

    public function lancer_eval_ad(passePartout $request)
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if ($request->ajax()) {
            $classe=evaluation::join('epreuves','epreuves.id','=','evaluations.epreuve')
            ->select('epreuves.classe','epreuves.matiere')
            ->where([
                ['evaluations.id',$request->id]
            ])
            ->get();

            $reponse = evaluation::whereId($request->id)
                ->update([
                    'statut' => true,
                ])
            ;
        }
        if ($reponse) {
            $matiere=explode('.',$classe[0]->matiere);
            $reponse=notification::create([
                'compte'=>0,
                'matricule'=>'',
                'type'=>'Evaluation',
                'message'=>'l\'évaluation de '.$matiere[1].' est lancé',
                'classe'=>$classe[0]->classe,
            ]);
            return response('epreuve lancé avec succès');
        } else {
            return response('erreur');
        }
    }

    public function suspendre_eval_ad(passePartout $request)
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if ($request->ajax()) {
            $reponse1 = evaluation::whereId($request->id)
                ->update([
                    'statut' => false,
                ])
            ;

            $reponse = statutEvaluation::whereEvaluation($request->id)
            ->delete();
            ;
        }
        if ($reponse1) {
            return response('epreuve suspendue avec succès');
        } else {
            return response('erreur');
        }
    }

    public function supp_eval_ad(passePartout $request)
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        if ($request->ajax()) {
            $reponse = evaluation::destroy($request->id);
        }
        if ($reponse) {
            return response('epreuve supprimée avec succès');
        } else {
            return response('erreur');
        }
    }
}
