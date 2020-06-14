<?php

namespace App\Http\Controllers;

use App\filiere;
use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Matricule;
use App\models\moratoire;
use App\models\Paiement;
use App\models\taux_paiement;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class moratoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateur = auth()->user();

        $classe=classe::join('filieres','filieres.id','=','classes.filiere')
                ->select('classes.id','classes.filiere','classes.niveau',
                         'classes.code_classe as code_classe','filieres.nom','filieres.code as code_f','filieres.id as id_fil')
                ->orderBy('classes.updated_at','desc')
                ->paginate(5);



    return view('administration/moratoire',compact('utilisateur','classe'));
    }

    public function listeTranches(passePartout $request)
    {
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

        $eleve=Matricule::whereId($request->id)
        ->select('id','nom','prenom','classe','matricule')
        ->get();

        $niveau = $request->niv;

        $resultat=classe::whereNom_classe($request->classe)
        ->select('filiere','niveau')
        ->get();


        if (sizeOf($resultat)==1) {
            $resultat=taux_paiement::whereFiliereAndNiveau($resultat[0]->filiere,$resultat[0]->niveau)
            ->get();


            $paiement=Paiement::whereMatricule($request->matricule)
            ->select('libelle','montant','date','date_limite')

            ->get();
        }

        return view('administration/liste_tranche', compact('utilisateur', 'reponse', 'filiere', 'niveau','eleve','resultat','paiement'));
    }


    public function payer(passePartout $request){
        if ($request->ajax()) {
            $reponse=Paiement::whereMatriculeAndLibelle($request->matri,$request->tranche)
            ->count();

            if ($reponse>0) {
                return response('cet élève a déjà payé cette partie de sa pension');

            }else{
                $reponse=moratoire::whereMatriculeAndTranche($request->matricule,$request->tranche)
                ->count();


                if ($reponse>0) {
                    return response('cette élève dispose déjà d\'un moratoire pour cette échéance');
                } else {
                    $date_new=Date($request->date);
                    $date_anc=Date($request->ancDate);
                    if ($date_new>$date_anc) {
                        $reponse=moratoire::create([
                            'matricule'=>$request->matricule,
                            'date'=>$request->date,
                            'tranche'=>$request->tranche,
                            'classe'=>$request->classe,
                        ]);

                        if ($reponse) {
                            return response('enregistrement effectué avec succès');
                        }
                    } else {
                        return response('la date du moratoire doit être suppérieur à celle de la date d\'échéance');

                    }
                }
            }






        }

    }

}
