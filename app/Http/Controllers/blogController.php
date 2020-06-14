<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\blog;
use App\models\notification;
use App\models\reponseBlog;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class blogController extends Controller
{
    public function accueiBlog(){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=\auth()->user();

        $reponse=blog::paginate(9);

        $rep=reponseBlog::join('blogs','blogs.id','=','reponse_blogs.sujet')
           ->select('blogs.id')
           ->get();


        return view('administration/blog',compact('utilisateur','reponse','rep'));
    }

    public function ajouterBlog(passePartout $request){
        $utilisateur=\auth()->user();

        if ($request->ajax()) {
            $reponse=blog::create([
                'titre'=>$request->titre,
                'description'=>$request->desc,
                'statut'=>true,
            ]);
            $reponse=notification::whereType('blog')
            ->delete();

            $reponse=notification::create([
                'compte'=>0,
                'matricule'=>'public',
                'type'=>'blog',
                'message'=>'un nouveau sujet est lancé:'.$request->titre,
                'classe'=>'',
            ]);

        }else {

            $reponse=blog::create([
                'titre'=>$request->titre,
                'description'=>$request->desc,
            ]);

            $reponse=notification::create([
                'compte'=>0,
                'matricule'=>'public',
                'type'=>'blog',
                'message'=>'un nouveau sujet est lancé :'.$request->titre,
                'classe'=>'',
            ]);
            Flashy::success('enregistré avec succès');
            return redirect()->route('blog_etu_path');
        }




    }

    public function supBlog(passePartout $request){
        if ($request->ajax()) {
            $titre=blog::find($request->id);
            $reponse=blog::destroy($request->id);
            if($reponse){
                notification::whereMessage('un nouveau sujet est lancé:'.$titre->titre)
                ->delete();

                return response('suppression effectué avec succés');
            }else{
                return response('erreur');
            }
        }
    }

    public function reponse(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }

        $utilisateur=auth()->user();
        $reponse=reponseBlog::create([
            'compte'=>$utilisateur->id,
            'sujet'=>$request->blog,
            'message'=>$request->comment,
        ]);

        if ($reponse) {
            if ($request->type =='detail') {

                $reponse=reponseBlog::join('blogs','blogs.id','=','reponse_blogs.sujet')
           ->where([
               ['reponse_blogs.sujet',$request->blog],
           ])
           ->select('blogs.description','blogs.titre','blogs.id','reponse_blogs.message','reponse_blogs.compte','reponse_blogs.created_at')
           ->get();

           $rep=blog::whereId($request->blog)
           ->get();

           $sujet=blog::whereStatut(true)
           ->get();
           Flashy::success('commentaire ajouté avec success');
           return view('index.blogdetail',compact('utilisateur','reponse','sujet','rep'));
            } else {
                Flashy::success('commentaire ajouté avec success');
            return redirect()->route('blog_etu_path');
            }


        }
    }

    public function detail(){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur=auth()->user();

           $reponse=reponseBlog::join('blogs','blogs.id','=','reponse_blogs.sujet')
           ->join('comptes','comptes.id','=','reponse_blogs.compte')
           ->where([
               ['reponse_blogs.sujet',$_GET['di']],
           ])
           ->select('blogs.description','blogs.titre','blogs.id','reponse_blogs.message','reponse_blogs.compte','reponse_blogs.created_at',
           'reponse_blogs.sujet','comptes.nom','comptes.classe')
           ->get();


           /*$commentaire=reponseBlog::join('comptes','comptes.id','=','reponse_blogs.compte')
                ->select('reponse_blogs.compte','reponse_blogs.message','reponse_blogs.sujet',
                'reponse_blogs.id','reponse_blogs.created_at','comptes.nom','comptes.classe')
                ->whereSujet($reponse[0]->id)
                ->get();*/

           $rep=blog::whereId($_GET['di'])
           ->get();

           $sujet=blog::whereStatut(true)
           ->get();

           return view('index.blogdetail',compact('utilisateur','reponse','sujet','rep'));
    }

    public function valider(passePartout $request){
        if (auth()->guest()) {
            Flashy::error('connectez vous!!');
            return redirect()->route('home');
        }
        $utilisateur=auth()->user();

        $rep=blog::whereId($_GET['di'])
        ->update([
            'statut'=>true,
        ]);

        if ($rep) {
            Flashy::success('sujet ajouté avec succès');
            return redirect()->route('blog_path');
        }
    }
}


