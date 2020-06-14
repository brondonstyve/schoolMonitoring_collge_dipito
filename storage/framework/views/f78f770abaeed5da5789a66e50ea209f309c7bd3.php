<?php
$jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
?>

<?php if($utilisateur->type==null): ?>


    <div class="">
        <div id="add-con" class="modal fade in" role="dialog" style="">
            <div class="modal-dialog">
                <div class="modal-content col-xs-5">
                    <div class="modal-body ">
                        <ul class="nav nav-tabs profile-tab">
                             </ul> </div> </div> </div>
                                        </div>
                                    </div> <!-- M.Debut page -->
                                        <h3 style="margin-top: -30px;"> Emploi de temps </h3>
                                        <div class="row">
                                            <div class="col-lg-8 ">
                                                <div class="card">
                                                    <!-- M.Nav tabs -->

                                                    <!-- M.emploi1 -->

                                                    <div class="tab-content">
                                                            <?php echo $__env->make('compte/layout_emploi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>



                                                </div>

                                            </div>


                                            <div class="col-lg-4 col-md-6">
                                                    <div class="card card-size color-md1">
                                                        <div class="card-body">
                                                            <h3 class="card-title">Programme des évaluations</h3>
                                                            <div id="visitor" style="height: 267px; width: 100%; max-height: 290px; position: relative;" class="c3">

                                                                    <div class="table-responsive m-t-20">

                                                                        <table class="table stylish-table">
                                                                                <tbody>
                                                                             <tr class="">

                                                                             </tr>
                                                                                </tbody>
                                                                         </table>

                                                            </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                        </div>




                                        <?php else: ?>

                                        <?php if($utilisateur->type=="enseignant"): ?>
                                        <!--Jours libres-->
                                        <?php if($test): ?>
                                        <div class="card-box">
                                            <div class="table-responsive">

                                                <form action="<?php echo e(route('disponibilite_edt_path')); ?>" method="post" class="col-lg-12 col-md-6">
                                                    <?php echo e(csrf_field()); ?>

                                                    <table class=""   style="background-color: azure">
                                                            <div class="col-md-6">
                                                                    <div class="card-box">
                                                                        <h4 class="m-t-0 header-title uppercase"><b>Mes jours de cours</b></h4>
                                                                        <p class="text-muted font-14 m-b-20">
                                                                             <code>mettre a jour sa disponibilité</code>
                                                                        </p>

                                                                        <div class="table-responsive">
                                                                            <table class="table m-0 table-colored-full table-full-inverse table-hover btn-sm" style="color: white">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Jour</th>
                                                                                    <?php for($i = 0; $i < sizeOf($configedt); $i++): ?>
                                                                                    <th>
                                                                                        <?php echo e($configedt[$i]->tranche); ?><br>
                                                                                        <?php echo e($configedt[$i]->hd .' à '.$configedt[$i]->hf); ?>

                                                                                    </th>
                                                                                    <?php endfor; ?>

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php for($dispo =0 ; $dispo <sizeOf($jour) ; $dispo++): ?>

                                                                                    <tr>
                                                                                            <th scope="row"><?php echo e($jour[$dispo]); ?></th>
                                                                                            <?php for($check =1 ; $check <=sizeOf($configedt) ; $check++): ?>
                                                                                            <?php if($configedt[($check-1)]->libelle!=='pause'): ?>
                                                                                            <td>
                                                                                                    <input type="hidden" name="nom_jour<?php echo e($dispo); ?>" value="<?php echo e($jour[$dispo]); ?>">
                                                                                                    <input type="checkbox" name="<?php echo e($jour[$dispo].'tranche'.$check); ?>" value="<?php echo e($check); ?>"
                                                                                                    <?php for($checked=0 ;  $checked<sizeOf($jour_dispo) ; $checked++): ?>
                                                                                                      <?php if($jour[$dispo]==$jour_dispo[$checked]->jour && $check==$jour_dispo[$checked]->tranche): ?> checked  <?php else: ?> <?php endif; ?>
                                                                                                    <?php endfor; ?>
                                                                                                    ><?php echo e($check); ?>

                                                                                                    <!--Notificateur-->
                                                                                                    <?php for($c=0 ;  $c<sizeOf($jour_dispo) ; $c++): ?>
                                                                                                      <?php if($jour[$dispo]==$jour_dispo[$c]->jour && $check==$jour_dispo[$c]->tranche): ?>
                                                                                                      <span class="notif"> <span class="heartbit"></span> <span class="point"></span> </span>
                                                                                                      <?php else: ?> <?php endif; ?>
                                                                                                    <?php endfor; ?>


                                                                                                 </td>
                                                                                                 <?php else: ?>
                                                                                                 <td>
                                                                                                 <input type="button" value="pause" class="btn btn-sm btn-info">
                                                                                                 </td>
                                                                                            <?php endif; ?>


                                                                                            <?php endfor; ?>
                                                                                        </tr>

                                                                                    <?php endfor; ?>
                                                                                </tbody>
                                                                                <tr>
                                                                                    <td colspan="<?php echo e((sizeOf($configedt) +5)); ?>" align="center">
                                                                                        <input type="hidden" name="taille" value="<?php echo e(sizeOf($configedt)); ?>">
                                                                                            <input type="submit" value="confirmer" class="btn btn-info" id="confirmeur">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                </form>




                                        <?php endif; ?>

                                        <br>
                                <h3 style="margin-top: -30px;"> </h3>

                                            <div class="col-lg-8 ">
                                                <div class="card">

                                                    <!-- M.emploi1 -->

                                                    <div class="tab-content">
                                                            <?php echo $__env->make('compte/layout_emploi_prof', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>



                                                </div>

                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div class="card card-size color-md1">
                                                    <div class="card-body">
                                                        <h3 class="card-title">Programme des évaluations</h3>
                                                        <div id="visitor" style="height: 267px; width: 100%; max-height: 290px; position: relative;" class="c3">

                                                                <div class="table-responsive m-t-20">

                                                                    <table class="table stylish-table">
                                                                            <tbody>
                                                                         <tr class="">

                                                                         </tr>
                                                                            </tbody>
                                                                     </table>

                                                        </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                             <?php endif; ?>
                                            <?php endif; ?>



                                        </form>

                                    </div>
                </div>
            </div>
        </div>





                </body>

                </html>

<?php /**PATH C:\laragon\www\StandPlace primaire\resources\views/compte/emploiT.blade.php ENDPATH**/ ?>