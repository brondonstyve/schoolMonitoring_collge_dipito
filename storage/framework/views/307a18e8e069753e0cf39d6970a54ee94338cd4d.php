<?php if(sizeOf($paiement)==0): ?>
                        <h3 class="text-center">Aucun paiement éffectué par <?php echo e($eleve[0]->nom.' '.$eleve[0]->prenom); ?></h3>
                    <?php else: ?>
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
<div class="col-sm-12">
<div class="card card-size2 color-md3">
<div class="card-body">
    <div class="d-flex flex-wrap">
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
    <?php if(sizeOf($paiement)==0): ?>
        <h3>Aucun paiement éffectué</h3>
    <?php else: ?>

    <?php endif; ?>
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
                                            <?php
                                                $testor=true;
                                            ?>
                                            <?php if($resultat[$i]->libelle == $paiement[$a]->libelle): ?>
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
                                            <?php
                                                $testor=false;
                                            ?>
                                             <?php else: ?>
                                              <?php if($testor): ?>
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
</div>
</div>
</div>
</div>



                    <?php endif; ?>


<br><br>


<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <?php if(sizeOf($reponse)<=0): ?>
            <h4 class="m-t-0 header-title" id="title"><b id="b">Aucun Paiement fixé pour <?php echo e($filiere[0]->nom); ?></b></h4>
              <?php else: ?>
              <h4 class="m-t-0 header-title" id="title"><b id="b">Moratoire pour <?php echo e($eleve[0]->nom.' '.$eleve[0]->prenom); ?></b></h4>


              <div class="table-responsive">
                  <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableetudiants">

                      <thead id="entete">
                          <tr>
                              <th>Tranche</th>
                              <th>montant</th>
                              <th>Pénalilité</th>
                              <th>date limite</th>
                              <th>Moratoire</th>
                          </tr>
                      </thead>
                      <tbody id="corps">
                          <?php for($i =0 ; $i < sizeOf($reponse) ; $i++): ?>
                          <tr id="">
                              <td tabindex="1">
                                <?php if($reponse[$i]->libelle=='tranche1'): ?>
                                Inscription
                            <?php else: ?>
                                <?php
                                    $t=explode('e',$reponse[$i]->libelle)[1];
                                ?>
                                Tranche<?php echo e($t-1); ?>

                            <?php endif; ?>
                              </td>
                              <td tabindex="1" ><?php echo e($reponse[$i]->montant); ?></td>
                              <td tabindex="1" ><?php echo e($reponse[$i]->penalite); ?></td>
                              <td tabindex="1"><?php echo e($reponse[$i]->date); ?></td>
                              <td><input type="button" value="moratoire" name="morat" id="moratoire"
                                data-moratoire_lib="<?php echo e($reponse[$i]->libelle); ?>" data-date="<?php echo e($reponse[$i]->date); ?>"
                                data-id="<?php echo e($eleve[0]->id); ?>" data-classe="<?php echo e($eleve[0]->classe); ?>"
                                data-matricule="<?php echo e($eleve[0]->matricule); ?>" class="btn btn-success"></td>
                              <input type="button" value="ok"  id="valider" data-toggle="modal" data-target="#demande_morat" class="fade">
                          </tr>
                          <?php endfor; ?>

                      </tbody>
                      <tfoot>
                          <tr>
                              <th></th>
                              <th></th>
                              <th></th>
                          </tr>
                      </tfoot>
                  </table>

              </div>
          </div>
      </div>
  </div>
<?php endif; ?>




<div id="demande_morat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Demande de moratoire</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('payer_moratoire_path')); ?>" method="post" class="form-horizontal form-material "
                    id="form_moratoire">
                    <?php echo csrf_field(); ?>
                    <div class="form-group ">
                        <div class="">
                            <strong>Date limite</strong>
                           <input class="form-control"  id="anc-date" disabled>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="">
                            <strong>Nouvelle échèance</strong>
                           <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>

                    <input type="hidden" name="matricule" id="id-elev">
                    <input type="hidden" name="tranche" id="nom_tranche">
                    <input type="hidden" name="ancDate" id="anc-dat">
                    <input type="hidden" name="classe" id="classe">
                    <input type="hidden" name="matri" id="matric">


            </div>
            <div class="modal-footer">
                <input type="submit" value="Demander" id="submit" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>

<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsListeTranche.blade.php ENDPATH**/ ?>