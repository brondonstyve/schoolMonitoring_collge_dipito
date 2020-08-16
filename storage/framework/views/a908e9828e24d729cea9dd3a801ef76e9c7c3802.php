<div class="card">
    <div class="card-body bg-info">
        <h4 class="text-white card-title uppercase">Mes salles de classe</h4>
        <h6 class="card-subtitle text-white m-b-0 op-5">Liste des salles où je dispense cours</h6>
    </div>
    <div class="card-body">
        <div class="message-box contact-box">


                    <!-- tout supprimer les epreuves -->
    <a href="" class=" btn-sm btn-danger" data-toggle="modal" data-target="#supp-tout-ep">Tout supprimer</a>

                        <div class="table-responsive ">
                                <div id="supp-tout-ep" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content col-xs-9">
                                            <div class="modal-header ">
                                            <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer toutes les cours?</h4>
                                        </div>
                                        <div class="modal-title">

                                                <div class="form-group" style="text-align: center;">
                                                    <div class="col-md-12 m-b-20 carousel-inner">
                                                        <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner">
                                                            <span>
                                                                    <a href="<?php echo e(route('supprimer_tout_cours_path')); ?>">Confirmer</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


    <?php for($i = 0; $i < sizeOf($cour); $i++): ?>

        <div class="message-widget contact-widget" style="background-color: white" title="">


                <!-- Message -->
                <a data-toggle="collapse" data-target="#demo<?php echo e($i); ?>">
                    <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                        <span class="profile-status online pull-right" style="color: black"></span>
                    </div>
                    <div class="mail-contnet">
                        <h5 style="text-transform: uppercase"> <?php echo e($cour[$i]->classe); ?> </h5>
                        <span class="mail-desc"> Cliquer pour dérouler et voir les cours de la <?php echo e($cour[$i]->classe); ?> </span>
                    </div>

                </a>
                <h6 class="">
                  <h6 data-toggle="modal" data-target="#cours" id="new_course" data-classe="<?php echo e($cour[$i]->classe); ?>">
                    Ajouter un cours à la <?php echo e($cour[$i]->classe); ?> ici  <img src="images/icones/add-green.png" class="btn btn-circle btn-lg waves-effect">
                  </h6>
                </h6>
                <!-- sous menu -->

                  <div class="collapse contact-box" style="top: -0px; background-color: white;max-width: 90%; right: -10%;" id="demo<?php echo e($i); ?>">

                    <!--supprimer-->


             <!--fin suppression-->

                    </div>
                    <?php
                        $compte=true;
                    ?>
                    <?php for($c = 0; $c < sizeOf($course); $c++): ?>

                    <?php if($course[$c]->classe==$cour[$i]->classe): ?>

                    <div class="collapse contact-box" id="demo<?php echo e($i); ?>" style="top: -0px; background-color: #57bec5;max-width: 90%; relative;right: -10%;">
                        <a href="<?php echo e(route('coursDetail_path')); ?>?cour=<?php echo e(encrypt($course[$c]->id_cours)); ?>&&mat=<?php echo e(encrypt($course[$c]->matiere)); ?>" title="Cliquer pour voir" id="<?php echo e($course[$c]->id_cours); ?>">
                            <div class="user-img"> <img src="images/courrs.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right" style="color: black"></span>
                            </div>

                            <div class="mail-contnet">
                                    <h5 style="text-transform: uppercase">cours de <?php echo e($course[$c]->nom); ?> </h5>
                                    <span class="mail-desc">libellé: <?php echo e($course[$c]->libelle); ?></span>


                                </div>

                                <span class="btn-sm" style="text-transform: uppercase;color:brown">
                                    <span class="mail-desc" style="display: inline-block; max-width: 20px; right: 50%">
                                        <img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-target="#add-sup0" data-id="<?php echo e($course[$c]->id_cours); ?>" id="img_supp">
                                    </span>
                                </span>
                        </a>
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



  <!-- The Modal -->
  <div class="modal" id="cours">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ajouter un cours</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action=" <?php echo e(route('enregistrer_cours_path')); ?> " method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <div class="">
                    <strong>Classe:</strong>
                    <input type="text" id="classe" class="form-control" disabled>
                    <input type="hidden" id="classeh" name="classe" class="form-control" disabled>
                </div>
            </div>


            <div class="form-group">
                <div class="">
                    <strong>Libéllé:</strong>
                    <input type="text" id="classe" name="libelle" class="form-control" required>
                </div>
            </div>


            <div class="form-group">
                <div class="">
                    <strong>Matière:</strong>
                    <div id="-1">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <strong>Fichier:</strong>
                    <input type="file" name="fichier" id="" class="form-control" accept="application/pdf" required>
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <strong>commentaire:</strong>
                    <textarea name="comment" id="" rows="5"  class="form-control" placeholder="faites un petit commentaire concernant le cours" required></textarea>
                </div>
            </div>




        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Envoyer</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </div>
    </form>
      </div>
    </div>
  </div>






    <div id="add-sup0" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-9">
                <div class="modal-header ">
                <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer ce ficher?</h4>
            </div>
            <div class="modal-title">

                    <div class="form-group" style="text-align: center;">
                        <div class="col-md-12 m-b-20 carousel-inner">
                            <input type="hidden" id="id_supp" value="">
                            <button type="button" class="btn btn-success pull-left" id="supp_conf" data-dismiss="modal">Confirmer</button>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
            </div>
        </div>
</div>
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/compte/corpscoursProf.blade.php ENDPATH**/ ?>