<?php if(sizeOf($resultatprof)==0): ?>
<h1 class="centre">Vous n'êtes pas encore programmé</h1>
<?php else: ?>


<div class="card-body">
        <a href="#" class="register col-lg-12 modal-content fileupload bouton b1 btn-rounded waves-effect carousel-inner" class="btn-info" href=""
        style="font-size: 15px;color: #002b46">Mon Emploi de temps
    </a>
    <br>
    <div class="table-responsive " style="margin-top: -20px;">
        <table class="btn btn-sm " style="font-size: 15px;color: black;text-align: left; ">
            <tr class="btn-info">
                <th>HORAIRES</th>
                <?php for($i = 0; $i < sizeOf($configedt); $i++): ?>
                <th>
                    <?php echo e($configedt[$i]->hd.' à '.$configedt[$i]->hf); ?>

                </th>
                <?php endfor; ?>
            </tr>
            <?php
            $jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
            ?>


            <?php for($j =0 ; $j <sizeOf($jour) ; $j++): ?>
            <tr>
                    <td><?php echo e($jour[$j]); ?></td>

                    <?php for($conf =0 ; $conf <sizeOf($configedt) ; $conf++): ?>
                       <?php if($configedt[$conf]->libelle=='pause'): ?>
                        <td style="background-color: gray"> PAUSE</td>
                       <?php else: ?>
                    <td>
                        <?php for($i =0 ; $i <sizeOf($resultatprof) ; $i++): ?>

                              <?php if('tranche'.$resultatprof[$i]->tranche==$configedt[$conf]->tranche && $resultatprof[$i]->jour==$jour[$j]): ?>
                                    <?php echo e($resultatprof[$i]->matiere); ?>

                                    <br>
                                    <p class="register btn btn-sm btn-reverse"><?php echo e($resultatprof[$i]->classe); ?></p>
                                    <br>
                                    <?php for($p = 0; $p < sizeOf($mati); $p++): ?>
                                       <?php if($resultatprof[$i]->classe==$mati[$p]->classe && $resultatprof[$i]->matiere==$mati[$p]->nom): ?>
                                       <?php if($mati[$p]->nombre_heure <= 0): ?>
                                       <code>Cour terminé</code>
                                       <?php else: ?>
                                       <code><?php echo e($mati[$p]->nombre_heure); ?> H-R</code>
                                       <?php endif; ?>

                                       <?php break; ?>
                                       <?php endif; ?>
                                    <?php endfor; ?>



                              <?php endif; ?>

                        <?php endfor; ?>
                    </td>
                    <?php endif; ?>
                    <?php endfor; ?>
              </tr>
            <?php endfor; ?>



        </table>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/layout_emploi_prof.blade.php ENDPATH**/ ?>