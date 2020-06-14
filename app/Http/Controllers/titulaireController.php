<?php

namespace App\Http\Controllers;

use App\Http\Requests\passePartout;
use App\models\classe;
use App\models\Matricule;
use App\models\titulaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class titulaireController extends Controller
{
    public function index(){
        try {
        if (auth()->guest()) {
            Flashy::error('Connectez vous');
            return \redirect()->route('home');
        }
        } catch (\Throwable $th) {
            return view('errors/errorbd');
        }
        $utilisateur = auth()->user();

        $classe=classe::join('filieres','filieres.id','=','classes.filiere')
                    ->select('classes.id','classes.filiere','classes.code_classe as code_classe',
                    'filieres.nom','filieres.code as code_f')
                    ->orderBy('classes.id','asc')
                    ->paginate(10);

        $prof=Matricule::whereType('enseignant')
        ->select('matricule','nom','prenom','sexe','id')
        ->get();

        return view('administration/titulaire',compact('utilisateur','classe','prof'));
    }

    public function ajouter(passePartout $re){
        if ($re->ajax()) {

            $reponse1=titulaire::whereClasse($re->classe)
            ->get();

            if(sizeof($reponse1)==1){
                return 3;
            }

            $reponse=titulaire::whereMatricule($re->matricule)
            ->get();

            if(sizeof($reponse)==1){
                return 2;
            }

            $reponse=titulaire::create([
                'classe'=>$re->classe,
                'matricule'=>$re->matricule,
            ]);

            if ($reponse) {
                return 1;
            }
        }
    }

    public function modifier(passePartout $re){
        if ($re->ajax()) {

            $reponse=titulaire::whereMatricule([$re->matricule])
            ->get();

            if(sizeof($reponse)==1){
                return 2;
            }

            $reponse=titulaire::whereClasse($re->classe)
            ->update([
                'matricule'=>$re->matricule,
            ]);

            if ($reponse) {
                return 1;
            }
        }
    }

    public function enlever_ajouter(passePartout $re){
        if ($re->ajax()) {

            $test=titulaire::whereMatricule($re->matricule)
            ->get();

            if ($test[0]->classe==$re->classe) {
             $reponse=titulaire::whereMatricule($re->matricule)
            ->delete();
            $reponse=titulaire::whereClasse($re->classe)
            ->delete();

            $reponse=titulaire::create([
                'classe'=>$re->classe,
                'matricule'=>$re->matricule,
            ]);
            if ($reponse) {
                return 1;
            }
            } else {

            $reponse=titulaire::whereMatricule($re->matricule)
            ->delete();

            $reponse=titulaire::whereClasse($re->classe)
            ->delete();

            $reponse=titulaire::create([
                'classe'=>$re->classe,
                'matricule'=>$re->matricule,
            ]);
            if ($reponse) {
                return 1;
            }


            }



            if ($reponse) {
                return 1;
            }
        }
    }

    public function rechercher(passePartout $re){
        if ($re->ajax()) {
            $reponse=titulaire::join('matricules','matricules.id','=','titulaires.matricule')
            ->where([
                ['titulaires.classe',$re->id]
            ])
            ->select('matricules.nom','matricules.prenom','sexe')
            ->get();

            if ($reponse) {
                return response($reponse);
            }
        }
    }




    public function supprimer(passePartout $re){
        if ($re->ajax()) {
            $reponse=titulaire::whereClasse($re->id)
            ->delete();

            if ($reponse) {
                return 1;
            }
        }
    }


    public function bulletin_titulaire(passePartout $re){
        try {
            if (auth()->guest()) {
                Flashy::error('Connectez vous');
                return \redirect()->route('home');
            }
            } catch (\Throwable $th) {
                return view('errors/errorbd');
            }
            $utilisateur = auth()->user();

            $classe=titulaire::join('classes','classes.id','=','titulaires.classe')
            ->join('matricules','matricules.id','=','titulaires.matricule')
            ->where([
                ['titulaires.matricule',$utilisateur->mat]
                ])
            ->get('classes.nom_classe')[0]->nom_classe;


            //trimestre
            if ($re->sekuence=='trimestre1' || $re->sekuence=='trimestre2' || $re->sekuence=='trimestre3') {

                $libelle=$re->sekuence;

                $etudiant=Matricule::whereClasse($classe)
                ->select('id','nom','prenom','sexe','numero','naissance','ville','email','numero')
                ->orderBy('nom','asc')
                ->get();

                $matiere=DB::table('matieres')
                ->join('comptes','comptes.id','=','matieres.compte')
                ->select('matieres.nom','comptes.nom as nom_prof','comptes.prenom','matieres.id','matieres.coef')
                ->where([
                    ['matieres.classe',$classe]
                    ])
                ->orderBy('matieres.classe','asc')
                ->get();

                switch ($libelle) {
                    case 'trimestre1':
                        $cc1=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',1]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        $cc2=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',2]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        $sequence1=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',3]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        $sequence2=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',4]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        if (sizeOf($cc1)==0 || sizeOf($cc2)==0 || sizeOf($sequence1)==0 || sizeOf($sequence2)==0) {
                            Flashy::error('les Conditions ne sont pas respectés pour avoir les notes du trimestre 1. veuillez remplir toutes les notes des autres séquences');
                            return \redirect()->route('profil_path');
                        }

                        //if (sizeOf($cc1)==0 || sizeOf($cc2)==0 || sizeOf($sequence1)==0 || sizeOf($sequence2)==0)  {
                        //    Flashy::error('les Conditions ne sont pas respectés pour avoir les notes du trimestre 1. veuillez remplir toutes les notes des autres séquences');
                       //       return \redirect()->route('profil_path');
                       // }
                        break;

                        case 'trimestre2':
                           $cc1=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',5]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        $cc2=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',6]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        $sequence1=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',7]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        $sequence2=DB::table('notes')
                        ->join('matricules','matricules.id','=','notes.compte')
                        ->join('matieres','notes.matiere','=','matieres.id')
                        ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                        ->where([
                            ['matieres.classe',$classe],
                            ['notes.sequence',8]
                        ])
                        ->orderBy('matricules.nom','asc')
                        ->get();

                        if (sizeOf($cc1)==0 || sizeOf($cc2)==0 || sizeOf($sequence1)==0 || sizeOf($sequence2)==0) {
                            Flashy::error('les Conditions ne sont pas respectés pour avoir les notes du trimestre 1. veuillez remplir toutes les notes des autres séquences');
                            return \redirect()->route('profil_path');
                        }
                            break;

                            case 'trimestre3':
                                $cc1=DB::table('notes')
                                ->join('matricules','matricules.id','=','notes.compte')
                                ->join('matieres','notes.matiere','=','matieres.id')
                                ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                                ->where([
                                    ['matieres.classe',$classe],
                                    ['notes.sequence',9]
                                ])
                                ->orderBy('matricules.nom','asc')
                                ->get();

                                $cc2=DB::table('notes')
                                ->join('matricules','matricules.id','=','notes.compte')
                                ->join('matieres','notes.matiere','=','matieres.id')
                                ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                                ->where([
                                    ['matieres.classe',$classe],
                                    ['notes.sequence',10]
                                ])
                                ->orderBy('matricules.nom','asc')
                                ->get();

                                $sequence1=DB::table('notes')
                                ->join('matricules','matricules.id','=','notes.compte')
                                ->join('matieres','notes.matiere','=','matieres.id')
                                ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                                ->where([
                                    ['matieres.classe',$classe],
                                    ['notes.sequence',11]
                                ])
                                ->orderBy('matricules.nom','asc')
                                ->get();

                                $sequence2=DB::table('notes')
                                ->join('matricules','matricules.id','=','notes.compte')
                                ->join('matieres','notes.matiere','=','matieres.id')
                                ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
                                ->where([
                                    ['matieres.classe',$classe],
                                    ['notes.sequence',12]
                                ])
                                ->orderBy('matricules.nom','asc')
                                ->get();

                                if (sizeOf($cc1)==0 || sizeOf($cc2)==0 || sizeOf($sequence1)==0 || sizeOf($sequence2)==0) {
                                    Flashy::error('les Conditions ne sont pas respectés pour avoir les notes du trimestre 1. veuillez remplir toutes les notes des autres séquences.');
                                    return \redirect()->route('profil_path');
                                }
                                break;

                    default:
                        # code...
                        break;
                }

                     $absence=DB::table('appels')
                     ->join('matieres','matieres.id','=','appels.matiere')
                     ->select(DB::raw('matricule,sum(absence) as absence'))
                     ->where([
                         ['matieres.classe',$classe]
                     ])
                     ->groupBy('matricule','absence')
                     ->get();


                return view('index/trimestre',compact('utilisateur','libelle','etudiant','matiere','cc1','cc2','sequence1','sequence2','absence'));
            }

            //fin trimestre


            $note=DB::table('notes')
            ->join('matricules','matricules.id','=','notes.compte')
            ->join('matieres','notes.matiere','=','matieres.id')
            ->select('matieres.nom as nom_mat','matieres.groupe','matieres.coef','notes.note','notes.matiere as id_mat','notes.compte','matricules.id')
            ->where([
                ['matieres.classe',$classe],
                ['notes.sequence',$re->sekuence]
            ])
            ->orderBy('matricules.nom','asc')
            ->get();

            $matiere=DB::table('matieres')
            ->join('comptes','comptes.id','=','matieres.compte')
            ->select('matieres.nom','comptes.nom as nom_prof','comptes.prenom','matieres.id','matieres.coef')
            ->where([
                ['matieres.classe',$classe]
                ])
            ->orderBy('matieres.classe','asc')
            ->get();


            if (sizeOf($note)==0) {
                Flashy::error('ces notes ne sont pas encore enregistré');
                return \redirect()->route('profil_path');
            }


            $etudiant=Matricule::whereClasse($classe)
            ->select('id','nom','prenom','sexe','numero','naissance','ville','numero','email')
            ->orderBy('nom','asc')
            ->get();


            $sek=$re->sekuence;
            switch ($sek) {
                case '1':
                    $sek='Première';
                    break;
                    case '2':
                        $sek='Deuxième';
                        break;case '3':
                            $sek='Troisième';
                            break;case '4':
                                $sek='Quatième';
                                break;case '5':
                                    $sek='Cinquième';
                                    break;case '6':
                                        $sek='Sixième';
                                        break;case '7':
                                            $sek='Septième';
                                            break;case '8':
                                                $sek='Huitième';
                                                break;case '9':
                                                    $sek='Neuvième';
                                                    break;case '10':
                                                        $sek='Dixième';
                                                        break;case '11':
                                                            $sek='Onzième';
                                                            break;case '12':
                                                                $sek='Douxième';
                                                                break;

                default:
                    # code...
                    break;
            }

            $coef=DB::table('matieres')
            ->whereClasse($classe)
            ->sum('coef');

            $absence=DB::table('appels')
            ->join('matieres','matieres.id','=','appels.matiere')
            ->select(DB::raw('matricule,sum(absence) as absence'))
            ->where([
                ['matieres.classe',$classe]
            ])
            ->groupBy('matricule','absence')
            ->get();


            return view('index/bulletin_titulaire',compact('utilisateur','absence','classe','note','etudiant','sek','matiere','coef'));
    }

    public function nb_sekuence(passePartout $re){
        if($re->ajax()){
            $reponse=DB::table('sequences')->select('nbsequence')->get('nbsequence');
                return $reponse;
        }
    }


}
