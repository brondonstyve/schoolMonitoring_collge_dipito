<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/paiement/ccs1.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="js/jQuery.js"></script>
    <title>Paiement</title>
</head>
<body>

<div class="container wrapper">
        <div class="row cart-head">
            <div class="container">
            <div class="row">
                <p></p>
            </div>
            <div class="row">
                <div style="display: table; margin: auto;">
                    <span class="step step_complete"> <a href="#" class="check-bc"> <h3>Classe:<?php echo e($classe); ?></h3> </a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                </div>
            </div>
            <div class="row">
                <p></p>
            </div>
            </div>
        </div>
        <div class="row cart-body">
            <form action="<?php if($test): ?> <?php echo e(route('valider_suite_paiement_path')); ?>  <?php else: ?> <?php echo e(route('valider_paiement_path')); ?> <?php endif; ?>" method="post" class="form-horizontal"   id="form-paiement">
                <?php echo e(csrf_field()); ?>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Vérifier vos informations</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <strong>Nom:</strong>
                                <input type="text" name="nom" class="form-control" value="<?php echo e($nom); ?>" />
                            </div>
                            <div class="span1"></div>
                            <div class="col-md-6 col-xs-12">
                                <strong>Prénom:</strong>
                                <input type="text" name="prenom" class="form-control" value="<?php echo e($prenom); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Sexe:</strong>
                                    <select name="sexe" id="" class="form-control">
                                            <option value="masculin"><?php echo e($sexe); ?></option>
                                            <option value="feminin"><?php if($sexe=='Masculin'): ?> Féminin <?php else: ?> Masculin  <?php endif; ?></option>
                                        </select>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="adresse" class="form-control" value="<?php echo e($adresse); ?>" />
                                <input type="hidden" name="filiere" value="<?php echo e($filiere); ?>" />
                                <input type="hidden" name="niv" value="<?php echo e($niveau); ?>" />
                                <input type="hidden" name="classe" value="<?php echo e($classe); ?>" />
                                <input type="hidden" name="matricule" value="<?php if($test): ?><?php echo e($matri); ?> <?php endif; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12"><strong>Pays:</strong></div>
                                <div class="col-md-12">
                                        <select name="pays" id="" class="form-control">
                                                <option selected="selected"><?php echo e($pays); ?></option>
                                                <option >Afghanistan</option>
                                                <option >Îles Åland</option>
                                                <option >Albanie</option>
                                                <option >Algérie</option>
                                                <option >Samoa américaines</option>
                                                <option >Andorre</option>
                                                <option >Angola</option>
                                                <option >Anguilla</option>
                                                <option >Antarctique</option>
                                                <option >Antigua et Barbuda</option>
                                                <option >Argentine</option>
                                                <option >Arménie</option>
                                                <option >Aruba</option>
                                                <option >Australie</option>
                                                <option >Autriche</option>
                                                <option >Azerbaïdjan</option>
                                                <option >Bahamas</option>
                                                <option >Bahreïn</option>
                                                <option >Bangladesh</option>
                                                <option >Barbade</option>
                                                <option >Biélorussie</option>
                                                <option >Belgique</option>
                                                <option >Belize</option>
                                                <option >Bénin</option>
                                                <option >Bermudes</option>
                                                <option >Bhoutan</option>
                                                <option >Bolivie</option>
                                                <option >Bosnie-Herzégovine</option>
                                                <option >Botswana</option>
                                                <option >Île Bouvet</option>
                                                <option >Brésil</option>
                                                <option >Territoire britannique de l'Océan Indien</option>
                                                <option >Brunei Darussalam</option>
                                                <option >Bulgarie</option>
                                                <option >Burkina Faso</option>
                                                <option >Burundi</option>
                                                <option >Cambodge</option>
                                                <option >Cameroun</option>
                                                <option >Canada</option>
                                                <option >Cap-Vert</option>
                                                <option >Îles Caïmans</option>
                                                <option >République Centrafricaine</option>
                                                <option >Tchad</option>
                                                <option >Chili</option>
                                                <option >Chine</option>
                                                <option >Île Christmas</option>
                                                <option >Îles Cocos (Keeling)</option>
                                                <option >Colombie</option>
                                                <option >Comores</option>
                                                <option >Congo (Brazzaville)</option>
                                                <option >Congo (Kinshasa)</option>
                                                <option >Îles Cook</option>
                                                <option >Costa Rica</option>
                                                <option >Côte d'Ivoire</option>
                                                <option >Croatie</option>
                                                <option >Cuba</option>
                                                <option >Chypre</option>
                                                <option >République tchèque</option>
                                                <option >Danemark</option>
                                                <option >Djibouti</option>
                                                <option >Dominique</option>
                                                <option >République dominicaine</option>
                                                <option >Équateur</option>
                                                <option >Égypte</option>
                                                <option >Salvador</option>
                                                <option >Guinée équatoriale</option>
                                                <option >Érythrée</option>
                                                <option >Estonie</option>
                                                <option >Éthiopie</option>
                                                <option >Îles Malouines</option>
                                                <option >Îles Féroé</option>
                                                <option >Fidji</option>
                                                <option >Finlande</option>
                                                <option >France</option>
                                                <option >Guyane française</option>
                                                <option >Polynésie française</option>
                                                <option >Terres australes françaises</option>
                                                <option >Gabon</option>
                                                <option >Gambie</option>
                                                <option >Géorgie</option>
                                                <option >Allemagne</option>
                                                <option >Ghana</option>
                                                <option >Gibraltar</option>
                                                <option >Grèce</option>
                                                <option >Groenland</option>
                                                <option >Grenade</option>
                                                <option >Guadeloupe</option>
                                                <option >Guam</option>
                                                <option >Guatemala</option>
                                                <option >Guernesey</option>
                                                <option >Guinée</option>
                                                <option >Guinée-Bissau</option>
                                                <option >Guyane française</option>
                                                <option >Haïti</option>
                                                <option >Îles Heard et McDonald</option>
                                                <option >Honduras</option>
                                                <option >Hong-Kong</option>
                                                <option >Hongrie</option>
                                                <option >Islande</option>
                                                <option >Inde</option>
                                                <option >Indonésie</option>
                                                <option >Iran</option>
                                                <option >Irak</option>
                                                <option >Irlande</option>
                                                <option >Île de Man</option>
                                                <option >Israël</option>
                                                <option >Italie</option>
                                                <option >Jamaïque</option>
                                                <option >Japon</option>
                                                <option >Jersey</option>
                                                <option >Jordanie</option>
                                                <option >Kazakhstan</option>
                                                <option >Kenya</option>
                                                <option >Kiribati</option>
                                                <option >Corée du Nord</option>
                                                <option >Corée du Sud</option>
                                                <option >Koweït</option>
                                                <option >Kirghizistan</option>
                                                <option >Laos</option>
                                                <option >Lettonie</option>
                                                <option >Liban</option>
                                                <option >Lesotho</option>
                                                <option >Liberia</option>
                                                <option >Libye</option>
                                                <option >Liechtenstein</option>
                                                <option >Lituanie</option>
                                                <option >Luxembourg</option>
                                                <option >Macao</option>
                                                <option >Macédoine</option>
                                                <option >Madagascar</option>
                                                <option >Malawi</option>
                                                <option >Malaisie</option>
                                                <option >Maldives</option>
                                                <option >Mali</option>
                                                <option >Malte</option>
                                                <option >Îles Marshall</option>
                                                <option >Martinique</option>
                                                <option >Mauritanie</option>
                                                <option >Île Maurice</option>
                                                <option >Mayotte</option>
                                                <option >Mexique</option>
                                                <option >Micronésie</option>
                                                <option >Moldavie</option>
                                                <option >Monaco</option>
                                                <option >Mongolie</option>
                                                <option >Monténégro</option>
                                                <option >Montserrat</option>
                                                <option >Maroc</option>
                                                <option >Mozambique</option>
                                                <option >Myanmar</option>
                                                <option >Namibie</option>
                                                <option >Nauru</option>
                                                <option >Népal</option>
                                                <option >Pays-Bas</option>
                                                <option >Antilles néerlandaises</option>
                                                <option >Nouvelle-Calédonie</option>
                                                <option >Nouvelle-Zélande</option>
                                                <option >Nicaragua</option>
                                                <option >Niger</option>
                                                <option >Nigeria</option>
                                                <option >Niue</option>
                                                <option >Île Norfolk</option>
                                                <option >Îles Mariannes du Nord</option>
                                                <option >Norvège</option>
                                                <option >Oman</option>
                                                <option >Pakistan</option>
                                                <option >Palau</option>
                                                <option >Palestine</option>
                                                <option >Panama</option>
                                                <option >Papouasie-Nouvelle-Guinée</option>
                                                <option >Paraguay</option>
                                                <option >Pérou</option>
                                                <option >Philippines</option>
                                                <option >Pitcairn</option>
                                                <option >Pologne</option>
                                                <option >Portugal</option>
                                                <option >Porto Rico</option>
                                                <option >Qatar</option>
                                                <option >Réunion</option>
                                                <option >Roumanie</option>
                                                <option >Fédération de Russie</option>
                                                <option >Rwanda</option>
                                                <option >Saint-Barthélemy</option>
                                                <option >Sainte-Hélène</option>
                                                <option >Saint-Christophe-et-Niévès</option>
                                                <option >Sainte-Lucie</option>
                                                <option >Saint Martin</option>
                                                <option >Saint-Pierre-et-Miquelon</option>
                                                <option >Saint-Vincent-et-les Grenadines</option>
                                                <option >Samoa</option>

                                            </select>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Ville:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="ville" class="form-control" value="<?php echo e($ville); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Numéro de téléphone:</strong></div>
                            <div class="col-md-12"><input type="text" name="number" class="form-control" value="<?php echo e($numero); ?>" /></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Email:</strong></div>
                            <div class="col-md-12"><input type="text" name="email" class="form-control" value="<?php echo e($email); ?>" /></div>
                        </div>

                    </div>
                </div>


            </div>



            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">

                <!-- PAYMENT-->
                <div class="panel panel-info">
                        <div class="panel-heading">Que voulez vous payer?</div>
                        <br>
                        <div class="">
                                <div class="">
                                    <input  type="checkbox" id="pre" class="preinscription" <?php if($test): ?> <?php echo e($grise); ?> <?php else: ?> disabled  checked <?php endif; ?>  > Pré-inscription
                                    <input type="text" id="p" disabled value="<?php echo e($preinscrip); ?>" style="float: right; border-radius: 3px;"/>
                                    <input type="hidden" name="pre"  value="<?php echo e($preinscrip); ?>">

                                </div>
                            </div>
                            <hr>
                        <div class="">
                                <div class="">
                                    <input  type="checkbox" id="tranche1" name="tranche1" value="<?php echo e($t1); ?>"  <?php if($test): ?> <?php echo e($griset1); ?> <?php else: ?> checked <?php endif; ?> > Première tranche
                                    <input type="text" id="t1" disabled value="<?php echo e($t1); ?>" style="float: right; border-radius: 3px;"/>

                                </div>
                        </div>
                        <hr>
                        <div class="">
                                <div class="">
                                    <input id="tranche2" type="checkbox" name="tranche2" value="<?php echo e($t2); ?>" <?php if($test): ?> <?php echo e($griset2); ?> <?php else: ?> checked <?php endif; ?>  > Deuxième tranche
                                    <input type="text" id="t2" disabled value="<?php echo e($t2); ?>" style="float: right; border-radius: 3px;"/>

                                </div>
                            </div>
                            <hr>
                        <div class="">
                                <div class="">
                                    <input id="tranche3" type="checkbox" name="tranche3" value="<?php echo e($t3); ?>" <?php if($test): ?> <?php echo e($griset3); ?> <?php else: ?> checked <?php endif; ?> > troisième tranche
                                    <input type="text" id="t3" disabled value="<?php echo e($t3); ?>" style="float: right; border-radius: 3px;"/>

                                </div>
                            </div>
                            <hr>
                            <div class="">
                                    <div class="">
                                        <input id="tranche4" type="checkbox" name="tranche4" value="<?php echo e($t4); ?>" <?php if($test): ?> <?php echo e($griset4); ?> <?php else: ?> checked <?php endif; ?> > quatrième tranche
                                        <input type="text" id="t4" disabled value="<?php echo e($t4); ?>" style="float: right; border-radius: 3px;"/>

                                    </div>
                                </div>
                                <hr>
                            <div class="">
                                    <div class="">
                                         <span>Total</span>
                                        <input type="text" id="total"  disabled style="float: right; border-radius: 3px;"/>

                                    </div>
                                </div>
                                <br>
                </div>
                <!--CREDIT CART PAYMENT END-->
                <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="submit" value="Placer le paiement" class="btn btn-primary btn-submit-fix">
                        </div>
                    </div>
            </div>


        </div>
    </form>
        <div class="row cart-footer">

        </div>
</div>

<script src="//code.jquery.com/jquery.min.js"></script>
    <?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>


<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $('#form-paiement').on('submit',function(e){
       e.preventDefault();
       var data=$(this).serialize;
       var url='/valider_paiement';
       $.post(url,data,function(data){

       })
   })
</script>

