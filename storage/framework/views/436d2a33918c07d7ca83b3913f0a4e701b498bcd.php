<section id="main-container" class="main-content container inner">
    <div class="row">
        <div id="main-content" class="col-xs-12 col-md-9 col-sm-12 col-xs-12">
            <div id="primary" class="content-area">
                <div id="content" class="site-content detail-post" role="main">


                    <div id="comments" class="comments-area" style="margin-top: -60px">
                        <span>libellé: <?php echo e($course[0]->libelle); ?></span>
                        <span style="float: right">Matière: <?php echo e($course[0]->nom); ?></span>

                            <iframe src="storage/cours/<?php echo e($course[0]->fichier); ?>" frameborder="0" width="100%" height="400px">
                                alt: <a href="storage/cours/<?php echo e($course[0]->fichier); ?>">Cliquer ici pour voir l'épreuve</a>
                            </iframe>
                            <a href="<?php echo e(route('telechargement_path',$course[0]->id_cours)); ?>">
                                <h3 class="widget-title uppercase btn btn-success"><span>telecharger</span></h3>
                            </a>




                        <h3 class=" dropdown-user btn-sm"><input type="button" id="text" value="<?php echo e(sizeOf($reponse)); ?>"> question(s)</h3>

                         <?php for($i = 0; $i < sizeOf($reponse); $i++): ?>
                                <div id="<?php echo e($i); ?>">
                                    <div id="rep<?php echo e($i); ?>">
                                        <div class="d-flex flex-row comment-row p-3" >
                                            <div class="p-2"><span class="round text-white d-inline-block text-center rounded-circle bg-info">
                                                <img src="storage/avatar/<?php echo e($utilisateur->photo); ?>" alt="user" width="50"></span></div>
                                            <div class="comment-text w-100 p-3">
                                                <h5><?php echo e($reponse[$i]->nom.' '.$reponse[$i]->prenom); ?></h5>
                                                <p class="mb-1 overflow-hidden">
                                                    <?php echo e($reponse[$i]->message); ?>

                                                </p>
                                                <div class="comment-footer">
                                                    <?php
                                                        $date=new Date($reponse[$i]->created_at);
                                                    ?>
                                                    <span class="text-muted pull-right"><?php echo e($date->format('d M Y')); ?></span>
                                                    <a href="#" class="badge badge-info" data-toggle="modal" id="reponse" data-id="<?php echo e($i); ?>" data-kuestion="<?php echo e($reponse[$i]->id); ?>">Répondre</a>
                                                    <a href="#" class="badge badge-primary" data-toggle="modal" id="repon" data-id="rep<?php echo e($i); ?>" data-id_fermer="<?php echo e($i); ?>" data-repo="<?php echo e($i); ?>" data-kuestion="<?php echo e($reponse[$i]->id); ?>">Réponses</a>
                                                    <?php if($utilisateur->type=='enseignant'): ?>
                                                    <a href="#" data-toggle="modal">
                                                        <img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-id="<?php echo e($reponse[$i]->id); ?>" data-supp="rep<?php echo e($i); ?>" width="20px" id="kuestion_supp">
                                                    </a>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                 </div>
                        <?php endfor; ?>

                        <br>
                        <div class="commentform row reset-button-default">
                            <div class="col-sm-12">
                                <div id="respond" class="comment-respond">
                                    <form action="<?php echo e(route('kuestion_path')); ?>" method="post" id="kuestion_form" class="comment-form">
                                        <br>
                                        <div class="form-group h-info"><code>Ajouter une question</code></div>
                                        <div class="form-group">
                                            <textarea rows="8" placeholder="ma question" id="comment"
                                                class="form-control" name="comment" aria-required="true" required></textarea>
                                        </div>

                                        <p class="form-submit">
                                            <input type="hidden" name="cour" value="<?php echo e($course[0]->id_cours); ?>">
                                            <input name="submit" type="submit" id="submit" class="btn btn-dark btn-sm " value="Envoyer">
                                        </p>
                                    </form>
                                </div><!-- #respond -->
                            </div>
                        </div>
                    </div><!-- .comments-area -->
                </div><!-- #content -->
            </div><!-- #primary -->
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
            <aside class="sidebar sidebar-right" itemscope="itemscope" >

                <aside id="apus_recent_post-2" class="widget widget_apus_recent_post">
                    <h2 class="widget-title"><span>Les cours de <?php echo e($cours[0]->classe); ?></span></h2>
                    <div class="post-widget media-post-layout widget-content">
                        <ul class="posts-list">
                            <?php for($i = 0; $i < sizeOf($cours); $i++): ?>
                            <li>
                                    <article class="post post-list">
                                        <div class="entry-content media">

                                            <h6><?php echo e($i+1); ?></h6>
                                            <div class="media-left">
                                                <figure class="entry-thumb effect-v6">
                                                    <a href="<?php echo e(route('coursDetail_path')); ?>?cour=<?php echo e(encrypt($cours[$i]->id_cours)); ?>&&mat=<?php echo e(encrypt($cours[$i]->matiere)); ?>" title="" class="entry-image">
                                                        <img src="images/courrs.png"
                                                            class="attachment-widget size-widget wp-post-image" alt=""
                                                            width="700" height="579"> </a>
                                                </figure>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="entry-title">
                                                    <a
                                                        href="<?php echo e(route('coursDetail_path')); ?>?cour=<?php echo e(encrypt($cours[$i]->id_cours)); ?>&&mat=<?php echo e(encrypt($cours[$i]->matiere)); ?>"><?php echo e($cours[$i]->libelle); ?></a>
                                                </h4>
                                                <div class="entry-content-inner clearfix">
                            <a href="<?php echo e(route('coursDetail_path')); ?>?cour=<?php echo e(encrypt($cours[$i]->id_cours)); ?>&&mat=<?php echo e(encrypt($cours[$i]->matiere)); ?>" title="" class="entry-image">

                                                    <div class="entry-meta">
                                                        <div class="entry-create">
                                                            <span class="entry-date"><?php echo e($cours[$i]->created_at); ?></span>
                                                        </div>
                                                    </div>
                                </a>

                                                </div>
                                            </div>
                                        </div>
                                    </article>
                             </li>

                            <?php endfor; ?>


                        </ul>
                    </div>
                </aside>
            </aside>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/corpscoursDetails.blade.php ENDPATH**/ ?>