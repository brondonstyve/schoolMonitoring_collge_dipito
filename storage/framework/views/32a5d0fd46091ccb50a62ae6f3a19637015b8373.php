<?php echo $__env->make('compte/entete_menu_bar', ['etat'=>'Blog'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <section id="main-container" class="main-content container inner">
        <div class="row">
            <div id="main-content" class="col-xs-12 col-md-9 col-sm-12 col-xs-12">
                <div id="primary" class="content-area">
                    <div id="content" class="site-content detail-post" role="main">


                        <article id="post-201"
                            class="post-201 post type-post status-publish format-standard has-post-thumbnail hentry category-advices tag-apus tag-travel tag-wordpress">
                            <div class="info">
                                <h2 class="dropdown-user btn-sm">
                                    <a href="#"><code>publication</code></a>
                                </h2>
                                <div class="entry-meta">
                                    <a href="#"><i class="mn-icon-1102"></i> <?php echo e($rep[0]->created_at); ?> </a>

                                    <h2 class="post-author"> <?php echo e($rep[0]->titre); ?></h2>
                                </div>
                            </div>

                            <div class="entry-thumb centre" style="background-color: white">
                                <div class="post-thumbnail">
                                    <img src="images/blog.PNG" class="attachment-full size-full wp-post-image" width=300px></div>
                            </div>
                            <div class="detail-content">

                                <div class="single-info info-bottom">
                                    <div class="entry-description">
                                        <h5  >Description</h5>
                                        <p> <?php echo e($rep[0]->description); ?></p>
                                    </div><!-- /entry-content -->
                                </div>
                            </div>
                        </article>


                        <div id="comments" class="comments-area">
                            <h2><code> commentaire</code></h2>
                            <h3 class=" dropdown-user btn-sm"> <?php if(sizeOf($reponse)>1): ?> <?php echo e(sizeOf($reponse)); ?> commentaires <?php else: ?> <?php echo e(sizeOf($reponse)); ?> commentaire <?php endif; ?></h3>
                            <ol class="comment-list">

                                <?php for($i = 0; $i < sizeOf($reponse); $i++): ?>
                                <li class="comment even thread-even depth-1" id="comment-2">

                                        <div class="the-comment media">
                                            <div class="avatar media-left">
                                                <img src="images/blog.PNG"
                                                    alt=""
                                                    class="avatar avatar-70wp-user-avatar wp-user-avatar-70 alignnone photo avatar-default"
                                                    width="70" height="70"> </div>

                                            <div class="comment-box media-body">
                                                <div class="comment-author clearfix">
                                                        <?php if($utilisateur->type=='superadmin'): ?>
                                                        <strong><?php echo e($reponse[$i]->nom.' de la '.$reponse[$i]->classe); ?></strong>
                                                         <?php else: ?>
                                                         <strong>Utilisateur</strong>
                                                     <?php endif; ?>
                                                    <span class="date-comment"> -- <?php echo e($reponse[$i]->created_at); ?></span>

                                                </div>
                                                <div class="comment-text">
                                                    <p><?php echo e($reponse[$i]->message); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endfor; ?>

                            </ol><!-- .comment-list -->


                            <br>
                            <div class="commentform row reset-button-default">
                                <div class="col-sm-12">
                                    <div id="respond" class="comment-respond">
                                        <form action="<?php echo e(route('reponse_Blog_path')); ?>" method="post" id="commentform" class="comment-form">
                                            <?php echo e(csrf_field()); ?>

                                            <br>
                                            <div class="form-group h-info"><code>Ajouter un reponse</code></div>
                                            <div class="form-group">
                                                <textarea rows="8" placeholder="mon reponse" id="comment"
                                                    class="form-control" name="comment" aria-required="true" required></textarea>
                                            </div>

                                            <p class="form-submit">
                                                <input type="hidden" name="blog" value="<?php echo e($rep[0]->id); ?>">
                                                <input type="hidden" name="type" value="detail">
                                                <input name="submit" type="submit" id="submit" class="btn btn-dark btn-sm " value="Ajouter un reponse">
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
                        <h2 class="widget-title"><span>Derniers Post</span></h2>
                        <div class="post-widget media-post-layout widget-content">
                            <ul class="posts-list">
                                <?php for($i = 0; $i < sizeOf($sujet); $i++): ?>
                                <li>
                                        <article class="post post-list">

                                            <div class="entry-content media">

                                                <h6>sujet <?php echo e($i+1); ?></h6>
                                                <div class="media-left">
                                                    <figure class="entry-thumb effect-v6">
                                                        <a href="<?php echo e(route('blog_detail_path')); ?>?di=<?php echo e($sujet[$i]->id); ?>" title="" class="entry-image">
                                                            <img src="images/blog.PNG"
                                                                class="attachment-widget size-widget wp-post-image" alt=""
                                                                width="870" height="579"> </a>
                                                    </figure>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="entry-title">
                                                        <a
                                                            href="<?php echo e(route('blog_detail_path')); ?>?di=<?php echo e($sujet[$i]->id); ?>"><?php echo e($sujet[$i]->titre); ?></a>
                                                    </h4>
                                                    <div class="entry-content-inner clearfix">
                                                        <div class="entry-meta">
                                                            <div class="entry-create">
                                                                <span class="entry-date"><?php echo e($sujet[$i]->created_at); ?></span>
                                                            </div>
                                                        </div>
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






<?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('compte/script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
