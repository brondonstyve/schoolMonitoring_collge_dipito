<?php

namespace App\Providers;

use App\models\adresse;
use App\models\apropo;
use App\models\evenement;
use App\models\Matricule;
use App\models\notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;

class notificationsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    { }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('compte/entete_menu_bar',function($view){

            $evenement=evenement::orderBy('date','asc')
            ->get();
            $date=new Date();
            for ($i=0; $i <sizeOf($evenement) ; $i++) {
                if($date > $evenement[$i]->date){
                notification::where(
                    [
                        ['type','Nouvel événement'],
                        ['message',$evenement[$i]->titre],

                    ])
                ->delete();
            }
            }

            $notification=notification::whereStatut(false)
            ->orderBy('created_at','desc')
            ->get();

            $view->with('notificate',$notification);
        });

        view()->composer('administration/layout/entete_menu_bar',function($view){

            $notification=notification::whereStatut(false)
            ->orderBy('created_at','desc')
            ->get();
            $view->with('notificate',$notification);
        });

        view()->composer('administration/layout/entete_menu_bar',function($view){
            $adresse=adresse::get();
            $view->with('adresse',$adresse);
        });

        view()->composer('layout/aproposbody',function($view){
            $adresse=apropo::get();
            $view->with('apropos',$adresse);
        });

        view()->composer('layout/aproposbody',function($view){
            $adresse=Matricule::get();
            $view->with('matricule',$adresse);
        });

        view()->composer('layout/header',function($view){
            $adresse=adresse::get();
            $view->with('adresse',$adresse);
        });

        view()->composer('layout/contact',function($view){
            $adresse=adresse::get();
            $view->with('adresse',$adresse);
        });

        try {
            $evaluation = DB::table('evaluations')
            ->join('epreuves', 'epreuves.id', '=', 'evaluations.epreuve')
            ->join('matieres', 'matieres.id', '=', 'evaluations.matiere')
            ->select('evaluations.id as evaluation_id', 'epreuves.id as id_epreuve', 'epreuves.epreuve as fichier', 'evaluations.libelle',
                'epreuves.id_matiere', 'epreuves.classe', 'evaluations.dure', 'evaluations.updated_at', 'matieres.nom as matiere')
            ->where([
                ['evaluations.statut',true]
                ])
            ->get();

        $date_actuelle = Carbon::now();

        for ($i = 0; $i < sizeOf($evaluation); $i++) {

            //date de debut
            $date_de_debut = Carbon::create($evaluation[$i]->updated_at);
            //temps ecoulé
            $date_de_fin = Carbon::create($evaluation[$i]->updated_at)->addMinutes($evaluation[$i]->dure);


                if ($date_actuelle > $date_de_fin) {
                    notification::whereClasseAndMessage($evaluation[$i]->classe,'l\'évaluation de '.$evaluation[$i]->matiere.' est lancé')
                        ->delete();

                }

        }
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
