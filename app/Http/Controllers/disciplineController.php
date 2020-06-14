<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\Mail\ContactMessageCreated;
use App\models\Appel;
use App\models\classe;
use App\models\discipline;
use App\models\Matricule;
use App\models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MercurySeries\Flashy\Flashy;

class disciplineController extends Controller
{
    public function Discipline(){

        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }

        $utilisateur=auth()->user();

        $matricule=Matricule::whereMatricule($utilisateur->matricule)->get('id');

        $remplisseur=DB::table('appels')
        ->join('matricules','matricules.id','=','appels.matricule')
        ->where([
            ['appels.matricule',$matricule[0]->id  ],

            ])
        ->sum('absence');

        $liste=DB::table('appels')
            ->join('matieres','appels.matiere','=','matieres.id')
            ->select('matieres.nom','appels.nom_prof','absence','appels.created_at')
            ->where([
                ['appels.matricule',$matricule[0]->id ],
                    ])
            ->simplePaginate(5);

        //dd($liste);
        $matricule=Matricule::whereMatricule($utilisateur->matricule)->get('id');
        $discipline=discipline::whereMatricule($matricule[0]->id)
        ->get();

      return view('index/discipline',compact('utilisateur','remplisseur','liste','discipline'));
    }



    //adminnnnnn


    public function liste_classe(){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();

        $classe=classe::join('filieres','filieres.id','=','classes.filiere')
                    ->select('classes.id','classes.filiere','classes.niveau',
                             'classes.code_classe as code_classe','filieres.nom','filieres.code as code_f')
                    ->orderBy('classes.nom_classe','desc')
                    ->paginate(5);

        return view('administration/discipline',compact('utilisateur','classe'));
    }

    public function ajouter_discipline(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();

        if($request->ajax()){

            $reponse=discipline::create([
                'matricule'=>$request->matri,
                'compte'=>$utilisateur->id,
                'motif'=>$request->motif,
                'date'=>$request->date,
            ]);

            if($reponse){

                $reponse=notification::create([
                    'compte'=>0,
                    'matricule'=>$request->matricul,
                    'type'=>'Conseil de discipline',
                    'message'=>'Chers Monsieur/Madame vous ête attendu au conseil de discipline du : '.$request->date.' avec pour motif : '.$request->motif,
                    'classe'=>'classe',
                ]);

                $mail=Matricule::whereId($request->matri)
                ->select('email','nom')
                ->get();
                try {

                    sleep(0);
                    $mailable=new ContactMessageCreated($mail[0]->nom,'schoolmonitoring@gmail.com','Chers Monsieur/Madame vous ête attendu au conseil de discipline du : '.$request->date.' avec pour motif :'.$request->motif);
                    Mail::to($mail[0]->email)->send($mailable);

                    } catch (\Throwable $th) {
                    }
                    return ('le concerné a été notifié');
            }
        }
    }

    public function voir_conseil_discipline(){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();

        $reponse=discipline::join('comptes','comptes.id','=','disciplines.compte')
        ->join('matricules','matricules.id','=','disciplines.matricule')
        ->select('matricules.nom as nom_e','matricules.prenom as prenom_e','matricules.classe','matricules.matricule','matricules.id',
                 'comptes.nom as nom_p','comptes.prenom as prenom_p','disciplines.id','disciplines.motif','disciplines.date')
        ->where([
            ['disciplines.statut',false]
        ])
        ->paginate(10);

        return view('administration/conseilDiscipline',compact('utilisateur','reponse'));
    }


    public function juger_conseil_discipline(passePartout $request){
        if ($request->ajax()) {
            $utilisateur=auth()->user();

            if ($request->coupable=='true') {
                $reponse=discipline::whereId($request->id)
            ->update([
                'coupable'=>true,
                'sanction'=>$request->sanction,
                'statut'=>true,
                'nom_juge'=>$utilisateur->nom.' '.$utilisateur->prenom,
            ]);

            } else {
                $reponse=discipline::whereId($request->id)
            ->update([
                'coupable'=>false,
                'statut'=>true,
                'nom_juge'=>$utilisateur->nom.' '.$utilisateur->prenom,
            ]);
            }
            if($reponse){
                return('jugement éffectué avec succès');
            }else{
                return('erreur');
            }


        }
    }

    public function voir_conseil_discipline_juge(){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();

        $reponse=discipline::join('comptes','comptes.id','=','disciplines.compte')
        ->join('matricules','matricules.id','=','disciplines.matricule')
        ->select('matricules.nom as nom_e','matricules.prenom as prenom_e','matricules.classe','matricules.matricule','matricules.id',
                 'comptes.nom as nom_p','comptes.prenom as prenom_p','disciplines.id','disciplines.motif','disciplines.date',
                 'disciplines.sanction','disciplines.coupable','disciplines.nom_juge')
        ->where([
            ['disciplines.statut',true]
        ])
        ->orderBy('updated_at','desc')
        ->paginate(10);

        return view('administration/conseilJuger',compact('utilisateur','reponse'));
    }

    public function caisier_judiaciaire(passePartout $request){

        if($request->ajax()){
            $reponse=discipline::join('matricules','matricules.id','=','disciplines.matricule')
            ->select('matricules.nom','matricules.prenom','matricules.matricule','matricules.classe','disciplines.coupable')
            ->where([
                ['matricules.matricule',$request->matricule]
            ])
            ->get();
            return response($reponse);
        }
    }



    public function liste_d_absence(passePartout $request){

        if($request->ajax()){
            $reponse=Appel::join('matricules','matricules.id','=','appels.matricule')
            ->where([
                ['matricules.matricule',$request->matricule]
            ])
            ->sum('absence');
            return response($reponse);
        }
    }


}
