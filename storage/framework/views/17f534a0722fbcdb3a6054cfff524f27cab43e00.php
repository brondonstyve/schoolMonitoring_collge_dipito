<div class="card">
    <div class="card-body bg-info">
        <h4 class="text-white card-title uppercase">Mes cours</h4>
        <h6 class="card-subtitle text-white m-b-0 op-5">Liste des cours</h6>
    </div>
    <div class="card-body">
        <div class="message-box contact-box">





    <?php for($i = 0; $i < sizeOf($cour); $i++): ?>
    <?php
        $compt=1;
    ?>
        <div class="message-widget contact-widget" style="background-color: white" title="">


                <!-- Message -->
                <a data-toggle="collapse" data-target="#demo<?php echo e($i); ?>">
                    <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                        <span class="profile-status online pull-right" style="color: black"></span>
                    </div>
                    <div class="mail-contnet">
                        <h5 style="text-transform: uppercase"> <?php echo e($cour[$i]->nom); ?> </h5>
                        <span class="mail-desc"> Cliquer pour dérouler et voir les cours de <?php echo e($cour[$i]->nom); ?> </span>
                    </div>

                </a>
                <!-- sous menu -->

                  <div class="collapse contact-box" style="top: -0px; background-color: white;max-width: 90%; right: -10%;" id="demo<?php echo e($i); ?>">


                    </div>
                    <?php
                        $compte=true;
                    ?>
                    <?php for($c = 0; $c < sizeOf($course); $c++): ?>

                    <?php if($course[$c]->classe==$cour[$i]->nom): ?>
                    <div class="collapse contact-box" id="demo<?php echo e($i); ?>" style="top: -0px; background-color: #57bec5;max-width: 90%; relative;right: -10%;">

                        <span style="float: right;color: green;font-size: 10px" class=" uppercase">
                            <a href="<?php echo e(route('telechargement_path',$course[$c]->id_cours)); ?>">télécharger</a>
                        </span>
                        <a href="<?php echo e(route('coursDetail_path')); ?>?cour=<?php echo e(encrypt($course[$c]->id_cours)); ?>&&mat=<?php echo e(encrypt($course[$c]->matiere)); ?>" title="Cliquer pour voir" >
                            <div class="user-img"> <img src="images/courrs.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right" style="color: black"></span>
                            </div>

                            <div class="mail-contnet">
                                    <h5 style="text-transform: uppercase">cours <?php echo e($compt); ?> </h5>
                                    <span class="mail-desc">libellé: <?php echo e($course[$c]->libelle); ?> (<?php echo e(number_format(((fileSize('storage/cours/'.$course[$c]->fichier))/1048576),'2',',','')); ?> Mo)
                                        <span style="float: right">Crée le <?php echo e($course[$c]->created_at); ?></span>

                                    </span>
                                    <h5 class="mail-desc">
                                        <?php echo e($course[$c]->commentaire); ?>

                                    </h5>
                                </div>
                        </a>

                        <?php
                         $compt++
                        ?>
                    </div>
                    <?php
                        $compte=false;
                    ?>
                    <?php endif; ?>

                    <?php endfor; ?>

                    <?php if($compte): ?>
                    <div class="collapse contact-box" id="demo<?php echo e($i); ?>" style="top: -0px; background-color: #f96a74;max-width: 90%; relative;right: -10%;">
                        <a>
                            <div class="user-img"> <img src="images/bloc.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right" style="color: black"></span>
                            </div>

                            <div class="mail-contnet">
                                    <h5 style="text-transform: uppercase">Aucun cour</h5>
                                    <span class="mail-desc" style="color: black">vous n'avez pas envore crée de cours pour cette classe. crére en un!</span>
                                </div>
                        </a>


                </div>
                    <?php endif; ?>





    </div>


    <?php endfor; ?>



</div>



</div>

</div>
</div>




<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/corpscoursEtu.blade.php ENDPATH**/ ?>