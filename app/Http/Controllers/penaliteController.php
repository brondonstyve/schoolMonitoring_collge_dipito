<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Matricule;
use App\models\moratoire;
use App\models\Paiement;
use App\models\taux_paiement;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class penaliteController extends Controller
{
    public function penalite(){
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

        return view('administration/penalite',compact('utilisateur','classe'));
    }


    //
    public function listePenalite(passePartout $request){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur = auth()->user();
        $classe=($_GET["classe"]);
        $filiere=($_GET["filiere"]);
        $niveau=($_GET["niveau"]);

            $liste=matricule::whereClasse($_GET['classe'])
            ->get();

            $resultat=taux_paiement::whereFiliereAndNiveau($filiere,$niveau)
            ->get();


            $paiement=Paiement::whereClasse($classe)
            ->get();

            $moratoire=moratoire::whereClasse($classe)
            ->select('tranche','date','matricule')
            ->get();


        return view('administration/eleve',compact('utilisateur','liste','resultat','paiement','moratoire'));



        }


        public function payer_penalite(passePartout $request){
            if (auth()->guest()) {
                Flashy::error('connectez vous');
                return redirect()->route('home');
            }
            $utilisateur=auth()->user();

            $resultat=classe::whereNom_classe($request->classe)
            ->select('filiere','niveau')
            ->get();

            if (sizeOf($resultat)==1) {
                $resultat=taux_paiement::whereFiliereAndNiveau($request->filiere,$request->niveau)
                ->get();


                $paiement=Paiement::whereMatricule($request->mat)
                ->select('libelle','montant','date','date_limite','id','nom','prenom','classe')

                ->get();
            }

            //return $resultat;


            return view('administration/paye_penalite',compact('utilisateur','resultat','paiement'));


        }

        public function val_payer_penalite(passePartout $request){
            if (auth()->guest()) {
                Flashy::error('connectez vous');
                return redirect()->route('home');
            }

            //return $_POST["payer0"];
            $test=0;
            for ($i=0; $i <$request->nbre ; $i++) {
                if (!empty($_POST["payer$i"])) {
                    $test=1;
                    $reponse=Paiement::find($_POST["payer$i"]);

                    $reponse2=Paiement::whereId($_POST["payer$i"])
                    ->update(
                        [
                            'date'=>$reponse->date_limite,
                        ]
                    );

                }
            }


                if ($test==0) {
                    Flashy::error('Cochez au moins une case pourla pénalité à payer');
                    return redirect()->route('solvabilite_path');
                } else {
                    Flashy::error('solvabilité payée avec succès');
                    return redirect()->route('solvabilite_path');
                }

        }


}
