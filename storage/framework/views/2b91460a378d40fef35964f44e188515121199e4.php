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
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card blog-widget card-size1 color-md1">
                <div class="card-body">
                    <div class="blog-image"><img src="images/img1.jpg" alt="img" class="img-responsive"></div>
                    <h3 class="<?php if($total - $reste ==0): ?> btn btn-sm btn-success <?php else: ?> btn btn-sm btn-danger <?php endif; ?>" >Statut Pension : <?php if($total - $reste ==0): ?> Solvable <?php else: ?> Non solvable <?php endif; ?></h3>
                    <br>
                        <p class="btn btn-sm btn-success"><span><?php echo e($utilisateur->matricule); ?></span></p>
                        <br>
                        <p class="btn btn-sm btn-success"><span>Classe: <?php echo e($utilisateur->classe); ?></span></p>
                    </span>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card card-size2 color-md3">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h3 class="card-title">Total a payer</h3>
                            <h3 class="card-subtitle">
                                <?php echo e($total); ?> FCFA
                            </h3>
                        </div>
                        <div class="ml-auto align-self-center">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <h6 class="text-muted text-info"><a href="">Reste</a>
                                    </h6>
                                </li>
                                <li>
                                    <h4 class="text-muted text-info"><a href=""> <?php echo e($total-$reste); ?> FCFA</a>
                                    </h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="campaign ct-charts">

                            <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive m-t-20">

                                            <table class="table stylish-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Tranche</th>
                                                            <th>Montant</th>
                                                            <th>statut</th>
                                                            <th>payé le</th>
                                                            <th>date limite</th>
                                                            <th>pénalité</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                <?php
                                                                     $penalite=0;
                                                                 ?>
                                                        <?php for($i = 0; $i < sizeOf($resultat); $i++): ?>
                                                        <tr >
                                                            <?php for($a = 0; $a < sizeOf($paiement); $a++): ?>
                                                            <?php if($resultat[$i]->libelle == $paiement[$a]->libelle): ?>
                                                              <?php
                                                                $plus=$i+1;
                                                              ?>
                                                            <td> <?php echo e($resultat[$i]->libelle); ?> </td>
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
                                                                                                ?>
                                                                                                <?php else: ?>
                                                                                                <?php echo e($k=($resultat[$i]->penalite * $compteur)); ?> FCFA
                                                                                                <?php
                                                                                                 $penalite=$penalite + $k;
                                                                                                ?>
                                                                                                <?php endif; ?>

                                                                                    <?php endif; ?>

                                                                            <?php else: ?>
                                                                            0 FCFA
                                                                     <?php endif; ?>
                                                             </td>
                                                            </tr>
                                                            <?php break; ?>
                                                             <?php else: ?>
                                                              <?php
                                                                $plus=$i+1;
                                                              ?>
                                                              <?php if($plus>sizeOf($paiement)): ?>
                                                              <tr style="color: brown">
                                                                    <td> <?php echo e($resultat[$i]->libelle); ?> </td>
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
                                                                                                       ?>
                                                                                                       <?php else: ?>
                                                                                                       <?php echo e($k=($resultat[$i]->penalite * $compteur)); ?> FCFA
                                                                                                       <?php
                                                                                                          $penalite=$penalite + $k;
                                                                                                       ?>
                                                                                                       <?php endif; ?>

                                                                                           <?php endif; ?>

                                                                                   <?php else: ?>
                                                                                   0 FCFA

                                                                            <?php endif; ?>
                                                                        </td>
                                                                        </tr>
                                                              <?php endif; ?>
                                                            <?php endif; ?>


                                                            <?php endfor; ?>



                                                        <?php endfor; ?>


                                                    </tbody>
                                                </table>

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
<?php /**PATH C:\laragon\www\StandPlace\resources\views/compte/corpsMessage.blade.php ENDPATH**/ ?>