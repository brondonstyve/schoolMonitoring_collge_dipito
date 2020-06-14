<?php

namespace App\Http\Controllers;

use App\filiere;
use Illuminate\Http\Request;
use App\Http\Requests\infosPayementRequest;
use App\models\Paiement;
use App\models\Matricule;
use App\Http\Requests\PaiementRequest;
use App\Http\Requests\paiementSuiteRequest;
use App\Http\Requests\passePartout;
use App\Mail\ContactMessageCreated;
use App\models\classe;
use App\models\notification;
use App\models\taux_paiement;
use App\models\tuteur;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class paiementController extends Controller
{
    public function Paiement(infosPayementRequest $request){


    $reponse=taux_paiement::whereFiliereAndNiveau($request->filiere,0)
    ->select('libelle','montant','date','penalite')
    ->get();
    //return $reponse;

        if(!auth()->guest()){
            $type=auth()->user()->type;
        }else {
            $type='';
        }

        $filiere=$request->filiere;
        $niveau=$request->niv;
        $classe=$request->classe;
        $nom=$request->nom;
        $prenom=$request->prenom;
        $sexe=$request->sexe;
        $pays=$request->pays;
        $adresse=$request->adresse;
        $ville=$request->ville;
        $numero=$request->number;
        $email=$request->email;
        $naissance=$request->naissance;
        $cni=$request->cni;
        $test=false;
        return view('index/paiement',compact('cni','test','niveau','naissance','filiere','type','classe','nom','prenom','sexe','pays','adresse','ville','numero','email','reponse'));

    }

    public function validerPaiement(PaiementRequest $request){


        if(!auth()->guest()){
            $type=auth()->user()->type;
        }else {
            $type='';
        }

        $nbPaiement=$request->nbpaiement;
        $nom=$request->nom;
        $prenom=$request->prenom;
        $sexe=$request->sexe;
        $pays=$request->pays;
        $adresse=$request->adresse;
        $ville=$request->ville;
        $numero=$request->number;
        $email=$request->email;
        $numero_carte=$request->num_carte;
        $classe=$request->classe;
        $naissance=$request->naissance;
        $date=date('Y');
        $dates=$date+1;
        $identifiant='';

        //dd($request->date);
        $passeur=false;

           for ($i=1; $i <= $nbPaiement; $i++) {

            if (!empty($_POST["tranche$i"])) {

                    $id= Paiement::create(
                    [
                        'nom'=>$nom,
                        'prenom'=>$prenom,
                        'classe'=>$classe,
                        'sexe'=>$sexe,
                        'email'=>$email,
                        'adresse'=>$adresse,
                        'pays'=>$pays,
                        'ville'=>$ville,
                        'numero'=>$numero,
                        'libelle'=>'tranche'.$i,
                        'montant'=>$_POST["tranche$i"],
                        'numero_carte'=>$numero_carte,
                        'date'=>$_POST["date_pay$i"],
                        'date_limite'=>$_POST["date_L$i"],

                    ] );


                      $identifiant=$identifiant.'.'.$id->id;

                      $passeur=true;

                      $tab_recu[$i-1]='tranche'.$i.'+'.$_POST["tranche$i"];
               }

           }




           if(!$passeur){
               Flashy::error('erreur aucune case n\'as été cochez! ');
               return redirect()->route('accueil_index_path');
            }


           $ident=explode('.',$identifiant);
           $idMat=$ident[1];
                $randon1=rand(0,10);
                $matricule=$classe.'_'.$date.'_'.$dates.'-'.$randon1.'_'.$idMat;

                    $post = Paiement::whereIn('id', $ident)
                    ->update([
                        'matricule'=>$matricule
                        ]);

                if ($post) {
                    $insert= Matricule::create(
                        [
                            'matricule'=>$matricule,
                            'nom'=>$nom,
                            'prenom'=>$prenom,
                            'classe'=>$classe,
                            'sexe'=>$sexe,
                            'email'=>$email,
                            'adresse'=>$adresse,
                            'pays'=>$pays,
                            'ville'=>$ville,
                            'naissance'=>$naissance,
                            'numero'=>$numero,
                            'annee_accademique'=>$date.'-'.$dates,

                        ]
                        );


                            try {

                                sleep(0);
                                $mailable=new ContactMessageCreated($insert->nom,'Schoolmonitoring@gmail.com','Bienvenu dans notre etablissement. Votre matricule est: '. $matricule.'  ceci vous servira pour créer votre compte');
                                Mail::to($insert->email)->send($mailable);

                                } catch (\Throwable $th) {
                                }
                                Flashy::success('Payement éffectué avec success.le matricule a été envoyé par mail');


                                $reponse=notification::create([
                                    'compte'=>0,
                                    'matricule'=>$matricule,
                                    'type'=>'Salutation',
                                    'message'=>'Bienvenue au sein de votre nouvel établissement Mr/Mme '.$nom,
                                    'classe'=>'classe',
                                ]);

                                $reponse=tuteur::create([
                                    'matricule'=>$insert->id,
                                    'cni'=>$request->cni,
                                ]);

                                $reponse=classe::join('filieres','classes.filiere','=','filieres.id')
                                ->where([
                                    ['classes.nom_classe',$classe]
                                ])
                                ->select('filieres.nom','classes.code_classe')
                                ->get();

                                return view('administration/recu',compact('tab_recu','nom','prenom','date','dates','classe','reponse','matricule'));


                }
                else {
                    dd('echec');
                }

    }

    public function suite_Paiement(paiementSuiteRequest $request){


        $matricule=$request->matricule;
        $recherche=Paiement::whereMatricule($matricule)->first();
        $cni=Matricule::whereMatricule($matricule)->get('id');
        $cni=tuteur::whereMatricule($cni[0]->id)->get('cni')[0]->cni;

        if ($recherche==null) {
            Flashy::error('Le matricule entré n\'existe pas');
            return back();
        }
        else {
            if(!auth()->guest()){
                $type=auth()->user()->type;
            }else {
                $type='';
            }

        $nom=$recherche->nom;
        $prenom=$recherche->prenom;
        $sexe=$recherche->sexe;
        $pays=$recherche->pays;
        $adresse=$recherche->adresse;
        $ville=$recherche->ville;
        $numero=$recherche->numero;
        $email=$recherche->email;
        $preinscription=$recherche->preinscription;
        $numero_carte=$recherche->numero_carte;
        $classe=$recherche->classe;
        $test=true;
        $matri=$recherche->matricule;

        $naissance=Matricule::whereMatricule($matri)->get('naissance');
        $naissance=$naissance[0]->naissance;
        $reponse=classe::where('nom_classe',$recherche->classe)
        ->select('filiere','niveau')
        ->get();
        $niveau=$reponse[0]->niveau;
        $filiere=$reponse[0]->filiere;
        $reponse=$reponse[0]->filiere;

        $reponse=taux_paiement::join('filieres','filieres.id','=','taux_paiements.filiere')
        ->select('filieres.id','filieres.nom','filieres.niveau','taux_paiements.libelle','taux_paiements.montant','taux_paiements.date')
        ->where([
            ['taux_paiements.filiere',$filiere],
            ['taux_paiements.niveau',$niveau]
        ])
        ->get();

        $paiement_effectue=Paiement::whereMatricule($matri)
        ->select('libelle','montant')
        ->get();
       // return $paiement_effectue;

        return view('index/paiement',compact('cni','type','matri','test','naissance','classe','nom','prenom','sexe','pays','adresse','ville','numero','numero_carte','email','preinscrip','reponse','paiement_effectue'));
    }
}

     public function validerSuitePaiement(paiementSuiteRequest $request){

          if(!auth()->guest()){
            $type=auth()->user()->type;
        }else {
            $type='';
        }
        $passeur=false;

        $classe=$request->classe;
        $nom=$request->nom;
        $prenom=$request->prenom;
        $matricule=$request->matricule;
        $date=date('Y');
        $dates=$date+1;

        $consulteur=Paiement::whereMatricule($matricule)
        ->select('libelle')
        ->get();

        for ($i=1; $i <= $request->nbpaiement; $i++) {

            if (!empty($_POST["tranche$i"])) {

                for ($c=0; $c < sizeof($consulteur); $c++) {
                    if ($consulteur[$c]->libelle=="tranche$i") {
                        Flashy::error('tranche déjà payé');
                        return redirect()->route('accueil_index_path');
                    } else {
                        $reponse= Paiement::create(
                            [
                                'nom'=>$request->nom,
                                'prenom'=>$request->prenom,
                                'classe'=>$request->classe,
                                'sexe'=>$request->sexe,
                                'matricule'=>$request->matricule,
                                'email'=>$request->email,
                                'adresse'=>$request->adresse,
                                'pays'=>$request->pays,
                                'ville'=>$request->ville,
                                'numero'=>$request->number,
                                'libelle'=>'tranche'.$i,
                                'montant'=>$_POST["tranche$i"],
                                'numero_carte'=>$request->num_carte,
                                'date'=>$_POST["date_pay$i"],
                                'date_limite'=>$_POST["date_L$i"],

                            ] );
                    }

                }



                 $passeur=true;
                 $tab_recu[$i-1]='tranche'.$i.'+'.$_POST["tranche$i"];

            }


        }

        if(!$passeur){
            Flashy::error('erreur aucune case n\'as été cochez! ');
            return redirect()->route('accueil_index_path');
        }
        if ($reponse) {
            if($type==''){
                Flashy::success('Payement éffectué avec success');
                $reponse=classe::join('filieres','classes.filiere','=','filieres.id')
                                ->where([
                                    ['classes.nom_classe',$classe]
                                ])
                                ->select('filieres.nom','classes.code_classe')
                                ->get();

                                return view('administration/recu',compact('tab_recu','nom','prenom','date','dates','classe','reponse','matricule'));

            }else{
                Flashy::success('Payement éffectué avec success');
                $reponse=classe::join('filieres','classes.filiere','=','filieres.id')
                ->where([
                    ['classes.nom_classe',$classe]
                ])
                ->select('filieres.nom','classes.code_classe')
                ->get();

                return view('administration/recu',compact('tab_recu','nom','prenom','date','dates','classe','reponse','matricule'));

            }

        }

     }



}

