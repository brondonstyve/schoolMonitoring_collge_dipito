<?php

namespace App\Http\Controllers;

use App\filiere;
use App\models\Appel;
use App\models\blog;
use App\models\cahier;
use App\models\evenement;
use App\models\reponseBlog;
use App\models\vote as AppVote;
use MercurySeries\Flashy\Flashy;

class PagesController extends Controller
{

    public function ouvrirIndex(){

        try {
            $reponse=filiere::paginate(6);
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }

        return view('index/index',compact('reponse'));
    }

    public function ouvrirApropos(){
        return view('index/Apropos');
    }
    public function ouvrirEvenement(){
        $date=date('Y-m-d');

        $sup=evenement::where([
            ['date','<',$date]
        ])
        ->delete();
        $evenement=evenement::orderBy('date','asc')
        ->paginate(10);
        return view('index/evenement',compact('evenement'));
    }

    public function ouvrircoursfc(){
        return view('index/coursfc');
    }

    public function ouvrircoursfi(){
        return view('index/coursfi');
    }

    public function ouvrircoursligne(){
        return view('index/coursligne');
    }

    public function deconnexion(){
        auth()->logout();
        return redirect()->route('home');
    }



    public function ouvrirConnex(){

        if (auth()->guest()) {
        Flashy::success('Connectez vouz');
        return redirect()->route('home');
        }

        $utilisateur=auth()->user();


        $maxVote=AppVote::max('voix');
        $premier=AppVote::join('matricules','matricules.id','=','votes.matricule')
        ->whereVoix($maxVote)->get();

        $utilisateur=auth()->user();
        $presence=0;

        if ($utilisateur->type==null) {
            $nbrcour=cahier::join('matieres','matieres.id','=','cahiers.matiere')
            ->whereClasse($utilisateur->classe)
            ->count();

            $nbrpres=Appel::join('matieres','matieres.id','=','appels.matiere')
            ->join('matricules','matricules.id','=','appels.matricule')
            ->where([
                ['matieres.classe',$utilisateur->classe],
                ['matricules.matricule',$utilisateur->matricule]
                ])
            ->count();
           if($nbrcour==0){
            $nbrcour=1;

           }
           if ($nbrpres==0) {
            $presence=0;
           } else {
            $presence=($nbrpres/$nbrcour)*100;
           }


        }


        $evenement=evenement::orderBy('date','asc')
        ->get();

        $blog=blog::get();

        $reponse=reponseBlog::join('blogs','blogs.id','=','reponse_blogs.sujet')
           ->join('comptes','comptes.id','=','reponse_blogs.compte')

           ->select('blogs.description','blogs.titre','blogs.id','reponse_blogs.message','reponse_blogs.compte','reponse_blogs.created_at',
           'reponse_blogs.sujet','comptes.nom','comptes.classe')
           ->get();


        return view('index/profil',compact('utilisateur','premier','presence','evenement','blog','reponse'));
    }

    public function parametre(){



        if (auth()->guest()) {
        Flashy::success('Connectez vouz');
        return redirect()->route('home');
        }
        $utilisateur=auth()->user();
        return view('index/parametre',compact('utilisateur'));
    }


    public function ouvrirNote(){



        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
          }
          $utilisateur=auth()->user();
        return view('index/note',compact('utilisateur'));
    }

    public function ouvrirBlog(){
        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }
            $utilisateur=auth()->user();

            $reponse=blog::whereStatut(true)
            ->orderBy('created_at','desc')
            ->get();

            if (sizeOf($reponse)>=1) {
                $commentaire=reponseBlog::join('comptes','comptes.id','=','reponse_blogs.compte')
                ->select('reponse_blogs.compte','reponse_blogs.message','reponse_blogs.sujet',
                'reponse_blogs.id','reponse_blogs.created_at','comptes.nom','comptes.classe')
                ->whereSujet($reponse[0]->id)
                ->get();
            }

           // return $commentaire;
        return view('index/blog',compact('utilisateur','reponse','commentaire'));
    }

    public function ouvrirVote(){
        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }
            $utilisateur=auth()->user();
        return view('index/vote',compact('utilisateur'));
    }

    public function ouvrirEmploi(){
        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }
            $utilisateur=auth()->user();
        return view('index/emploi',compact('utilisateur'));
    }

    public function ouvrirDiscipline(){
        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }
            $utilisateur=auth()->user();
        return view('index/discipline',compact('utilisateur'));
    }

    public function ouvrirInbox(){

        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }
            $utilisateur=auth()->user();
        return view('index/inbox',compact('utilisateur'));
    }

    public function ouvrirGestEmploi(){

        if (auth()->guest()) {
            Flashy::success('Connectez vouz');
            return redirect()->route('home');
            }
            $utilisateur=auth()->user();
        return view('index/gestEmploi',compact('utilisateur'));
    }


}
