
<div class="wrapper">



    <section class="content">
        <div class="container-fluid">
            <div class="">

                  <!-- Chargement des données dans le tableau -->
                  <?php
                      $moy_gen=0;
                      $moy_ancienne=21;
                  ?>
                    <?php $__currentLoopData = $etudiant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $moy=0;
                        $i=0;
                    ?>
                    <?php $__currentLoopData = $note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $not): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($not->id==$etud->id): ?>
                        <?php
                          $moy=$moy+$not->note*$not->coef;
                        ?>
                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $moy=$moy/$coef;
                        $tableau[$etud->id]=$moy;
                        $moy_gen=$moy+$moy_gen;
                    ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        arsort($tableau);
                    ?>

                    <?php $__currentLoopData = $tableau; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $tableau_classeur[]=$key;
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    <!-- Main content -->
                    <?php $__currentLoopData = $tableau_classeur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php for($i = 0; $i < sizeOf($etudiant); $i++): ?>
                    <?php if($etudiant[$i]->id==$item): ?>

                            <?php
                                $moy=0;
                                $nb_mat=0;
                                $total=0;
                                $testeur=0;
                            ?>
                            <div class="invoice p-3 mb-3" style="page-break-after:always;" id="i<?php echo e($key); ?>">


                                <div class="row">

                                    <div class="col-12 table-responsive">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>
                                                        <strong>REPUBLIQUE DU CAMEROUN</strong><br>
                                                        <i>Paix-travail-patrie</i><br>
                                                        <strong>MINISTERE DES ENSEIGNEMENTS SECONDAIRES</strong>

                                                    </td>

                                                    <td>
                                                        <img src="./images/IMG-20191109-WA0000.jpg" alt="logo"
                                                            class="img-circle" width="75px"><br>
                                                        <h5>BULLETIN DE NOTES</h5>
                                                        <i><?php echo e($sek); ?> séquence - Année 2019/2020 </i>

                                                    </td>


                                                    <td>
                                                        <strong>MINISTERE DES ENSEIGNEMENTS SECONDAIRES <br> </strong>
                                                        <strong>LYCEE DE YAOUNDE</strong><br>
                                                        <i>Tel:690322179/6788054321</i>

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        <img src="images/profilDef.jpg" alt="logo" class="img-size-50 mr-3"
                                                            width="20px">
                                                            <strong><?php echo e($etudiant[$i]->nom); ?></strong><br>
                                                            <?php
                                                                $date=new Date($etudiant[$i]->naissance);
                                                            ?>
                                                            <img src="images/localisation.png" alt="logo" class="img-size-50 mr-3"
                                                            width="20px">
                                                            <strong><?php echo e($date->format('d M Y')); ?> <?php echo e($etudiant[$i]->ville); ?></strong><br>
                                                            <img src="images/admin/contact.png" alt="logo" class="img-size-50 mr-3"
                                                            width="20px">
                                                            <strong><?php echo e($etudiant[$i]->numero); ?></strong><br>

                                                    </td>
                                                    <td>
                                                        <strong><?php echo e($etudiant[$i]->prenom); ?></strong><br>
                                                        <strong><?php echo e($etudiant[$i]->numero); ?></strong><br>
                                                        <strong><?php echo e($etudiant[$i]->email); ?></strong><br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Matière</th>
                                                    <th>Enseignant</th>
                                                    <th>Coef</th>
                                                    <th>Note</th>
                                                    <th>Total</th>
                                                    <th>Appréciation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $matiere; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $nb_mat=1;
                                                ?>
                                                <tr>
                                                    <td><?php echo e($element->nom); ?></td>
                                                    <td><?php echo e($element->nom_prof.' '.$element->prenom); ?></td>
                                                    <td><?php echo e($element->coef); ?></td>
                                                    <?php $__currentLoopData = $note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $not): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($not->compte==$etudiant[$i]->id): ?>
                                                        <?php if($not->id_mat==$element->id): ?>
                                                                <td><?php echo e($total=$not->note); ?></td>
                                                                <td><?php echo e($not->note*$element->coef); ?></td>
                                                                <?php
                                                                $moy=$moy+$total*$element->coef;
                                                                ?>
                                                                <?php
                                                                    $testeur=1;
                                                                ?>
                                                        <?php endif; ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($testeur==0): ?>
                                                    <td>/</td>
                                                    <td>/</td>
                                                    <?php endif; ?>


                                                    <td>

                                                        <?php if($testeur==0): ?>
                                                        /
                                                        <?php else: ?>
                                                        <?php if($total<10): ?>
                                                        Faible
                                                    <?php else: ?>
                                                    <?php if($total<12): ?>
                                                    Passable
                                                <?php else: ?>
                                                <?php if($total<=14): ?>
                                                Assez bien
                                            <?php else: ?>
                                            <?php if($total<=16): ?>
                                            Bien
                                        <?php else: ?>
                                        <?php if($total<=19): ?>
                                                        Tres Bien
                                                    <?php else: ?>
                                                    <?php if($total==20): ?>
                                                    Parfait
                                                <?php else: ?>
                                                <?php endif; ?>
                                                    <?php endif; ?>

                                        <?php endif; ?>
                                            <?php endif; ?>
                                                <?php endif; ?>
                                                    <?php endif; ?>
                                                        <?php endif; ?>

                                                    </td>
                                                </tr>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td colspan="2" class="text-right">Total coeficient</td>
                                                    <td><?php echo e($coef); ?></td>
                                                    <td class="text-right">Total note</td>
                                                    <td><?php echo e($moy); ?></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row" style="min-height: 270px; max-height: 270px">
                                    <!-- accepted payments column -->
                                    <div class="col-6 form-group" style="min-height: 270px">
                                        <p class="lead">Mot du titulaire</p>
                                        <textarea name="" placeholder="Rien à Signaler"  class="form-control" style="min-height: 65%"></textarea>

                                        <table>
                                            <tr>
                                                <th>Heure d'absence</th>
                                                <th>
                                                    <?php $__currentLoopData = $absence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($etudiant[$i]->id==$abs->matricule): ?>
                                                            <?php echo e($abs->absence); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </th>
                                            </tr>
                                        </table>

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6" style="min-height: 270px; max-height: 270px">
                                        <p class="lead">Récapitulatif</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>

                                                    <tr>
                                                        <th style="width:50%">Moyenne générale de la classe:</th>
                                                        <td><?php echo e(number_format($moy_gen/sizeOf($etudiant),'2',',','')); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Moyenne</th>
                                                        <td><?php echo e(number_format($moy=$moy/$coef,'2',',','')); ?> / 20</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rang:</th>
                                                        <td>
                                                            <?php if($moy_ancienne==$moy): ?>
                                                            <?php echo e($key); ?> <sup>exc</sup> / <?php echo e(sizeOf($etudiant)); ?>

                                                            <?php else: ?>
                                                            <?php echo e($key+1 .'/'. sizeOf($etudiant)); ?>

                                                            <?php endif; ?>
                                                            <?php
                                                                $moy_ancienne=$moy
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Appreciation:</th>
                                                        <td><?php if($moy<10): ?>
                                                            Faible
                                                        <?php else: ?>
                                                        <?php if($moy<12): ?>
                                                        Passable
                                                    <?php else: ?>
                                                    <?php if($moy<14): ?>
                                                    Assez bien
                                                <?php else: ?>
                                                <?php if($moy<16): ?>
                                                Bien
                                            <?php else: ?>
                                            <?php if($moy<19): ?>
                                                            Tres Bien
                                                        <?php else: ?>
                                                        Parfait
                                                        <?php endif; ?>

                                            <?php endif; ?>
                                                <?php endif; ?>
                                                    <?php endif; ?>
                                                        <?php endif; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Décision :
                                                        </th>
                                                        <td>
                                                            <?php if($moy<10): ?>
                                                                Echoué
                                                            <?php else: ?>
                                                                Admis
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="text-center ne_pas_imprimer">
                                <button type="button" class="btn btn-success" onclick="imprimer('i<?php echo e($key); ?>')">Imprimer le bulletin de <?php echo e($etudiant[$i]->nom.' '.$etudiant[$i]->prenom); ?></button>
                            </div>
                            <hr>
                    <?php endif; ?>

                    <?php endfor; ?>



                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                    <!-- /.invoice -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="text-right ne_pas_imprimer">
                <button type="button" class="btn btn-success" id="imprimer_tout" onclick="window.print()">Imprimer tous les bulletins</button>
              </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/corpsbulletin_titulaire.blade.php ENDPATH**/ ?>