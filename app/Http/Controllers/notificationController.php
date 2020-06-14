<?php

namespace App\Http\Controllers;

use App\models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class notificationController extends Controller
{
    public function notification(){
        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous');
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }


      $utilisateur=auth()->user();

      $notification=notification::whereMatriculeOrCompte($utilisateur->matricule,$utilisateur->id)
        ->update([
            'statut'=>true,
        ]);

      $notification=notification::orderBy('created_at','desc')
      ->paginate(5);
      return view('index/notification',compact('utilisateur','notification'));
    }

    public function voir_notification(){


        try {
            if (auth()->guest()) {
                Flashy::error('connectez vous');
                return redirect()->route('home');
            }
            $utilisateur=auth()->user();

       $stat=DB::table('notifications')
       ->whereIdAndCompte($_GET['id'],$utilisateur->id)
        ->update([
            'statut'=>true,
        ]);

        $stat=DB::table('notifications')
       ->whereIdAndMatricule($_GET['id'],$utilisateur->matricule)
        ->update([
            'statut'=>true,
        ]);


        $notification=notification::orderBy('created_at','desc')
        ->paginate(7);

        $notif_a_voir=notification::find($_GET['id']);

        return view('index/voir_notif',compact('utilisateur','notification','notif_a_voir'));
        } catch (\Throwable $th) {
        Flashy('erreur');
        return redirect()->route('notifications_path');

        }


    }
}
