<?php if($test): ?>
   <div class="card">
        <div class="card-body bg-info">
         <?php if(sizeOf($evaluation)==0): ?>
            <h4 class="text-white card-title uppercase">Vous n'avez pas d'évaluation pour le moment</h4>
            <h6 class="card-subtitle text-white m-b-0 op-5">étudiez c'est pour bientôt</h6>
            <?php else: ?>
            <h4 class="text-white card-title uppercase">Liste des évaluations en cour</h4>
            <h6 class="card-subtitle text-white m-b-0 op-5">Détails</h6>
        <?php endif; ?>

        </div>


        <div class="card-body">
            <div class="message-box contact-box">

                <?php for($i =0 ; $i <sizeOf($evaluation) ; $i++): ?>
                <span class="point">
                        <div class="message-widget contact-widget" style="background-color: antiquewhite"
                        title="">

                        <a href="<?php echo e(route('composition_path')); ?>?path_directoriesRender=<?php echo e(encrypt($evaluation[$i]->id)); ?>"title="commencer">
                            <div class="user-img"> <img src="images/icones/modifier.png" alt="user" class="img-circle">
                                <div class="notify">
                                        <span class="heartbit"></span> <span class="point"></span>
                                    </div>
                            </div>

                            <div class="mail-contnet">
                                <h5 style="text-transform: uppercase">évaluation de <?php echo e($evaluation[$i]->nom); ?> pour <?php if($evaluation[$i]->libelle=='sn'): ?> la <?php else: ?> le <?php endif; ?> <?php echo e($evaluation[$i]->libelle); ?></h5>
                                <span class="mail-desc">
                                    édité le <?php echo e($evaluation[$i]->created_at); ?> par <?php echo e($evaluation[$i]->editeur); ?>

                                    <span style="float: right">Date: <?php echo e($heure_de_debut[$i]); ?></span>
                                </span>
                            </div>
                                <span class="btn-sm" style="color:brown">durée : <?php echo e($evaluation[$i]->dure); ?> min</span>
                            </a>

                            <h2 class="add-ct-btn">
                                    <a href="<?php echo e(route('composition_path')); ?>?path_directoriesRender=<?php echo e(encrypt($evaluation[$i]->id)); ?>"title="commencer">

                                    <button type="" class="btn btn-circle btn-lg btn-success waves-effect waves-dark">
                                                    <img src="images/icones/evaluer.png" alt="commencer" width="50px">
                                    </button>
                                </a>
                                </h2>
                    </div>
                </span>
                <hr>
                <?php endfor; ?>
            </div>
        </div>


    </div>
    <span><?php echo e($evaluation->links()); ?></span>

<?php endif; ?>



