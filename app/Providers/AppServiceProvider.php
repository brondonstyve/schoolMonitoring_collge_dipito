<?php

namespace App\Providers;

use App\models\Matricule;
use App\models\titulaire;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('compte/entete_menu_bar',function($view){
            $utilisateur = auth()->user();

            $titulaire=titulaire::whereMatricule($utilisateur->mat)
            ->get();

            if(sizeOf($titulaire)==1){
                $titulaire=true;
            }else{
                $titulaire=false;
            }

            $view->with('titulaire',$titulaire);
        });
    }
}
