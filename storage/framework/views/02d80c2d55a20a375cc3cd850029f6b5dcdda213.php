<div class="row">
        <div class="col-sm-12">
            <div class="card-box">



                <div class="table-responsive" >
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableetudiants">

                        <thead id="entete">
                            <tr>
                                <th>Nom</th>
                                <th>prénom</th>
                                <?php for($r = 0; $r < sizeOf($resultat); $r++): ?>
                                 <th>
                                     <?php if($resultat[$r]->libelle=='tranche1'): ?>
                                    Inscription
                                <?php else: ?>
                                    <?php
                                        $t=explode('e',$resultat[$r]->libelle)[1];
                                    ?>
                                    Tranche<?php echo e($t-1); ?>

                                <?php endif; ?>
                            </th>
                                <?php endfor; ?>
                                <th>pénalités</th>
                                <th>Situation</th>
                                <th>Manipulations</th>

                            </tr>
                        </thead>
                        <tbody id="corps">
                            <?php for($l =0 ; $l <sizeOf($liste) ; $l++): ?>
                                <?php
                                $compter=0;
                                $compteur=0;
                                $penalite=0;
                                ?>
                            <tr id="">
                                <td tabindex="1"><?php echo e($liste[$l]->nom); ?></td>
                                <td tabindex="1" ><?php echo e($liste[$l]->prenom); ?></td>
                                <?php for($r = 0; $r < sizeOf($resultat); $r++): ?>
                                    <?php for($p = 0; $p < sizeOf($paiement); $p++): ?>
                                    <?php
                                        $testor=false;
                                    ?>
                                        <?php if($liste[$l]->matricule==$paiement[$p]->matricule): ?>



                                            <?php if($resultat[$r]->libelle==$paiement[$p]->libelle): ?>
                                              <td tabindex="1"style="color: green" >Payé</td>

                                                                        <?php
                                                                            $date1=new Date($paiement[$p]->date);
                                                                            $date2=new Date($resultat[$r]->date);
                                                                        ?>

                                                                            <?php if($date1 > $date2): ?>
                                                                                           <?php
                                                                                               $date1=number_format((strtotime($date1)-strtotime($date2))/86400);
                                                                                           ?>
                                                                                           <?php if($date1<=6 && $date1>0 ): ?>
                                                                                               <?php
                                                                                                    $penalite=$penalite + $resultat[$r]->penalite;
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
                                                                                                       <?php
                                                                                                         $penalite=$penalite + ($resultat[$r]->penalite * $compteur) + $resultat[$r]->penalite;
                                                                                                       ?>
                                                                                                       <?php else: ?>
                                                                                                       <?php
                                                                                                          $penalite=$penalite + ($resultat[$r]->penalite * $compteur);
                                                                                                       ?>
                                                                                                       <?php endif; ?>

                                                                                           <?php endif; ?>

                                                                                   <?php else: ?>

                                                                            <?php endif; ?>


                                                <?php break; ?>
                                                <?php
                                                    $testor=true;
                                                ?>

                                              <?php else: ?>

                                                    <?php for($nbPay = 0; $nbPay < sizeOf($paiement); $nbPay++): ?>
                                                        <?php if($liste[$l]->matricule==$paiement[$nbPay]->matricule): ?>
                                                            <?php
                                                                 $compter=$compter+1;
                                                            ?>
                                                        <?php endif; ?>

                                                    <?php endfor; ?>
                                                      <?php if(!$testor): ?>

                                                        <td tabindex="1" style="color: brown">Impayé</td>
                                                        <?php
                                                                            $date1=new Date();
                                                                            $date2=new Date($resultat[$r]->date);
                                                                        ?>

                                                                            <?php if($date1 > $date2): ?>
                                                                                           <?php
                                                                                              $date1= number_format((strtotime($date1)-strtotime($date2))/86400);
                                                                                           ?>
                                                                                           <?php if($date1<=6 && $date1>0 ): ?>
                                                                                               <?php
                                                                                                    $penalite=$penalite + $resultat[$r]->penalite ;
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
                                                                                                       <?php
                                                                                                         $penalite=$penalite + ($resultat[$r]->penalite * $compteur) + $resultat[$r]->penalite;
                                                                                                       ?>
                                                                                                       <?php else: ?>
                                                                                                       <?php
                                                                                                          $penalite=$penalite + ($resultat[$r]->penalite * $compteur);
                                                                                                       ?>
                                                                                                       <?php endif; ?>

                                                                                           <?php endif; ?>

                                                                                   <?php else: ?>

                                                                            <?php endif; ?>
                                                      <?php endif; ?>


                                            <?php endif; ?>





                                        <?php endif; ?>
                                    <?php endfor; ?>
                                <?php endfor; ?>
                                <?php
                                    $compt=0;
                                ?>
                                <?php for($nbPay = 0; $nbPay < sizeOf($paiement); $nbPay++): ?>
                                    <?php if($liste[$l]->matricule==$paiement[$nbPay]->matricule): ?>
                                         <?php
                                            $compt=$compt+1;
                                         ?>
                                    <?php endif; ?>

                                <?php endfor; ?>

                                <?php
                                    $statue=true;
                                ?>
                                <?php $__currentLoopData = $moratoire; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $morat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($liste[$l]->id==$morat->matricule): ?>
                                        <td style="color: rgb(19, 177, 79)">Moratoire</td>
                                         <?php break; ?>
                                    <?php else: ?>
                                    <?php
                                        $statue=false;
                                    ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if(!$statue): ?>
                                        <?php if($penalite<=0): ?>
                                        <td><?php echo e($penalite); ?> FCFA</td>
                                        <?php else: ?>
                                        <td style="color: brown"><?php echo e($penalite); ?> FCFA</td>
                                        <?php endif; ?>
                                <?php endif; ?>



                                <?php if($penalite<=0 && sizeOf($resultat)==$compt): ?>
                                    <td><a><code class="btn btn-success btn-sm">étudiant solvable</code></a></td>
                                    <?php else: ?>
                                    <td><a><code class="btn btn-danger btn-sm">étudiant insolvable</code></a></td>
                                <?php endif; ?>
                                <?php if($penalite>0): ?>
                                        <td><a href="<?php echo e(route('payer_penalite_path')); ?>?filiere=<?php echo e($resultat[0]->filiere); ?>&niveau=<?php echo e($resultat[0]->niveau); ?>&mat=<?php echo e($liste[$l]->matricule); ?>&classe=<?php echo e($liste[$l]->classe); ?>">
                                        <code class="btn btn-success btn-sm">Payer les pénalités</code></a></td>
                                    <?php else: ?>
                                    <td><code>pas de pénalités</code></td>
                                <?php endif; ?>
                             </tr>
                            <?php endfor; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsEleve.blade.php ENDPATH**/ ?>