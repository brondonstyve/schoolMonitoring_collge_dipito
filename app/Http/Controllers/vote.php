<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use Illuminate\Http\Request;
use App\models\Compte;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\voteValider;
use App\models\Matricule;
use App\models\notification;
use App\models\vote as AppVote;
use Illuminate\Support\Facades\DB;

class vote extends Controller
{

    public function membreVotes(){
        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }

        $utilisateur=auth()->user();
        $niveau=$utilisateur->niveau;
        $maxVote=AppVote::max('voix');
        $premier=AppVote::join('matricules','matricules.id','=','votes.matricule')
        ->whereVoix($maxVote)->get();

        $liste=AppVote::join('matricules','matricules.id','=','votes.matricule')
        ->orderBy('voix','desc')->get();

        $resultat=AppVote::join('matricules','matricules.id','=','votes.matricule')
        ->get();

        return view('index/vote',compact('resultat','utilisateur','premier','liste'));


    }

    public function voteEnvoi(voteValider $request){
        $id=$request->id;
        $nbreVote=$request->nbreVote;
        $vote=AppVote::whereMatricule($id)->update(['voix'=>$nbreVote+1]);

         if ($vote) {
             $vote_statut=auth()->user()->update(['vote_statut'=>true]);
             Flashy::success('Vote realisé avec succes');
             return redirect()->route('vote_path');
         } else {
            Flashy::error('Erreur générée pendant le processus de vote');
            return back();
         }

    }

    public function lancerVote(passePartout $request){

        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();
        $tableau=array();

        if ($request->type=='admin') {
         $reponse=matricule::whereType('enseignant')->get('id');
         DB::table('votes')->delete();
         for ($i = 0; $i < sizeOf($reponse) ; $i++) {
            $repon=AppVote::create([
                'matricule'=>$reponse[$i]->id,
                'type'=>'enseignant',
            ]);
         }

         $reponse=DB::table('comptes')->update([
            'vote_statut'=>false,
        ]);
        $reponse=notification::create([
            'compte'=>0,
            'matricule'=>'public',
            'type'=>'vote',
            'message'=>'un nouveau vote est lancé',
            'classe'=>'',
        ]);
         Flashy::success('le vote des enseignants est lancé');
         return redirect()->route('accueil_index_path');
        }else{

            for ($i=1; $i <=$request->nbre ; $i++) {
                $reponse=Matricule::whereMatricule($_POST["matricule$i"])->get();
                if(sizeOf($reponse)==0){
                    Flashy::error('le matricule'.$i.'   "'.$_POST["matricule$i"].'" n\'existe pas');
                    return back();
                }
             $tableau[$i]=$reponse[0];
             }
        }


        return view('administration/vote',compact('utilisateur','tableau'));
    }


    public function lancerVoteEtudiant(passePartout $request){
        DB::table('votes')->delete();
        for ($i=1; $i <=$request->nbre ; $i++) {
            $reponse=AppVote::create([
                'matricule'=>$_POST["matricule$i"],
                'type'=>'etudiant'
            ]);
        }
        $reponse=DB::table('comptes')->update([
            'vote_statut'=>false,
        ]);
        $reponse=notification::whereType('vote')
            ->delete();

        $reponse=notification::create([
            'compte'=>0,
            'matricule'=>'public',
            'type'=>'vote',
            'message'=>'un nouveau vote est lancé',
            'classe'=>'',
        ]);
        Flashy::success('le vote est lancé');
        return redirect()->route('accueil_index_path');
    }

    public function suspendre_vote(){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $reponse=AppVote::whereIn('type',['enseignant','etudiant'])
        ->delete();

        $reponse=Compte::where('id','<>',0)
        ->update([
          'vote_statut'=>false,
        ]);


        $reponse=notification::whereType('vote')
        ->delete();

            Flashy::success('Vote suspendu avec succès');
            return redirect()->route('accueil_index_path');

    }

}
