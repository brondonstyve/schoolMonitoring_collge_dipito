<?php if(sizeOf($resultat)==0): ?>
<h1 class="centre">
    <?php if($utilisateur->type=='superadmin' || $utilisateur->type=='admin'): ?>
     Cette salle ne possède pas encore d'emploi de temps
    <?php else: ?>
    Vous n'êtes pas encore programmé
    <?php endif; ?>

</h1>
<?php else: ?>


<div class="card-body">
        <a href="#" class="register col-lg-12 modal-content fileupload bouton b1 btn-rounded waves-effect carousel-inner"
        style="font-size: 15px;color: #002b46">
        <span style="float: left;"> Emploi de temps delivré le <?php echo e($resultat[0]->created_at); ?>

    </a>
    <br>
    <div class="table-responsive " style="margin-top: -20px;">
        <table class="table table-striped m-b-10 centre btn btn-sm" style="font-size: 15px;color: black;text-align: left; ">
            <thead class="btn-info">
                <th>HORAIRES</th>
                <?php for($i = 0; $i < sizeOf($configedt); $i++): ?>
                <th>
                    <?php echo e($configedt[$i]->hd.' à '.$configedt[$i]->hf); ?>

                </th>
                <?php endfor; ?>
            </thead>
            <?php
            $jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
            ?>


            <tbody>
                    <?php for($j =0 ; $j <sizeOf($jour) ; $j++): ?>
                    <tr>
                            <td><?php echo e($jour[$j]); ?></td>

                            <?php for($conf =0 ; $conf <sizeOf($configedt) ; $conf++): ?>
                            <?php if($configedt[$conf]->libelle=='pause'): ?>
                            <td style="background-color: gray"> PAUSE</td>
                            <?php else: ?>
                            <td>
                                    <?php for($i =0 ; $i <sizeOf($resultat) ; $i++): ?>

                                          <?php if('tranche'.$resultat[$i]->tranche==$configedt[$conf]->tranche && $resultat[$i]->jour==$jour[$j]): ?>
                                                <i><?php echo e($resultat[$i]->matiere); ?></i><br>
                                                 <p class="register btn btn-sm btn-reverse">M. <?php echo e($resultat[$i]->nom); ?></p>
                                                <br>
                                                <?php if($periode[$i] <= 0): ?>
                                                <code>Cours terminé</code>
                                                <?php else: ?>
                                                <code><?php echo e($periode[$i]); ?> H-R</code>
                                                <?php endif; ?>

                                          <?php endif; ?>

                                    <?php endfor; ?>
                                </td>
                            <?php endif; ?>

                            <?php endfor; ?>

                      </tr>
                    <?php endfor; ?>
            </tbody>




        </table>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/compte/layout_emploi.blade.php ENDPATH**/ ?>