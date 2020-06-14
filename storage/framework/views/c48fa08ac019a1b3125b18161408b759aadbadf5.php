<div class="row">
    <div class="col-sm-12">
        <div class="card-box">




            <?php $__currentLoopData = $classe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="table-responsive" style="page-break-after:always;" >
            <h4 class="m-t-0 header-title text-center"  id="title"><b id="b">Liste des élèves de la <?php echo e($item->nom_classe); ?></b></h4>

                <table class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableetudiants">

                    <thead id="entete">
                        <tr>
                            <th>Numéro</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>sexe</th>
                            <th>Date de naissance</th>
                        </tr>
                    </thead>
                    <tbody id="corps">

                        <?php
                        $verif=false;
                        $compt=0;
                        ?>
                        <?php for($i =0 ; $i < sizeOf($reponse) ; $i++): ?>
                         <?php if($reponse[$i]->classe==$item->nom_classe): ?>
                            <tr id="">
                                <td tabindex="1"><?php echo e($i); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->matricule); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->nom); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->prenom); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->sexe); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->naissance); ?></td>

                            </tr>
                            <?php
                            $verif=true;
                            $compt=$compt+1;
                            ?>
                            <?php endif; ?>
                            <?php endfor; ?>
                            <?php if(!$verif): ?>
                            <tr>
                                <td colspan="6" class="text-center alert-danger">

                                    <h4 class="m-t-0 header-title" id="title"><b id="b">Aucun élève dans cette salle de classe</b></h4>
                                </td>
                            </tr>
                            <?php endif; ?>

                    </tbody>
                </table>
                <br><br>
                <code> <?php echo e($compt); ?> élève(s)</code>
                <br>
                <?php
                    $test=false;
                ?>
                <?php $__currentLoopData = $titulaire; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($titu->classe==$item->id): ?>
                        <code>TITULAIRE : <?php echo e($titu->nom.' '.$titu->prenom); ?></code>
                        <?php
                            $test=true;
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(!$test): ?>
                <code>TITULAIRE : Pas de titulaire</code>
                <?php endif; ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        </div>
        <input type="button" class="btn btn-success  ne_pas_imprimer" style="float: right" button value="imprimer" onclick="window.print()">

    </div>
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsToutEleve.blade.php ENDPATH**/ ?>