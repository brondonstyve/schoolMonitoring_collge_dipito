<?php if($tab_appel): ?>
<div class="card" >
        <div class="card-body bg-info">
            <h4 class="text-white card-title uppercase">Mes salles de classe</h4>
            <h6 class="card-subtitle text-white m-b-0 op-5">Liste des salles où je dispense cours</h6>
        </div>
        <div class="card-body">
            <div class="message-box contact-box">


                <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?> <div class="message-widget contact-widget"
                    style="background-color: antiquewhite" title="">
                    <a>
                        <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                            <span class="profile-status online pull-right" style="color: black"></span>
                        </div>
                        <div class="mail-contnet">
                            <h5 style="text-transform: uppercase"><?php echo e($classe[$i]->nom); ?></h5>
                            <span class="mail-desc"> Classe <?php echo e($i+1); ?> : <?php echo e($classe[$i]->classe); ?></span>
                        </div>

                        <span class="btn-sm" style="text-transform: uppercase;color:brown;float: right">
                            <form action="<?php echo e(route('appel_ct_liste_path')); ?>" method="post">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="classe" value="<?php echo e($classe[$i]->classe); ?>">
                                <input type="hidden" name="id" value="<?php echo e($classe[$i]->id); ?>">
                                <input type="submit" value="Liste d'appel/CT">
                            </form>
                        </span>
                    </a>


            </div>
            <br>
            <?php endfor; ?>



        </div>
    </div>
<?php endif; ?>




















<?php if(!$ouverture): ?>
<h4 class="card-title">...</h4>

<?php else: ?>


<?php if(sizeOf($liste)==0): ?>
<h3 class="card-title">Aucun etudiant pour le moment </h3>
<a href="<?php echo e(route('appel_ct_path')); ?>"> <input type="button" value="OK" class="btn btn-sm"></a>
<?php else: ?>

<div class="col-md-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Liste d'appel de la <?php echo e($class); ?></b></h4>
            <p class="text-muted font-14 m-b-20">
                <code>Cochez pour les étudiants absents</code>
                <code style="float: right">
                        <input type="button" value="liste des absences" data-toggle="modal" data-target="#add-absence"
                        class="btn btn-sm">

                    <input type="button" value="Mon cahier de texte" data-toggle="modal" data-target="#add-cahier"
                        class="btn btn-sm">
                </code>


            </p>

            <div class="table-responsive">
                <table class="table m-0 table-colored-full table-full-inverse table-hover">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="<?php echo e(route('inserer_absence_path')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php for($i = 0; $i < sizeOf($liste); $i++): ?> <tr class="">
                                <td><?php echo e($i+1); ?></td>
                                <td><?php echo e($liste[$i]->nom); ?></td>
                                <td><?php echo e($liste[$i]->prenom); ?></td>
                                <td><input type="checkbox" name="absence<?php echo e($i); ?>" value="2"></td>
                                <input type="hidden" name="id_matiere<?php echo e($i); ?>" value="<?php echo e($id); ?>">
                                <input type="hidden" name="id_compte<?php echo e($i); ?>" value="<?php echo e($liste[$i]->id); ?>">

                                </tr>
                                <?php endfor; ?>
                                <tr>
                                    <td><span>Cahier de texte</span></td>
                                    <td colspan="3">
                                        <textarea name="libelle" id="" cols="65" rows="3" required></textarea>
                                    </td>
                                </tr>
                                <input type="hidden" name="compteur" value="<?php echo e(sizeOf($liste)); ?>">
                                <tr>
                                    <td colspan="4" class="centre">
                                        <input type="submit" value="Soumettre" class="btn btn-sm btn-default">
                                    </td>
                                </tr>

                        </form>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<a href="<?php echo e(route('appel_ct_path')); ?>"> <input type="button" value="OK" class="btn btn-sm"></a>
<?php endif; ?>
<?php endif; ?>

<?php if($absence): ?>

<!-- liste des absences -->
<div class="table-responsive ">
    <div id="add-absence" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-18">
                <div class="modal-title">
                    <table class="table stylish-table">


                        <?php if(sizeOf($remplisseur)==0): ?>
                        <h3 class="card-title">Pas d'absent pour le moment</h3>
                        <?php else: ?>
                        <h3 class="card-title"><?php echo e($remplisseur[0]->classe); ?> -- <?php echo e($remplisseur[0]->nom); ?> </h3>
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>abscence au cour</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < sizeOf($remplisseur); $i++): ?> <tr class="">
                                <td><?php echo e($i+1); ?></td>
                                <td><?php echo e($remplisseur[$i]->nomE); ?></td>
                                <td><?php echo e($remplisseur[$i]->prenom); ?></td>
                                <td><?php echo e($remplisseur[$i]->abs); ?>heures</td>

                                </tr>
                                <?php endfor; ?>
                                <?php endif; ?>
                        </tbody>
                    </table>
                    <input type="button" value="Imprimer" class="btn btn-sm btn-default centre">
                </div>
            </div>
        </div>

    </div>

</div>


<!-- liste des taches -->

<div class="table-responsive ">
    <div id="add-cahier" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-18">
                <div class="modal-title">

                    <table class="table stylish-table">


                        <?php if(sizeOf($remplisseurCahier)==0): ?>
                        <h3 class="card-title">Aucun cour enregistré...</h3>
                        <?php else: ?>
                        <h3 class="card-title"><?php echo e($remplisseurCahier[0]->classe); ?> -- <?php echo e($remplisseurCahier[0]->nom); ?>

                        </h3>
                        <thead>
                            <tr>
                                <th>date</th>
                                <th>libellé</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < sizeOf($remplisseurCahier); $i++): ?> <tr class="">
                                <td><?php echo e($remplisseurCahier[$i]->created_at); ?></td>
                                <td><?php echo e($remplisseurCahier[$i]->libelle); ?></td>

                                </tr>
                                <?php endfor; ?>
                                <?php endif; ?>
                        </tbody>
                    </table>
                    <input type="button" value="Imprimer" class="btn btn-sm btn-default centre">
                </div>
            </div>
        </div>

    </div>

    <?php endif; ?>


</div>




</div>

</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/corpsAppelct.blade.php ENDPATH**/ ?>