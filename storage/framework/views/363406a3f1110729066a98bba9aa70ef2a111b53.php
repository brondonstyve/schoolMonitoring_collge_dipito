<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-xlg-2 col-lg-4 col-md-4">
                        <div class="card-body">
                        </div>
                        <?php
                        $compteur=0;
                        ?>
                        <?php for($i = 0; $i < sizeOf($notification); $i++): ?> <?php if($notification[$i]->matricule=='public' ||
                            $notification[$i]->matricule==$utilisateur->matricule ||
                            $notification[$i]->classe==$utilisateur->classe || $notification[$i]->compte==$utilisateur->id ): ?>
                            <?php
                            $compteur=$compteur+1;
                            ?>
                            <?php endif; ?>
                            <?php endfor; ?>
                            <div class="card-body inbox-panel"><a
                                    class="btn btn-info btn-sm m-b-20 p-10 btn-block waves-effect waves-light"
                                    style="color: white">liste de notification(s)</a>
                                <ul class="list-group list-group-full">
                                    <?php if($compteur==0): ?>

                                    <?php else: ?>
                                    <?php for($i = 0; $i < sizeOf($notification); $i++): ?> <?php if($notification[$i]->
                                        matricule=='public' || $notification[$i]->matricule==$utilisateur->matricule ||
                                        $notification[$i]->classe==$utilisateur->classe || $notification[$i]->compte==$utilisateur->id ): ?>
                                        <a href="<?php echo e(route('voir_notifications_path')); ?>?id=<?php echo e($notification[$i]->id); ?>">
                                        <li class="list-group-item <?php if($notif_a_voir->id==$notification[$i]->id): ?> active <?php endif; ?>" style="border: 1px steelblue solid">
                                                <img src="images/notif2.png" width="20px">
                                                <span style="<?php if($notif_a_voir->id==$notification[$i]->id): ?> color:black; <?php endif; ?>">
                                                    <?php echo e($notification[$i]->type); ?>

                                                    <code>
                                                    <?php
                                                    $date1=new Date($notification[$i]->created_at);
                                                    $date2=new Date();
                                                    $date=number_format((strtotime($date2)-strtotime($date1))/60);
                                                    $date_h=number_format((strtotime($date2)-strtotime($date1))/3600);
                                                    $date_j=number_format((strtotime($date2)-strtotime($date1))/86400);

                                                ?>
                                                <?php if($date_j>0): ?>
                                                   il y'a <?php echo e($date_j); ?>  <?php if($date_j<=1): ?> Jour <?php else: ?> Jours <?php endif; ?>

                                                  <?php else: ?>
                                                  <?php if($date<=60): ?>
                                                     il y'a <?php echo e($date); ?>  <?php if($date<=1): ?> minute <?php else: ?> minutes <?php endif; ?>
                                                 <?php else: ?>
                                                  <?php if($date_h<=24): ?>
                                                     il y'a <?php echo e($date_h); ?>  <?php if($date_h<=1): ?> heure <?php else: ?> heures <?php endif; ?>
                                                  <?php endif; ?>
                                                 <?php endif; ?>
                                                <?php endif; ?>
                                            </code>
                                                </span>
                                        </li>
                                    </a>
                                        <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php endif; ?>
                                        <?php if($compteur>5): ?>
                                        <a class="text-center" href="<?php echo e(route('notifications_path')); ?>"><small><code>Voir tout</code></small></a>

                                        <?php endif; ?>
                                </ul>
                            </div>
                    </div>

                    <div class="col-xlg-10 col-lg-8 col-md-8">
                        <div class="card-body">
                        </div>
                        <div class="card-body p-t-0">

                                <div class="card b-all shadow-none">
                                    <div class="btn btn-info ">
                                        <h3 class=" btn-sm" style="color: white"> Contenu demandé :
                                            <?php echo e($notif_a_voir->type); ?></h3>
                                    </div>
                                    <div>
                                        <hr class="m-t-0">
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex m-b-30">
                                            <div class="p-l-10">
                                                <h4 class="m-b-0"><?php echo e($utilisateur->nom); ?></h4>
                                                <small class="text-muted"><?php echo e($utilisateur->email); ?></small>
                                            </div>
                                        </div>
                                        <p class="badge badge-error">contenu</p>
                                        <p><b><?php echo e($notif_a_voir->message); ?></b></p>
                                        <code>
                                            <?php
                                            $date1=new Date($notif_a_voir->created_at);
                                            $date2=new Date();
                                            $date=number_format((strtotime($date2)-strtotime($date1))/60);
                                            $date_h=number_format((strtotime($date2)-strtotime($date1))/3600);
                                            $date_j=number_format((strtotime($date2)-strtotime($date1))/86400);

                                        ?>
                                        <?php if($date_j>0): ?>
                                           il y'a <?php echo e($date_j); ?>  <?php if($date_j<=1): ?> Jour <?php else: ?> Jours <?php endif; ?>

                                          <?php else: ?>
                                          <?php if($date<=60): ?>
                                             il y'a <?php echo e($date); ?>  <?php if($date<=1): ?> minute <?php else: ?> minutes <?php endif; ?>
                                         <?php else: ?>
                                          <?php if($date_h<=24): ?>
                                             il y'a <?php echo e($date_h); ?>  <?php if($date_h<=1): ?> heure <?php else: ?> heures <?php endif; ?>
                                          <?php endif; ?>
                                         <?php endif; ?>
                                        <?php endif; ?>
                                    </code>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/corps_voir_notif.blade.php ENDPATH**/ ?>