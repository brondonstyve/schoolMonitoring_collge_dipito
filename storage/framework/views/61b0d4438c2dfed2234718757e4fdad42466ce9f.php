<?php
                                    $total=0;
                                    $reste=0;
                                ?>

                                <?php for($i = 0; $i < sizeOf($paiement); $i++): ?>
                                 <?php
                                  $reste= $paiement[$i]->montant + $reste;
                                 ?>
                                <?php endfor; ?>

                                <?php for($i = 0; $i < sizeOf($resultat); $i++): ?>
                                  <?php
                                   $total= $resultat[$i]->montant + $total;
                                  ?>
                                <?php endfor; ?>
<div class="row">
        <!-- Column -->

        <div class="col-lg-12 col-xlg-9 col-md-7">
            <div class="card card-size2 color-md3">
                    <h3 class="card-title">Etudiant <?php echo e($paiement[0]->nom.' '.$paiement[0]->prenom); ?> de la <?php echo e($paiement[0]->classe); ?></h3>

                <div class="card-body">
                    <div class="d-flex flex-wrap">

                        <div>
                            <h4 class="card-title">Total a payer : <?php echo e($total); ?> FCFA</h4>
                        </div>
                        <div class="ml-auto align-self-center">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <h5 class="text-muted text-info"><a href="">Reste : <?php echo e($total-$reste); ?> FCFA</a>
                                    </h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="campaign ct-charts">

                            <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive m-t-20">
                                            <form action="<?php echo e(route('val_payer_penalite_path')); ?>" method="post">
                                                <?php echo e(csrf_field()); ?>

                                            <table class="table stylish-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Tranche</th>
                                                            <th>Montant</th>
                                                            <th>statut</th>
                                                            <th>payé le</th>
                                                            <th>date limite</th>
                                                            <th>pénalité</th>
                                                            <th>payer</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                <?php
                                                                     $penalite=0;
                                                                 ?>
                                                        <?php for($i = 0; $i < sizeOf($resultat); $i++): ?>
                                                        <?php
                                                            $pen=0;
                                                        ?>
                                                        <tr >
                                                            <?php for($a = 0; $a < sizeOf($paiement); $a++): ?>
                                                            <?php
                                                                $testor=true;
                                                            ?>
                                                            <?php if($resultat[$i]->libelle == $paiement[$a]->libelle): ?>
                                                              <?php
                                                                $plus=$i+1;
                                                              ?>
                                                            <td>
                                                                <?php if($resultat[$i]->libelle=='tranche1'): ?>
                                                                    Inscription
                                                                <?php else: ?>
                                                                    <?php
                                                                        $t=explode('e',$resultat[$i]->libelle)[1];
                                                                    ?>
                                                                    Tranche<?php echo e($t-1); ?>

                                                                <?php endif; ?>
                                                             </td>
                                                             <td> <?php echo e($resultat[$i]->montant); ?> </td>
                                                             <td> payé </td>
                                                             <td> <?php echo e($paiement[$a]->date); ?> </td>
                                                             <td> <?php echo e($resultat[$i]->date); ?> </td>
                                                             <td>
                                                                 <?php
                                                                     $date1=new Date($paiement[$a]->date);
                                                                     $date2=new Date($resultat[$i]->date);
                                                                 ?>

                                                                     <?php if($date1 > $date2): ?>
                                                                                    <?php
                                                                                         $date1=number_format((strtotime($date1)-strtotime($date2))/86400);

                                                                                    ?>
                                                                                    <?php if($date1<=6 && $date1>0 ): ?>
                                                                                        <?php echo e($k=$resultat[$i]->penalite); ?> FCFA
                                                                                        <?php
                                                                                            $penalite=$penalite + $k;
                                                                                            $pen=1;
                                                                                        ?>
                                                                                    <?php else: ?>

                                                                                            <?php
                                                                                                $compteur=0;
                                                                                                $rechargeur=0;
                                                                                                $jour_supp=0;
                                                                                            ?>
                                                                                                <?php for($p = 1; $p <= $date1 ; $p++): ?>
                                                                                                    <?php
                                                                                                        $rechargeur=$rechargeur + 1;
                                                                                                    ?>
                                                                                                    <?php if($rechargeur<=6): ?>
                                                                                                        <?php
                                                                                                            $jour_supp=1;
                                                                                                        ?>
                                                                                                        <?php else: ?>
                                                                                                        <?php
                                                                                                            $jour_supp=0;
                                                                                                        ?>
                                                                                                    <?php endif; ?>
                                                                                                    <?php if($rechargeur==7): ?>
                                                                                                        <?php
                                                                                                            $compteur=$compteur+ 1;
                                                                                                            $rechargeur=0;
                                                                                                            $jour_supp=0;
                                                                                                        ?>
                                                                                                    <?php endif; ?>
                                                                                                <?php endfor; ?>

                                                                                                <?php if($jour_supp==1): ?>
                                                                                                <?php echo e($k=($resultat[$i]->penalite * $compteur) + $resultat[$i]->penalite); ?> FCFA
                                                                                                <?php
                                                                                                 $penalite=$penalite + $k;
                                                                                                 $pen=1;
                                                                                                ?>
                                                                                                <?php else: ?>
                                                                                                <?php echo e($k=($resultat[$i]->penalite * $compteur)); ?> FCFA
                                                                                                <?php
                                                                                                 $penalite=$penalite + $k;
                                                                                                 $pen=1;
                                                                                                ?>
                                                                                                <?php endif; ?>

                                                                                    <?php endif; ?>

                                                                            <?php else: ?>
                                                                            0 FCFA
                                                                     <?php endif; ?>
                                                                     <?php if($pen<=0): ?>
                                                                            <td><input type="checkbox" name="payer<?php echo e($i); ?>" id="" value="<?php echo e($paiement[$a]->id); ?>" disabled></td>
                                                                            <?php else: ?>
                                                                           <td><input type="checkbox" name="payer<?php echo e($i); ?>" id="" value="<?php echo e($paiement[$a]->id); ?>"></td>
                                                                        <?php endif; ?>
                                                             </td>
                                                            </tr>
                                                            <?php break; ?>
                                                            <?php
                                                                $testor=false;
                                                            ?>
                                                             <?php else: ?>
                                                              <?php if($testor): ?>

                                                              <tr style="color: brown">
                                                                    <td> <?php if($resultat[$i]->libelle=='tranche1'): ?>
                                                                        Inscription
                                                                    <?php else: ?>
                                                                        <?php
                                                                            $t=explode('e',$resultat[$i]->libelle)[1];
                                                                        ?>
                                                                        Tranche<?php echo e($t-1); ?>

                                                                    <?php endif; ?></td>
                                                                     <td> <?php echo e($resultat[$i]->montant); ?></td>
                                                                     <td> non payé </td>
                                                                     <td> / </td>
                                                                     <td> <?php echo e($resultat[$i]->date); ?></td>
                                                                     <td>
                                                                         <?php
                                                                            $date1=new Date();
                                                                            $date2=new Date($resultat[$i]->date);
                                                                        ?>

                                                                            <?php if($date1 > $date2): ?>
                                                                                           <?php
                                                                                              $date1=number_format((strtotime($date1)-strtotime($date2))/86400);
                                                                                           ?>
                                                                                           <?php if($date1<=6 && $date1>0 ): ?>
                                                                                               <?php echo e($k=$resultat[$i]->penalite); ?> FCFA
                                                                                               <?php
                                                                                                    $penalite=$penalite + $k;
                                                                                                    $pen=1;
                                                                                               ?>
                                                                                           <?php else: ?>

                                                                                                   <?php
                                                                                                       $compteur=0;
                                                                                                       $rechargeur=0;
                                                                                                       $jour_supp=0;
                                                                                                   ?>
                                                                                                       <?php for($p = 1; $p <= $date1 ; $p++): ?>
                                                                                                           <?php
                                                                                                               $rechargeur=$rechargeur + 1;
                                                                                                           ?>
                                                                                                           <?php if($rechargeur<=6): ?>
                                                                                                               <?php
                                                                                                                   $jour_supp=1;
                                                                                                               ?>
                                                                                                               <?php else: ?>
                                                                                                               <?php
                                                                                                                   $jour_supp=0;
                                                                                                               ?>
                                                                                                           <?php endif; ?>
                                                                                                           <?php if($rechargeur==7): ?>
                                                                                                               <?php
                                                                                                                   $compteur=$compteur+ 1;
                                                                                                                   $rechargeur=0;
                                                                                                                   $jour_supp=0;
                                                                                                               ?>
                                                                                                           <?php endif; ?>
                                                                                                       <?php endfor; ?>

                                                                                                       <?php if($jour_supp==1): ?>
                                                                                                       <?php echo e($k=($resultat[$i]->penalite * $compteur) + $resultat[$i]->penalite); ?>FCFA
                                                                                                       <?php
                                                                                                         $penalite=$penalite + $k;
                                                                                                         $pen=1;
                                                                                                       ?>
                                                                                                       <?php else: ?>
                                                                                                       <?php echo e($k=($resultat[$i]->penalite * $compteur)); ?> FCFA
                                                                                                       <?php
                                                                                                          $penalite=$penalite + $k;
                                                                                                          $pen=1;
                                                                                                       ?>
                                                                                                       <?php endif; ?>

                                                                                           <?php endif; ?>

                                                                                   <?php else: ?>
                                                                                   0 FCFA

                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <?php if($pen<=0): ?>
                                                                            <td><input type="checkbox" name="payer<?php echo e($i); ?>" id="" value="<?php echo e($paiement[$a]->id); ?>" disabled></td>
                                                                            <?php else: ?>
                                                                           <td><input type="checkbox" name="payer<?php echo e($i); ?>" id="" value="<?php echo e($paiement[$a]->id); ?>" disabled></td>
                                                                        <?php endif; ?>
                                                                        </tr>
                                                              <?php endif; ?>
                                                            <?php endif; ?>


                                                            <?php endfor; ?>



                                                        <?php endfor; ?>


                                                    </tbody>
                                                    <tr>
                                                        <input type="hidden" name="nbre" value="<?php echo e(sizeOf($resultat)); ?>">
                                                        <td><input type="submit" value="payer" class="btn btn-success btn-sm"></td>
                                                    </tr>
                                                </table>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                    </div>

                    <?php if($penalite==0): ?>
                    <h1 class="btn btn-success btn-sm right">Pas de pénalités</h1>
                    <?php else: ?>
                    <h1 class="btn btn-success btn-sm right">statut de pénalités : <?php echo e($penalite); ?> FCFA</h1>
                    <?php endif; ?>

                    <div class="row text-center" style="float: right">
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>





    </div>
    </div>


    </body>

    </html>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/administration/layout/corpspaye_penalite.blade.php ENDPATH**/ ?>