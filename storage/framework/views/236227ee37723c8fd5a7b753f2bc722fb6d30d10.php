<!-- ancient paiement -->
<div id="paiement-ancien" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Suite-Paiement.</h4>
            </div>
            <form action="<?php echo e(route('suite_paiement_path')); ?>" method="POST" class="form-horizontal form-material "
                enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <Span>Matricule de l'étudiant</Span>
                            <input type="text" name="matricule" class="form-control" />
                            <?php echo $errors->first('matricule',' <p style="color: red;font-family: italic"> :message
                            </p> '); ?>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Envoyer" class="left btn btn-success">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- ancient paiement -->
<div id="paie-ens" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- contenu-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Entrer le matricule</h4>
                </div>
                <form action="<?php echo e(route('payer_ens_path')); ?>" method="POST" class="form-horizontal form-material "
                    enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <Span>Matricule</Span>
                                <input type="text" name="matricule" class="form-control" />
                                <?php echo $errors->first('matricule',' <p style="color: red;font-family: italic"> :message
                                </p> '); ?>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Envoyer" class="left btn btn-success">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>







<!-- nouveau paiement -->
<div id="paiement-nouveau" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nouveau Paiement</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('paiement_path')); ?>" method="post" class="form-horizontal form-material "
                    id="formulaire">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group ">
                        <div class="">
                            <strong>Série:</strong>
                            <select name="filiere" class="form-control" id="liste-filier">
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div>
                            <strong>classe:</strong>
                            <select name="classe" class="form-control" id="liste-classe">
                            </select>
                        </div>

                        <div>
                            <input class="form-control" id="nbre_etudiant_classe" placeholder="nombre d'élève" disabled>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <strong>Nom:</strong>
                            <input type="text" name="nom" class="form-control" pattern=".{2,}" required />
                            <?php echo $errors->first('nom',' <p style="color: red;font-family: italic"> :message
                            </p> '); ?>

                        </div>

                        <div class="">
                            <strong>Prenom:</strong>
                            <input type="text" name="prenom" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class=""><strong>Sexe</strong></div>
                        <select name="sexe" id="" class="form-control">
                            <option>Masculin</option>
                            <option>Féminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <div class=""><strong>Date de naissance</strong></div>
                            <input type="date" name="naissance" class="form-control" required/>
                        </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Pays</strong></div>
                        <select name="pays" id="" class="form-control">
                            <option >Cameroun</option>
                                                <option >Gabon</option>
                                                <option >Tchad</option>
                                                <option >Algérie</option>
                                                <option >France</option>
                                                <option >Guinée</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12"><strong>Adresse:</strong></div>
                        <input type="text" name="adresse" pattern=".{5,}" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Ville:</strong></div>
                        <input type="text" name="ville" class="form-control"pattern=".{5,}" required />
                        <?php echo $errors->first('ville',' <p style="color: red;font-family: italic"> :message
                        </p> '); ?>

                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Numéro de téléphone:</strong></div>
                        <input type="number" name="number" class="form-control" required />
                        <?php echo $errors->first('number',' <p style="color: red;font-family: italic">
                            :message</p> '); ?>

                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Email:</strong></div>
                        <input type="email" name="email" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <div class="col-md-12"><strong>CNI du tuteur:</strong></div>
                        <input type="text" name="cni" class="form-control" required />
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Envoyer" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>















<!-- taux de paiement -->
<div id="fixer-les-taux" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fixer les taux de paiement</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('Fixer_solvabilite_path')); ?>" method="post" class="form-horizontal form-material "
                    id="formulaire-taux">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group ">
                        <div class="">
                            <strong>Série:</strong>
                            <select name="filiere" class="form-control" id="liste-filier" required>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                            <div class="col-md-12"><strong>Montant des penalités/semaine:</strong></div>
                            <input type="number" name="penalite" min="500" class="form-control" />
                    </div>

                    <div class="form-group ">
                        <div class="">
                            <strong>Nombre de tranche pour le paiement de la pension</strong>
                            <select name="nbtranche" class="form-control" id="liste-tranche" required>
                                <?php for($i =0 ; $i <10 ; $i++): ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Envoyer" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>





<!--voir taux de paiement -->
<div id="voir-les-taux" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- contenu-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Fixer les taux de paiement</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('voir_taux_path')); ?>" method="post" class="form-horizontal form-material "
                        id="formulaire-mtaux">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group ">
                            <div class="">
                                <strong>Série:</strong>
                                <select name="filiere" class="form-control" id="liste-filier" required>
                                </select>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <input type="submit" value="Envoyer" class="left btn btn-success">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
                </form>
            </div>

        </div>
    </div>





<!-- vote -->
<div id="vote" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- contenu-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Lancer un nouveau vote</h4>
                </div>

                    <form action="<?php echo e(route('Lancer_vote_path')); ?>" method="post" class="form-horizontal form-material "
                        id="formulaire-vote">
                <div class="modal-body" id="corps">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group " id="interieur">
                            <div class="">
                                <strong>Type du vote:</strong>
                                <select name="type" class="form-control" id="type-vote">
                                    <option value="etudiant">élève</option>
                                    <option value="admin">Administration</option>
                                </select>
                            </div>
                          </div>

                          <div class="form-group " id="retirer">
                            <div class="">
                                <strong>nombre de participant:</strong>
                                <select name="vote" class="form-control" id="liste">
                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                          </div>
                </div>



                <div id="2">
                </div>

                <div class="modal-footer">
                    <input type="submit" value="Envoyer" class="left btn btn-success">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- adresse -->
<div id="adresse" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Configurer vos adresses</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('adresses_path')); ?>" method="post" class="form-horizontal form-material ">
                    <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse email:</strong></div>
                            <input type="text" name="email" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->email : 'non défini'); ?>" />
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse email admin:</strong></div>
                            <input type="email" name="emailAdmin" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->emailAdmin : 'non défini'); ?>"/>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><strong>Numéro de téléphone:</strong></div>
                            <input type="number" name="numero"  max="99999999999" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->numero : 'non défini'); ?>"/>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse l'établissement (rue,ville,quartier):</strong></div>
                            <input type="text" name="adresse" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->adresse : 'non défini'); ?>"/>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse facebook:</strong></div>
                            <input type="url" name="facebook" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->facebook : 'non défini'); ?>"/>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse instagram:</strong></div>
                            <input type="url" name="instagram" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->instagram : 'non défini'); ?>"/>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse Google +:</strong></div>
                            <input type="url" name="google" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->google : 'non défini'); ?>"/>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse twitter:</strong></div>
                            <input type="url" name="twitter" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->twiter : 'non défini'); ?>"/>
                        </div>



            </div>
            <div class="modal-footer">
                <input type="submit" value="Envoyer" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>


