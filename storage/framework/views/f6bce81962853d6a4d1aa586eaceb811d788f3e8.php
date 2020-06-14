<div class="card-body">
    <h4 class="card-title">Mes salles de classes</h4>

            <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?>
            <div class="col-lg-3 col-md-6" style="color: black">
                    <div class="card" style="background-color: aliceblue">
                        <div class="card-body" >
                            <div class="row p-t-10 p-b-10">
            <a class="nav-link  active btn-sm">
                 Fiche <?php echo e($i+1); ?> : <?php echo e($classe[$i]->classe); ?>

                 <hr>
                 <span><?php echo e($classe[$i]->nom); ?></span>
                 <form action="<?php echo e(route('remplir_note_path')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                     <input type="hidden" name="classe" value="<?php echo e($classe[$i]->classe); ?>">
                     <input type="hidden" name="id" value="<?php echo e($classe[$i]->id); ?>">
                     <input type="hidden" name="matiiere" value="<?php echo e($classe[$i]->nom); ?>">
                        <input type="submit" value="Liste des élèves" class="btn-sm">
                </form>
            </a>
    </div>
</div>
</div>
</div>
            <?php endfor; ?>

<?php if(!$ouverture): ?>
<h4 class="card-title">...</h4>

<?php else: ?>

   <?php if(sizeOf($liste)==0): ?>
      <h3 class="card-title">Aucun élève dans cette salle de classe! </h3>
   <?php else: ?>
   <div class="card-body" >
        <div style="color: black">
        <div id="visitor" >

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des séquences</h4>
                        <ul class="nav nav-pills m-t-30 m-b-30" style="margin-top: -10px">

                            <?php
                                $cc=0;
                                $sequence=0;
                                $parcoureur=0;
                                $trimestre=0;
                            ?>
                            <?php for($i = 0; $i < $sekuence[0]->nbsequence; $i++): ?>
                            <li class="nav-item">

                                    <?php if($parcoureur<2): ?>
                                      <a class="nav-link  <?php if($i+1==$sek): ?> active <?php endif; ?> " href=" <?php echo e(route('inserer_noteSek_path')); ?>?sek=<?php echo e($i+1); ?>&classe=<?php echo e($liste[0]->classe); ?>&id=<?php echo e($id); ?>&matiiere=<?php echo e($matiiere); ?>" role="tab" title="">
                                             CC <?php echo e(++$cc); ?>

                                      </a>
                                    <?php
                                            $parcoureur=$parcoureur+1;
                                        ?>

                                     <?php else: ?>
                                      <a class="nav-link  <?php if($i+1==$sek): ?> active <?php endif; ?> " href=" <?php echo e(route('inserer_noteSek_path')); ?>?sek=<?php echo e($i+1); ?>&classe=<?php echo e($liste[0]->classe); ?>&id=<?php echo e($id); ?>&matiiere=<?php echo e($matiiere); ?>" role="tab" title="">
                                        Séquence <?php echo e(++$sequence); ?>

                                      </a>
                                      <?php
                                         $parcoureur=$parcoureur+1;
                                     ?>

                                     <?php if($parcoureur==4): ?>
                                      <?php
                                      $parcoureur=0;
                                     ?>

                                     <?php endif; ?>



                                    <?php endif; ?>

                            </li>
                            <?php endfor; ?>



                        </ul>

                    <hr>
                    <div class="tab-content br-n pn">

                    <div id="sek" class="tab-pane active">

                                <div class="row">

                                    <div class="table-responsive m-t-20">
                                        <form action="<?php echo e(route('inserer_note_path')); ?>" method="post" style="margin-left: 2%;margin-right: 2%;">
                                            <?php echo e(csrf_field()); ?>

                                                <h3 class="card-title">notes des élèves de la <?php echo e($liste[0]->classe); ?> en <?php echo e($matiiere); ?>

                                                    <?php switch($sek):
                                                        case (1): ?>
                                                          CC 1
                                                            <?php break; ?>
                                                        <?php case (2): ?>
                                                            CC 2
                                                            <?php break; ?>
                                                            <?php case (3): ?>
                                                          Séquence 1
                                                            <?php break; ?>
                                                        <?php case (4): ?>
                                                            Séquence 2
                                                            <?php break; ?>
                                                            <?php case (5): ?>
                                                          CC 3
                                                            <?php break; ?>
                                                        <?php case (6): ?>
                                                            CC 4
                                                            <?php break; ?>
                                                            <?php case (7): ?>
                                                            Séquence 3
                                                            <?php break; ?>
                                                        <?php case (8): ?>
                                                            Séquence 4
                                                            <?php break; ?>
                                                            <?php case (9): ?>
                                                          CC 5
                                                            <?php break; ?>
                                                        <?php case (10): ?>
                                                            CC 6
                                                            <?php break; ?>
                                                            <?php case (11): ?>
                                                          Séquence 5
                                                            <?php break; ?>
                                                        <?php case (12): ?>
                                                            Séquence 6
                                                            <?php break; ?>
                                                        <?php default: ?>

                                                    <?php endswitch; ?>
                                                </h3>
                                            <table class="table stylish-table" >
                                                <thead>
                                                        <tr>
                                                            <th>Numéro</th>
                                                            <th>Nom</th>
                                                            <th>Prenom</th>
                                                            <th>Note / 20</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                    <?php
                                                        $spacer='';
                                                    ?>
                                        <?php for($i = 0; $i < sizeOf($liste); $i++): ?>
                                             <tr class="">

                                                    <td><?php echo e($i+1); ?></td>
                                                    <td><?php echo e($liste[$i]->nom); ?></td>
                                                    <td><?php echo e($liste[$i]->prenom); ?></td>
                                                    <td><input type="number" name="note<?php echo e($i); ?>" min="0" max="20" step="0.01"
                                                    value="<?php for($r = 0; $r < sizeOf($remplisseur); $r++): ?><?php if($remplisseur[$r]->compte==$liste[$i]->id): ?><?php echo e($remplisseur[$r]->note); ?><?php endif; ?><?php echo e($spacer); ?><?php endfor; ?>">
                                                    </td>


                                                    <input type="hidden" name="sek<?php echo e($i); ?>" value="<?php echo e($sek); ?>">
                                                    <input type="hidden" name="id_matiere<?php echo e($i); ?>" value="<?php echo e($id); ?>">
                                                    <input type="hidden" name="id_compte<?php echo e($i); ?>" value="<?php echo e($liste[$i]->id); ?>">

                                                </tr>

                                        <?php endfor; ?>


                                      </tbody>
                                      </table>
                                     <input type="hidden" name="compteur" value="<?php echo e(sizeOf($liste)); ?>">
                                      <input type="submit" value="Soumettre">
                                      </form>
                                   </div>
                                </div>

                        </div>


                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
   <?php endif; ?>
   <?php endif; ?>

<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/sousCompte/notesProfesseur.blade.php ENDPATH**/ ?>