<?php

namespace App\Http\Controllers;


use MercurySeries\Flashy\Flashy;
use App\Http\Requests\ConnexionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerConnexion extends Controller
{

    public function index()
    {
        return view('index/compSign');
    }

    public function show(ConnexionRequest $request){

        try {
            DB::connection()->getPdo();
          } catch (\Throwable $th) {
           return view('errors/errorbd');
          }

          //return bcrypt($request->mdp);

            $connect=Auth::attempt(['email' => $request->email, 'password' => $request->mdp]);
            if ($connect) {
                $utilisateur=auth()->user();
                Flashy::success('Bienvenu '.$utilisateur->prenom);
                return redirect()->route('profil_path');
            }else{
                Flashy::error('Erreur de connexion. vérifiez vos identifiants');
                return redirect()->route('home');
            }




    }



}
