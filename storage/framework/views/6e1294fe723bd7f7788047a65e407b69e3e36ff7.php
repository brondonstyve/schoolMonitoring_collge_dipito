<div class="row">
    <?php for($i =1 ; $i <=sizeOf($tableau) ; $i++): ?>
    <div class="col-xl-3 col-sm-6">
            <div class="card-box widget-user">
                <div>
                    <img src="images/admin/avatar-3.jpg" class="img-responsive img-circle" alt="user">
                    <div class="wid-u-info">
                        <h5 class="m-t-20 m-b-5"><?php echo e($tableau[$i]->nom.' '.$tableau[$i]->prenom); ?></h5>
                        <p class="text-muted m-b-0 font-14"><?php echo e($tableau[$i]->email); ?></p>
                        <p class="text-muted m-b-0 font-14"><?php echo e($tableau[$i]->classe); ?></p>
                        <div class="user-position">
                            <span class="text-warning font-secondary">candidat <?php echo e($i); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endfor; ?>

    </div>

    <form action="<?php echo e(route('Lancer_vote_etudiant_path')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

            <?php for($i =1 ; $i <=sizeOf($tableau) ; $i++): ?>
            <input type="hidden" name="matricule<?php echo e($i); ?>" value="<?php echo e($tableau[$i]->id); ?>">
            <?php endfor; ?>
            <input type="hidden" name="nbre" value="<?php echo e(sizeOf($tableau)); ?>">
            <button type="submit" class="btn btn-success right col-sm-12">Valider</button>
    </form>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsVote.blade.php ENDPATH**/ ?>