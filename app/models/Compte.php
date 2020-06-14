<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as basicAuthenticatable;

class Compte extends Model implements Authenticatable
{

    use basicAuthenticatable;


    public $timestamps=false;
    protected $fillable=['mat','matricule','nom','prenom','classe','email','mot_de_passe','téléphone','ville' ,'photo','vote_statut','type','droit'];

   /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;

    }
}
