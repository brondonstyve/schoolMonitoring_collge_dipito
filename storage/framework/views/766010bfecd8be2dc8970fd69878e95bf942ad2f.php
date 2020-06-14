<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title" id="statutclasse"><b id="b">Gerer les comptes professionels</b></h4>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tablecomptes">
                        <thead id="corps">
                            <tr>
                                <th>Numéro</th>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Type</th>
                                <th>Manipulations</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?>
                            <tr id="<?php echo e($classe[$i]->id); ?>">
                                <td tabindex="1"><?php echo e($i+1); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->matricule); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->nom); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->prenom); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->type); ?></td>
                                <td tabindex="1">


                                    <?php if($utilisateur->type=="superadmin"): ?>
                                    <a href="#"  id="supp-comptes" data-id="<?php echo e($classe[$i]->matricule); ?>">
                                            <code class="badge badge-danger">Supprimer  </code>
                                    </a>
                                    <?php if($classe[$i]->droit==null): ?>
                                    <a href="#"  id="don-ret-droit" data-id="<?php echo e($classe[$i]->matricule); ?>" data-val="donner">
                                            <code class="badge badge-info">Donner les Droits</code>
                                    </a>

                                    <?php else: ?>
                                    <a href="#"  id="don-ret-droit" data-id="<?php echo e($classe[$i]->matricule); ?>" data-val="retirer">
                                            <code class="badge badge-default">Retirer Les Droits</code>
                                    </a>
                                    <?php endif; ?>
                                    <?php endif; ?>


                                </td>
                            </tr>
                            <?php endfor; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="right"><?php echo e($classe->links()); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsGesComptes.blade.php ENDPATH**/ ?>