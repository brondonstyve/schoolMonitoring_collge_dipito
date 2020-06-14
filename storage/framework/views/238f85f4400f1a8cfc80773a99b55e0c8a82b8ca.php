<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                <div class=""><strong>Date de naissance</strong></div>
                                <input type="date" name="naissance" value="<?php echo e($naissance); ?>" class="form-control" required/>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="adresse" class="form-control" value="<?php echo e($adresse); ?>" />
                                <input type="hidden" name="classe" value="<?php echo e($classe); ?>" />
                                <input type="hidden" name="matricule" value="<?php if($test): ?><?php echo e($matri); ?> <?php endif; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12"><strong>Pays:</strong></div>
                                <div class="col-md-12">
                                        <select name="pays" id="" class="form-control">
                                                <option selected="selected"><?php echo e($pays); ?></option>
                                                <option >Cameroun</option>
                                                <option >Gabon</option>
                                                <option >Tchad</option>
                                                <option >Algérie</option>
                                                <option >France</option>
                                                <option >Guinée</option>
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
                        <div class="form-group">
                            <div class="col-md-12"><strong>CNI:</strong></div>
                            <div class="col-md-12"><input type="text" name="cni" class="form-control" value="<?php echo e($cni); ?>" /></div>
                        </div>

                    </div>
                </div>


            </div>



            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">

                <!-- PAYMENT-->

                <div class="panel panel-info">
                    <?php if(sizeOf($reponse)==0): ?>
                    <div class="panel-heading">Les taux de paiement n'ont pas encor été fixer pour cette salle de classe</div>

                    <?php else: ?>
                    <div class="panel-heading">Que voulez vous payer?</div>
                    <br>
                     <?php if($test): ?>
                     <?php for($i =0 ; $i <sizeOf($reponse) ; $i++): ?>
                     <div class="">
                         <div class="">
                             <?php for($verif =0 ; $verif < sizeOf($paiement_effectue) ; $verif++): ?>
                             <?php $testeur=false ?>
                             <?php if( $reponse[$i]->libelle==$paiement_effectue[$verif]->libelle): ?>
                             <div class="form-group">
                                    <div class="col-md-12"><strong><input disabled type="checkbox" name="<?php echo e($reponse[$i]->libelle); ?>" value="<?php echo e($reponse[$i]->montant); ?>"><?php if($reponse[$i]->libelle=='tranche1'): ?> Inscription <?php else: ?> <?php $t=explode('e',$reponse[$i]->libelle)[1] ?> TRANCHE <?php echo e($t-1); ?> <?php endif; ?></strong></div>
                                    <div class="col-md-12"><input type="text"  disabled value=" Déjà payé" checked/>

                                    </div>

                                </div><?php break; ?>
                               <?php else: ?>
                                <?php $testeur=true; ?>
                               <?php endif; ?>
                             <?php endfor; ?>
                             <?php if($testeur): ?>
                             <div class="form-group">
                                    <div class="col-md-12"><strong><input  type="checkbox" name="<?php echo e($reponse[$i]->libelle); ?>" value="<?php echo e($reponse[$i]->montant); ?>"><?php if($reponse[$i]->libelle=='tranche1'): ?> Inscription <?php else: ?> <?php $t=explode('e',$reponse[$i]->libelle)[1] ?> TRANCHE <?php echo e($t-1); ?> <?php endif; ?></strong></div>

                                    <div class="col-md-12"><input type="text"  disabled value="<?php echo e($reponse[$i]->montant); ?> Fcfa" />
                                        <input type="hidden" name="date_L<?php echo e($i+1); ?>" value="<?php echo e($reponse[$i]->date); ?>" class="form-control">
                                        <strong> Date de paiement</strong><input type="date" name="date_pay<?php echo e($i+1); ?>" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" max="<?php echo e(date('Y-m-d')); ?>">
                                    </div>

                                </div>

                             <?php endif; ?>
                         </div>
                     </div>
                     <hr>
                     <?php endfor; ?>
                     <?php else: ?>
                     <?php for($i =0 ; $i <sizeOf($reponse) ; $i++): ?>
                            <div class="form-group">
                                    <div class="col-md-12"><strong><input  type="checkbox" name="<?php echo e($reponse[$i]->libelle); ?>" value="<?php echo e($reponse[$i]->montant); ?>"><?php if($reponse[$i]->libelle=='tranche1'): ?> Inscription <?php else: ?> <?php $t=explode('e',$reponse[$i]->libelle)[1] ?> TRANCHE <?php echo e($t-1); ?> <?php endif; ?></strong></div>

                                    <div class="col-md-12"><input type="text"  disabled value="<?php echo e($reponse[$i]->montant); ?> Fcfa"class="form-control" />
                                        <input type="hidden" name="date_L<?php echo e($i+1); ?>" value="<?php echo e($reponse[$i]->date); ?>">
                                        <strong>Date de paiement</strong><input type="date" name="date_pay<?php echo e($i+1); ?>" class="form-control" value="<?php echo e(date('Y-m-d')); ?>">

                                    </div>

                                </div>

                     <hr>
                     <?php endfor; ?>
                     <?php endif; ?>


                        <input type="hidden" name="nbpaiement" value="<?php echo e(sizeOf($reponse)); ?>">

                    <?php endif; ?>

                                <br>
                                <?php if($type!='superadmin' && $type!='admin'): ?>
                                <div class="panel-heading" >Paiement</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>type de la carte</strong></div>
                                        <div class="col-md-12">
                                            <select id="CreditCardType" name="CreditCardType" class="form-control">
                                                <option value="5">Visa</option>
                                                <option value="6">MasterCard</option>
                                                <option value="7">American Express</option>
                                                <option value="8">Discover</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Numéro de la carte de crédit:</strong></div>
                                        <div class="col-md-12"><input type="number" class="form-control" name="num_carte" required/></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Carte CVV:</strong></div>
                                        <div class="col-md-12"><input type="number" name="cvv" class="form-control" required/></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <span>Payer en toute sécurité.</span>
                                        </div>
                                        <div class="col-md-12">
                                            <ul class="cards">
                                                <li class="visa hand">
                                                    <img src="images/pp.png" alt="">
                                                    <img src="images/PP.jpg" alt="">
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div>
                                <?php else: ?>
                                <div >
                                        <div class="col-md-12"><input type="hidden" class="form-control" name="num_carte" value="123456789" required/></div>

                                        <div class="col-md-12"><input type="hidden" name="cvv" class="form-control" value="123456" required/></div>
                                    </div>
                                <?php endif; ?>



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

    <script>

    </script>
</body>
</html>

<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/index/paiement.blade.php ENDPATH**/ ?>