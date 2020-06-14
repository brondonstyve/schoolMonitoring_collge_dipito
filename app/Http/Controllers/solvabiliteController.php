<?php

namespace App\Http\Controllers;

use App\filiere;
use App\Http\Requests\passePartout;
use App\Mail\ContactMessageCreated;
use App\models\cahier;
use App\models\classe;
use App\models\Paiement;
use App\models\taux_paiement;
use App\model\salaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MercurySeries\Flashy\Flashy;

class solvabiliteController extends Controller
{
    public function solvabilite(passePartout $request)
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $classe = classe::join('filieres', 'filieres.id', '=', 'classes.filiere')
            ->select('classes.id', 'classes.filiere', 'classes.niveau',
                'classes.code_classe as code_classe', 'filieres.nom', 'filieres.code as code_f')
            ->orderBy('classes.updated_at', 'desc')
            ->paginate(5);

        return view('administration/solvabilite', compact('utilisateur', 'classe'));
    }

    public function totalApayer(passePartout $request)
    {
        $reponse = classe::join('filieres', 'filieres.id', '=', 'classes.filiere')
            ->where([
                ['classes.nom_classe', $request->classe],
            ])
            ->select('classes.filiere', 'classes.niveau')
            ->get();

        $reponse = taux_paiement::whereFiliereAndNiveau($reponse[0]->filiere, $reponse[0]->niveau)
            ->sum('montant');
        return response($reponse);
    }

    public function listeSolvabilite(passePartout $request)
    {
        if ($request->ajax()) {
            $reponse = DB::table('paiements')
                ->whereClasse($request->classe)
                ->select(DB::raw('matricule,nom,prenom,classe,sum(montant) as montant'))
                ->groupBy('matricule', 'nom', 'prenom', 'classe')
                ->get();
        }
        return response($reponse);
    }

    public function fixer_Solvabilite(passePartout $request)
    {
        if ($request->ajax()) {
            $reponse = taux_paiement::join('filieres', 'filieres.id', '=', 'taux_paiements.filiere')
                ->where([
                    ['taux_paiements.filiere', $request->filiere],
                ])
                ->get();
            if (sizeOf($reponse) >= 1) {
                return response('la filiere "' . $reponse[0]->nom . '" dispose déjà des prix fixés.. veuillez plutot  les modifier');
            } else {
                $reponse1 = taux_paiement::create([
                    'filiere' => $request->filiere,
                    'niveau' => 0,
                    'libelle' => "tranche1",
                    'montant' => $_POST["montant"],
                    'penalite' => $request->penalite,
                    'date' => $_POST["date"],
                ]);

                for ($i = 2; $i <= $request->nbtranche; $i++) {
                    $reponse = taux_paiement::create([
                        'filiere' => $request->filiere,
                        'niveau' => 0,
                        'libelle' => "tranche$i",
                        'montant' => $_POST["montant$i"],
                        'penalite' => $request->penalite,
                        'date' => $_POST["date$i"],
                    ]);
                }
                if ($reponse) {
                    return response('enregistrement éffectué avec succès');
                } else {
                    if ($reponse1) {
                        return response('enregistrement éffectué avec succès');
                    }
                }

            }
        }
    }

    //penalités a revoir

    public function penalite()
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $classe = classe::join('filieres', 'filieres.id', '=', 'classes.filiere')
            ->select('classes.id', 'classes.filiere', 'classes.niveau',
                'classes.code_classe as code_classe', 'filieres.nom', 'filieres.code as code_f')
            ->orderBy('classes.updated_at', 'desc')
            ->paginate(5);

        return view('administration/penalite', compact('utilisateur', 'classe'));
    }

    public function listePenalite(passePartout $request)
    {
        if ($request->ajax()) {
            $reponse = Paiement::whereClasse($request->classe)
                ->select('matricule', 'nom', 'prenom', 'classe', 'montant', 'date')
                ->get();
        }
        return response($reponse);
    }

    public function dateDePaiement(passePartout $request)
    {
        $reponse = classe::join('filieres', 'filieres.id', '=', 'classes.filiere')
            ->where([
                ['classes.nom_classe', $request->classe],
            ])
            ->select('classes.filiere', 'classes.niveau')
            ->get();

        $reponse = taux_paiement::whereFiliereAndNiveau($reponse[0]->filiere, $reponse[0]->niveau)
            ->select('date', 'libelle')
            ->get();
        return response($reponse);
    }

    public function payerEns(passePartout $request)
    {

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $reponse = salaire::join('matricules', 'matricules.id', '=', 'salaires.matricule')
            ->select('salaires.salaire', 'salaires.horaire', 'matricules.matricule', 'matricules.nom',
                'matricules.prenom', 'matricules.id')
            ->where([
                ['matricules.matricule', $request->matricule],
            ])
            ->get();

        if (sizeOf($reponse) == 0) {
            Flashy::error('Matricule inexistant');
            return redirect()->route('accueil_index_path');
        } else {

            $cahier = cahier::join('comptes', 'comptes.id', '=', 'cahiers.compte')
                ->where([
                    ['comptes.matricule', $request->matricule],
                ])
                ->count() * 2;

            $detail = cahier::join('comptes', 'comptes.id', '=', 'cahiers.compte')
                ->join('matieres', 'matieres.id', '=', 'cahiers.matiere')
                ->where([
                    ['comptes.matricule', $request->matricule],
                ])
                ->select('cahiers.created_at as date', 'cahiers.libelle', 'matieres.nom', 'matieres.classe')
                ->orderBy('cahiers.created_at', 'desc')
                ->paginate(10);

            return view('administration.paie', compact('reponse', 'utilisateur', 'cahier', 'detail'));
        }

    }

    public function valider_paie(passePartout $request)
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        if ($request->montant == 0) {
            Flashy::error('Montant null! impossible de payer');
            return redirect()->route('accueil_index_path');
        }

        $reponse = salaire::whereMatricule($request->matricule)
            ->update([
                'horaire' => $request->new_horaire,
            ]);
        if ($reponse) {
            try {

                sleep(0);
                $mailable = new ContactMessageCreated($utilisateur->nom, $utilisateur->email, 'le compte du nom de :' . $utilisateur->nom . ' ' . $utilisateur->prenom . ' vient d\'éffectuer un versement de ' . $request->montant . ' au matricule ' . $request->mat);
                Mail::to('Scolaire@gmail.com')->send($mailable);
                Flashy::success('Paiement enregistré avec succès');
                return redirect()->route('accueil_index_path');

            } catch (\Throwable $th) {
                Flashy::error('erreur reseau.vérifiez votre connexion!');
                return redirect()->route('accueil_index_path');
            }
        } else {
            Flashy::success('Erreur!!');
            return redirect()->route('accueil_index_path');
        }

    }

    public function voir_taux(passePartout $request)
    {
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();

        $reponse = filiere::join('taux_paiements', 'taux_paiements.filiere', '=', 'filieres.id')
            ->where([
                ['taux_paiements.filiere', $request->filiere],
            ])
            ->select('taux_paiements.libelle', 'taux_paiements.montant', 'taux_paiements.penalite', 'taux_paiements.date',
                'filieres.nom', 'taux_paiements.niveau')
            ->get();

        $filiere = filiere::whereId($request->filiere)
            ->get('nom');

        $niveau = $request->niv;

        return view('administration/taux', compact('utilisateur', 'reponse', 'filiere', 'niveau'));
    }



}
