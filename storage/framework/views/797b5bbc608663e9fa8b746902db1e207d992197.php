 <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if($utilisateur->vote_statut==true): ?>
                    <h3 class="centre">Vous avez deja voté</h3>
                <?php else: ?>
                <h4 class="card-title">Les Candidats</h4>

                <ul class="nav nav-pills m-t-30 m-b-30" style="margin-top: -10px">
                        <?php for($i =0 ; $i <sizeOf($resultat) ; $i++): ?>
                        <li class="nav-item"> <a
                            class="nav-link <?php if($i==0): ?> active <?php endif; ?>" data-toggle="tab"
                            href="#candisat<?php echo e($i); ?>" role="tab" title=""> Candidat <?php echo e($i+1); ?> </a> </li>
                        <?php endfor; ?>
                </ul>

            <hr>
            <div class="tab-content br-n pn" >

                <?php for($k =0 ; $k <sizeOf($resultat) ; $k++): ?>

                <div id="candisat<?php echo e($k); ?>" class="tab-pane <?php if($k==0): ?> active <?php endif; ?>">
                        <div class="row">
                            <div class="col-md-2"> <img src="images/9.jpg" class="img-responsive thumbnail m-r-15"> </div>
                            <form action="<?php echo e(route('vote_envoi_path')); ?>" method="post">
                                <?php echo e(csrf_field()); ?>

                            <input type="submit" value="Voter" class="btn btn-info active" style="float: right;">
                            <div class="col-md-8">
                            <h3><?php echo e($resultat[$k]->nom); ?></h3>
                            <p><?php echo e($resultat[$k]->nom.' '.$resultat[$k]->prenom); ?><br>
                            <h5 style="font-size: 15px;">Voter pour <?php if($resultat[$k]->type=='enseignant'): ?> M.<?php endif; ?> <?php echo e($resultat[$k]->nom); ?> <?php if($resultat[$k]->type=='etudiant'): ?> de la <?php echo e($resultat[$k]->classe); ?><?php endif; ?></h5>
                            <input type="hidden" name="id" value="<?php echo e($resultat[$k]->id); ?>">
                            <input type="hidden" name="nbreVote" value="<?php echo e($resultat[$k]->voix); ?>">
                            </p>
                            </div>
                        </form>
                        </div>

                    </div>

                <?php endfor; ?>
                <?php endif; ?>






                </div>
            </div>
        </div>
    </div>






<section class="kc-elm kc-css-307273 kc_row">
    <div class="kc-row-container  kc-container">
        <div class="kc-wrap-columns">
            <div class="kc-elm kc-css-454294 kc_col-sm-12 kc_column kc_col-sm-12">
                <div class="kc-col-container">
                    <br>
                    <div class="widget-heading-title center_color">
                        <h3 class="title"> Resultat du dernier vote  </h3>
                    </div>

                    <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <h4 class="card-title">Resultats du vote instantané</h4>
                                </div>
                                <div class="table-responsive m-t-20">

                                            <?php if(sizeOf($liste)==0): ?>
                                            <h4 class="card-title">Aucun vote initialisé pour le moment</h4>
                                            <?php else: ?>

                                            <table class="table stylish-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Profil</th>
                                                            <th>nom</th>
                                                            <th>Evolution</th>
                                                            <th>Position</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                            <?php for($i = 0; $i < sizeOf($resultat); $i++): ?>
                                            <tr class="">
                                                    <td><span class="round"><img src="images/2.jpg" alt="user" width="50"></span><td>
                                                        <h6> <?php echo e($liste[$i]->nom); ?> </h6><small class="text-muted"><?php echo e($liste[$i]->prenom); ?>  </small></td>
                                                    <td> <?php echo e($liste[$i]->voix); ?> voix <br><div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($liste[$i]->vote); ?>%; height:25px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> </td>
                                                    <td><span class="label label-info"> <?php echo e($i+1); ?><?php if($i==0): ?> ier <?php else: ?> ieme <?php endif; ?>  </span></td>
                                                </tr>
                                            <?php endfor; ?>

                                            <?php endif; ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    <br>
                    <div class="kc-elm kc-css-163267 kc_row kc_row_inner">
                        <div class="kc-elm kc-css-160175 kc_col-sm-12 kc_column_inner kc_col-sm-12">
                            <div class="kc_wrapper kc-col-inner-container">
                                <div class="widget widget-lecturer">
                                    <div class="row" >
                                    <?php if(sizeOf($premier)==0): ?>

                                    <?php else: ?>
                                    <?php if( $premier[0]->voix ==0): ?>
                                    <h3 class="title"> Pas de meilleur pour le moment </h3>
                                <?php else: ?>



                                <div class="col-md-4 col-sm-4 col-xs-12" >

                                        <div class="widget-heading-title center_color">
                                                <h3 class="title"> le vainqueur est <?php echo e($premier[0]->nom); ?> </h3>
                                            </div>
                                        <div class="apus-teacher-inner text-center style2">
                                            <div class="author-avatar">
                                                <div class="post-thumbnail">
                                                    <img src="images/we.jpg" class="attachment-full size-full wp-post-image" alt="" width="400" height="400">
                                                </div>
                                            </div>
                                            <div class="infor">
                                                <h3 class="name">
                                                    <a href="">
                                                        <?php echo e($premier[0]->nom); ?>

                                                    </a>
                                                </h3>
                                                <div class="socials">
                                                    <a href="#"><img src="images/reseauxprof.png" class="mn-icon-1405"></a>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="dl m-l-10" style="margin-top: -20px;">
                                            <h3 class="card-title">Meilleur </h3>
                                            <h6 class="card-subtitle"><?php echo e($premier[0]->voix); ?> Voix</h6>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($premier[0]->voix); ?>%; height:25px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>



                            </div>
                         <?php endif; ?>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/corpsVote.blade.php ENDPATH**/ ?>