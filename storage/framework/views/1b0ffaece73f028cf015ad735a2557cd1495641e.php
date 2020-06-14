<?php if($compo): ?>


<h3 class="centre">evaluation de <?php echo e($evaluation[0]->matiere); ?> pour le compte du <?php echo e($evaluation[0]->libelle); ?></h3>


                    <input type="hidden" name="jbh" id="compteur" value="<?php echo e($temps_restant*60); ?>">

                    <table class="table m-0 table-colored-bordered table-bordered-success">
                            <thead>
                                <tr class="btn-sm">
                                    <th style="color: white">Temps donné:</th>
                                    <th style="color: white">Temps restant(min)</th>
                                    <th style="color: white">CHRONO(sec)</th>
                                    <th style="color: white"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo e($evaluation[0]->dure); ?> minutes</td>
                                    <td><?php echo e($temps_restant); ?> minutes</td>
                                    <td><span  id="time" style="display: inline-block"></span> secondes</td>
                                    <td><img src="images/horloge.png" class="mdi mdi-account-circle"></td>
                                </tr>
                            </tbody>
                     </table>




<br>
    <!-- Column -->
    <div class="col-lg-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-box">
                    <iframe src="storage/epreuve/<?php echo e($evaluation[0]->fichier); ?>" frameborder="0" class="table m-0 " width="490"
                        height="500">
                        alt: <a href="storage/epreuve/<?php echo e($evaluation[0]->fichier); ?>">Cliquer ici</a>
                    </iframe>

                </div>
            </div>
        </div>
</div>




<div class="col-md-12">
        <h3 class="font-light" id="time"> Réponses</h3>
    <div class="card-box">
        <div class="table-responsive">
            <form action="<?php echo e(route('compose_path')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <table class="table m-0 table-colored-bordered table-bordered-success">
                    <thead>
                        <tr class="btn-sm">
                            <th style="color: white">Numéro</th>
                            <th style="color: white">Réponse</th>
                            <th style="color: white">Numéro</th>
                            <th style="color: white">Réponse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php for($i = 0; $i < $nbre_k; $i++): ?> <tr class="">
                                <td class="centre"><?php echo e($i+1); ?></td>

                                <td class="centre">
                                    <select name="kcm<?php echo e($i); ?>" id="">
                                        <?php for($rep = 0; $rep < 4; $rep++): ?> <Option value="<?php echo e($reponse[$rep]); ?>">
                                            <?php echo e($reponse[$rep]); ?> </option>
                                            <?php endfor; ?>
                                    </select>
                                </td>
                                <?php $i=$i+2 ?>
                                <td class="centre"><?php echo e($i); ?></td>
                                <?php $i-- ?>

                                <td class="centre">
                                    <select name="kcm<?php echo e($i); ?>" id="">
                                        <?php for($rep = 0; $rep < 4; $rep++): ?> <Option value="<?php echo e($reponse[$rep]); ?>">
                                            <?php echo e($reponse[$rep]); ?> </option>
                                            <?php endfor; ?>
                                    </select>
                                </td>

                        </tr>
                        <?php endfor; ?>
                    </tbody>
                    <tr>
                        <td colspan="4" class="centre">
                            <input type="hidden" name="nbre_rep" value="<?php echo e(encrypt($nbre_k)); ?>">
                            <input type="hidden" name="evaluation" value="<?php echo e(encrypt($evaluation[0]->evaluation_id)); ?>">
                            <input type="submit" id="button" value="Soumettre" class="btn btn-sm btn-success">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

</div>
<?php else: ?>

<div class="col-md-10">
        <h3 class="centre">résultat de l'évaluation de <?php echo e($matiere); ?> pour : <?php echo e($libelle); ?></h3>
        <!-- Column -->
    <div class="card-box">
        <div class="table-responsive">
            <table class="<?php if($note<10): ?> table-colored-bordered table-bordered-danger <?php else: ?> table m-0 table-colored-bordered table-bordered-success <?php endif; ?> ">
                <thead>
                    <tr class="btn-sm">
                        <th style="color: white">Numéro</th>
                        <th style="color: white">Réponse</th>
                        <th style="color: white">statut</th>
                        <th style="color: white">Numéro</th>
                        <th style="color: white">Réponse</th>
                        <th style="color: white">statut</th>
                    </tr>
                </thead>
                <tbody>
                                <?php
                                    $reponse_prof=explode('.',$rep_prof) ;
                                    $reponse_etud=explode('.',$rep_etud) ;
                                ?>

                                <?php for($i = 0; $i < sizeOf($reponse_prof)-1; $i++): ?>
                                <tr class="">
                                    <td><?php echo e($i+1); ?></td>

                                    <td> <?php echo e($reponse_etud[$i]); ?> </td>

                                    <td >
                                        <?php if($reponse_etud[$i]==$reponse_prof[$i]): ?>
                                          <img src="images/icones/succes.png" alt="trouvé" style="max-width: 15px">
                                          <?php else: ?>
                                          <img src="images/icones/echec.png" alt="trouvé" style="max-width: 15px">
                                        <?php endif; ?>
                                    </td>

                                    <?php $i=$i+2 ?>
                                    <td ><?php echo e($i); ?></td>
                                    <?php $i-- ?>

                                    <td > <?php echo e($reponse_etud[$i]); ?> </td>

                                    <td>
                                            <?php if($reponse_etud[$i]==$reponse_prof[$i]): ?>
                                            <img src="images/icones/succes.png" alt="trouvé" style="max-width: 15px">
                                            <?php else: ?>
                                            <img src="images/icones/echec.png" alt="trouvé" style="max-width: 15px">
                                          <?php endif; ?>
                                    </td>
                                </tr>
                              <?php endfor; ?>
                              <thead>
                                    <tr >
                                            <td colspan="3" style="color: forestgreen"><?php if($compteur>1): ?> réponses justes: <?php else: ?> réponse juste: <?php endif; ?> <?php echo e($compteur); ?></td>
                                            <td colspan="3" style="color: brown"><?php if((sizeOf($reponse_prof) - 1 - $compteur)>1): ?> réponses fausses: <?php else: ?> réponse fausse: <?php endif; ?>  <?php echo e(sizeOf($reponse_prof) - 1 - $compteur); ?></td>
                                    </tr>
                                    <tr>
                                            <td colspan="6" style="color: <?php if($note>=0): ?> <?php if($note<=10): ?> red <?php else: ?> <?php if($note<=12): ?> blue  <?php else: ?> green <?php endif; ?> <?php endif; ?> <?php endif; ?>">total : <?php echo e($note); ?> / 20</td>

                                    </tr>
                              </thead>
                </tbody>
            </table>
            <a href="<?php echo e(route('evaluation_path')); ?>" style="text-align: center">
                    <input type="button" value="OK" class="btn btn-sm btn-success">
                </a>

        </div>
    </div>

</div>
<?php endif; ?>


<?php /**PATH C:\laragon\www\StandPlace primaire\resources\views/compte/corpsComposition.blade.php ENDPATH**/ ?>