<!-- a propos et misssion -->
<div id="apropos" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">parler de vous et de votre mission</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('a_propos_path')); ?>" method="post" class="form-horizontal form-material ">
                    <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12"><strong>A propos:</strong></div>
                            <textarea name="apropos" id="" cols="30" rows="20" minlength="500" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->emailAdmin : 'non défini'); ?>" required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Mission:</strong></div>
                            <textarea name="mission" id="" cols="30" rows="20" minlength="500" class="form-control" value="<?php echo e($r=(sizeOf($adresse) > 0)? $adresse[0]->emailAdmin : 'non défini'); ?>" required></textarea>
                        </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Envoyer" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>







<!-- tranche edt -->
<div id="fixer-les-EDT" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fixer les tranches et les heures de cours</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('configurer_edt_path')); ?>" method="post" class="form-horizontal form-material "
                    id="formulaire-tranche">
                    <div class="form-group ">
                        <div class="">
                            <strong>Nombre de tranche de cours</strong>
                            <select name="nbtranche" class="form-control" id="liste-tranche" required>
                                <?php for($i =0 ; $i <10 ; $i++): ?>
                                <option <?php if($i==0): ?> active <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Envoyer" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>





<!-- Groupe matiere -->
<div id="Groupe_matiere" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enregistrer un groupe de matière</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('groupe_mat_path')); ?>" method="post" class="form-horizontal form-material "
                    id="formulaire-taux">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group ">
                        <div class="">
                            <strong>nom du groupe:</strong>
                            <input type="text" name="nom" id="" class="form-control" required>
                        </div>

                        <div class="">
                            <strong>Série:</strong>
                            <select name="filiere" class="form-control" id="liste-filier" required>
                            </select>
                        </div>


                    </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Envoyer" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>




<!-- séquence -->
<div id="sekence" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fixer le nombre de séquence de cette année</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('configurer_séquence_path')); ?>" method="post" class="form-horizontal form-material "
                    id="formulaire-tranche">
                    <?php echo csrf_field(); ?>
                    <div class="form-group ">
                        <div class="">
                            <strong>Nombre de séquence</strong>
                            <select name="nbsequence" class="form-control" id="liste-séquence" required>
                                <option class="active" value="12">12</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Envoyer" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/paiement.blade.php ENDPATH**/ ?>