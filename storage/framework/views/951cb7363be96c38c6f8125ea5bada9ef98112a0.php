                    <?php
                      $moy_gen=0;
                      $moy_ancienne=21;
                  ?>

                    <?php $__currentLoopData = $etudiant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eleve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $moy=0;
                                $i=0;
                                $coef=0;
                            ?>


                        <?php $__currentLoopData = $matiere; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $tab=array();
                                ?>




<?php
$a_compose=false
?>
<?php $__currentLoopData = $cc1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>



<?php
$a_compose=false
?>
<?php $__currentLoopData = $cc2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>




<?php
$a_compose=false
?>
<?php $__currentLoopData = $sequence1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>


<?php
$a_compose=false
?>
<?php $__currentLoopData = $sequence2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>


                             <?php
                                  $note1=($tab[0]*0.2)+($tab[2]*0.8);
                                  $note2=($tab[1]*0.2)+($tab[3]*0.8);
                                  $moy=((($note1+$note2)/2)*$mat->coef)+$moy;
                                  $coef=$coef+$mat->coef;
                             ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $moy=$moy/$coef;
                        $tableau[$eleve->id]=$moy;
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


                    <?php $__currentLoopData = $tableau_classeur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $etudiant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eleve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($eleve->id==$item): ?>
                                <?php
                                    $coef=0;
                                    $total=0;
                                    $total_coef=0;
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
                                                            <i> séquence - Année 2019/2020 </i>

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
                                                                <strong><?php echo e($eleve->nom); ?></strong><br>
                                                                <img src="images/localisation.png" alt="logo" class="img-size-50 mr-3"
                                                                width="20px">
                                                                <?php
                                                                    $date=new Date($eleve->naissance);
                                                                ?>
                                                                <strong><?php echo e($date->format('d M Y')); ?> <?php echo e($eleve->ville); ?></strong><br>
                                                                <img src="images/admin/contact.png" alt="logo" class="img-size-50 mr-3"
                                                                width="20px">
                                                                <strong><?php echo e($eleve->numero); ?> </strong><br>

                                                        </td>
                                                        <td>
                                                            <strong><?php echo e($eleve->prenom); ?> </strong><br>
                                                            <strong><?php echo e($eleve->numero); ?></strong><br>
                                                                                <strong><?php echo e($eleve->email); ?></strong><br>
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
                                                            <?php
                                                                $sequence=explode('e',$libelle)[2];
                                                            ?>
                                                            <?php switch($sequence):
                                                                case (1): ?>
                                                                <th>Séquence 1</th>
                                                                <th>Séquence 2</th>
                                                                <?php break; ?>
                                                                <?php case (2): ?>
                                                                <th>Séquence 3</th>
                                                                <th>Séquence 4</th>
                                                                <?php break; ?>
                                                                <?php case (3): ?>
                                                                <th>Séquence 5</th>
                                                                <th>Séquence 6</th>
                                                                <?php break; ?>
                                                                <?php default: ?>

                                                            <?php endswitch; ?>
                                                        <th>note</th>
                                                        <th>Coef</th>
                                                        <th>Total</th>
                                                        <th>Appréciation</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $matiere; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $tab=array();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo e($mat->nom); ?></td>
                                                        <td><?php echo e($mat->nom_prof.' '.$mat->prenom); ?></td>



                                                        <?php
$a_compose=false
?>
<?php $__currentLoopData = $cc1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>



<?php
$a_compose=false
?>
<?php $__currentLoopData = $cc2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>




<?php
$a_compose=false
?>
<?php $__currentLoopData = $sequence1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>


<?php
$a_compose=false
?>
<?php $__currentLoopData = $sequence2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controle1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($controle1->compte==$eleve->id): ?>
<?php if($mat->id==$controle1->id_mat): ?>
    <?php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$a_compose): ?>
<?php
$tab[]=0;
?>
<?php endif; ?>


                                                        <td><?php echo e($note1=($tab[0]*0.2)+($tab[2]*0.8)); ?></td>
                                                        <td><?php echo e($note2=($tab[1]*0.2)+($tab[3]*0.8)); ?></td>
                                                        <?php
                                                            $coef=$coef+$mat->coef;
                                                            $total=$total+(($note1+$note2)/2);
                                                            $total_coef=($total* $mat->coef)+$total_coef;
                                                        ?>
                                                        <td><?php echo e((($note1+$note2)/2)); ?></td>
                                                        <td><?php echo e($mat->coef); ?></td>
                                                        <td><?php echo e($total* $mat->coef); ?></td>


                                                        <td>

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
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <tr>

                                                        <td></td>
                                                        <td class="text-right">Total</td>
                                                        <td colspan="2" class="text-right"></td>
                                                        <td><?php echo e($total); ?></td>
                                                        <td><?php echo e($coef); ?></td>
                                                        <td><?php echo e($total_coef); ?></td>
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
                                            <textarea name="" placeholder="Rien à Signaler"  class="form-control" style="min-height: 50%"></textarea>

                                            <table>
                                                <tr>
                                                    <th>Heure d'absence</th>
                                                    <th>
                                                        <?php $__currentLoopData = $absence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($eleve->id==$abs->matricule): ?>
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
                                                            <td><?php echo e(number_format($moy=$total_coef/$coef,'2',',','')); ?> / 20</td>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="text-right ne_pas_imprimer">
                <button type="button" class="btn btn-success" id="imprimer_tout" onclick="window.print()">Imprimer tous les bulletins</button>
              </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/corps_trimestre.blade.php ENDPATH**/ ?>