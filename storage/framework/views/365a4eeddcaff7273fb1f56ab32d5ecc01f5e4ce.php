<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <?php if(sizeOf($reponse)==0): ?>
                <h4 class="m-t-0 header-title" id="statutclasse"><b>Aucun conseils de discipline  jugés</b></h4>
                <?php else: ?>
                <h4 class="m-t-0 header-title" id="statutclasse"><b>Liste des conseils de discipline jugés</b></h4>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tablecd">
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Nom / Prénom</th>
                                <th>Classe</th>
                                <th>Motif</th>
                                <th>nom du juge</th>
                                <th>Decision</th>
                                <th>Sanction</th>
                            </tr>
                        </thead>
                        <tbody id="nouveau">
                            <!--Nouvelle insertion-->
                        </tbody>
                        <tbody id="tbody">
                            <?php for($i =0 ; $i <sizeOf($reponse) ; $i++): ?>
                            <tr id="<?php echo e($reponse[$i]->id); ?>">
                                <td tabindex="1"><?php echo e($reponse[$i]->matricule); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->nom_e.' '.$reponse[$i]->prenom_e); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->classe); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->motif); ?></td>
                                <td tabindex="1"><?php echo e($reponse[$i]->nom_juge); ?></td>
                                <?php if($reponse[$i]->coupable==1): ?>
                                <td tabindex="1" class="badge-danger">Coupable</td>
                                <td tabindex="1" class="btn-info"><?php echo e($reponse[$i]->sanction); ?></td>
                                    <?php else: ?>
                                <td tabindex="1" class="badge-success">Nom coupable</td>
                                <td tabindex="1" class="btn-info">Pas de sanction</td>
                                <?php endif; ?>


                            </tr>
                            <?php endfor; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="right" colspan="7"><?php echo e($reponse->links()); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
