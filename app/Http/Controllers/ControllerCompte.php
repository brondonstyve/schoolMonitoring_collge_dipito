<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompteRequest;
use App\Http\Requests\modiCompteRequest;
use App\Http\Requests\avatarRequest;
use App\Http\Requests\matriculeRequest;
use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Compte;
use App\models\Matricule;
use MercurySeries\Flashy\Flashy;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerCompte extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index/compreg');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //CREATION COMPTE
    public function store(CompteRequest $request)
    {


        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }

        //TEST SI EMAIL EXISTE
     $test_email=Compte::whereEmail($request->email)->first();

     if($test_email==null){
        $compte=new Compte();
        if ($request->mdp==$request->mdpconf) {
            $matric=Matricule::whereMatricule($request->matricule)->get('id');
            $matric=$matric[0]->id;
            $enreg=Compte::create([
                'mat'=>$matric,
                'matricule'=>$request->matricule,
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'classe'=>$request->classe,
                'email'=>$request->email,
                'téléphone'=>$request->num,
                'ville'=>$request->ville,
                'mot_de_passe'=>bcrypt($request->mdpconf),
                'type'=>$request->type,
                'date'=>date('Y-mm-dd')
                ]);


            if($enreg){


                $connect=Auth::attempt(['email' => $request->email, 'password' => $request->mdp]);

                if ($connect) {
                    $utilisteur=auth()->user();
                    Flashy::success('Bienvenu '.$utilisteur->prenom);
                    return redirect()->route('profil_path',\compact('utilisateur'));
                }else{
                    Flashy::error('Erreur de connexion. vérifiez vos identifiants');
                    return redirect()->route('home');
                }





            }
        }
        else{

            $matricules=$request->matricule;
            $nom=$request->nom;
            $prenom=$request->prenom;
            $classe=$request->classe;
            $type=$request->type;
            Flashy::error('erreur!   les deux mots de passe ne coincident pas.');
            return view('index/creationCompte',compact('matricules','nom','prenom','classe','type'));
        }

     }
     else{
        $matricules=$request->matricule;
        $nom=$request->nom;
        $prenom=$request->prenom;
        $classe=$request->classe;
        $type=$request->type;
        Flashy::error('l\'adresse email entrée existe déja.');
        return view('index/creationCompte',compact('matricules','nom','prenom','classe','type'));

     }



    }

    //MODIFICATION D'UN COMPTE

    public function edit(modiCompteRequest $request){

        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }


        if (auth()->guest()) {
            Flashy::error('Connectez vouz');
            return redirect()->route('home');
            }


            if (auth()->user()->email==$request->email) {
                if ($request->pass1==$request->pass2) {
                    $modif=auth()->user()->update(
                        [
                           'nom'=>$request->nom,
                           'prenom'=>$request->prenom,
                           'email'=>$request->email,
                           'mot_de_passe'=>bcrypt($request->pass1),
                           'téléphone'=>$request->phone,
                           'ville'=>$request->ville,

                         ]
                    );

                    if ($modif) {
                        Flashy::success('modification reuissie');
                        return redirect()->route('profil_path');
                    }
                    else{
                        Flashy::success('échec de la modification');
                        return redirect()->route('profil_path');
                    }
                } else {
                    Flashy::error('les mots de passe ne correpondent pas');
                    return redirect()->route('profil_path');
                }
            } else {
                $test_email=Compte::whereEmail($request->email)->first();

            if($test_email==null){
            if ($request->pass1==$request->pass2) {
                $modif=auth()->user()->update(
                    [
                       'email'=>$request->email,
                       'mot_de_passe'=>bcrypt($request->pass1),
                       'téléphone'=>$request->phone,

                     ]
                );

                if ($modif) {
                    Flashy::success('modification reuissie');
                    return redirect()->route('profil_path');
                }
                else{
                    Flashy::success('échec de la modification');
                    return redirect()->route('profil_path');
                }
            } else {
                Flashy::error('les mots de passe ne correpondent pas');
                return redirect()->route('profil_path');
            }
        }else{
            Flashy::error('cet email est déjà utilisé par un autre utilisateur');
            return redirect()->route('profil_path');
        }
            }





    }


    //MIS A JOUR DE L'IMAGE DU PROFIL
    public function modifAvatar(avatarRequest $request){


        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }

        if (auth()->guest()) {
            Flashy::error('Connectez vouz');
            return redirect()->route('home');
            }

        $originalImage= $request->file('avatar');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = storage_path().'/app/public/avatars/';
        $originalPath = storage_path().'/app/avatars/';
        $thumbnailImage1=Image::make($originalImage)->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage1->resize(412,386);
        $thumbnailImage1->save($thumbnailPath.time().$originalImage->getClientOriginalName());
        $photo=time().$originalImage->getClientOriginalName();

       auth()->user()->update(
           [
             'photo'=>$photo,
           ]
           );

           Flashy::success('avatar mis à jour avec succes');
            return redirect()->route('profil_path');
    }

    //RECHERCHE DU MATRUCULE ET ENTAME DE LA PHASE DE CREATION DU COMPTE

    public function findMatricule(MatriculeRequest $request){


        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }


        $matri=matricule::whereMatricule( $request->matricule)->first();
        if ($matri==null) {
            Flashy::error('le matricule entré n\'est pas valide');
            return redirect()->route('home');
        }
        else{

            $test_matri=compte::whereMatricule( $request->matricule)->first();

            if ($test_matri==null) {

                $matricules=$matri->matricule;
                $nom=$matri->nom;
                $prenom=$matri->prenom;
                $classe=$matri->classe;
                $anne_acc=$matri->annee_accademique;
                $type=$matri->type;
                $ville=$matri->ville;
                $num=$matri->numero;
                return \view('index/creationCompte',compact('matricules','nom','ville','num','prenom','classe','type'));
            }
            else {
                Flashy::error('Le matricule entré est deja utilisé');
                return redirect()->route('home');
            }

        }


    }

    //SUPPRESSION DE L'AVATAR

    public function suppAvatar(){
          try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
            mail('brondonstye@gmail.com','ERREUR A STAND PLACE','erreur de serveur admin');
            return view('errors/errorbd');
          }



        if (auth()->guest()) {
            Flashy::error('Connectez vouz');
            return redirect()->route('home');
            }

        $test=auth()->user()->photo;
        if ($test==null) {
            Flashy::error('vous ne possédez pas de photo de profil');
            return redirect()->route('profil_path');
        }
        else {
            $modif=auth()->user()->update(
                [
                    'photo'=>'',
                ]
            );

            if ($modif) {
                Flashy::success('Avatar supprimé avec succes');
                return redirect()->route('profil_path');
            }
            else {
                Flashy::error('erreur! Avatar non supprimé');
                return redirect()->route('profil_path');
            }
        }



    }


    public function gerer_compte(){
        if (auth()->guest()) {
            Flashy::error('Connectez vouz');
            return redirect()->route('home');
            }
            $utilisateur=auth()->user();

            $classe=Compte::where([
                ['type','<>',null],
                ['type','<>','superadmin'],

                ])
                    ->paginate(5);
        return view('administration/comptes',compact('utilisateur','classe'));
    }

    public function droit_des_compte(passePartout $request){
        if($request->ajax()){
            if($request->type=='donner'){
                $reponse=Compte::whereMatricule($request->matricule)
                ->update([
                    'droit'=>'admin'
                ]);

            }else{
                $reponse=Compte::whereMatricule($request->matricule)
                ->update([
                    'droit'=>null
                ]);
            }

            if ($reponse) {
                return 1;
            } else {
                return 0;
            }

        }
    }
}
