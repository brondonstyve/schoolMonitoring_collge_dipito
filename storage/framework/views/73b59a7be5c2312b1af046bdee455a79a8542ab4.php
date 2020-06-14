<section id="main-container" class="main-content  container inner">
        <div class="row">
            <div id="main-content" class="col-sm-12 col-md-12 col-sm-12 col-xs-12">
                <main id="main" class="site-main layout-course" role="main">

                    <h3>Nos Formations</h3>
                    <div class="course-style-grid">

                        <?php if(sizeOf($reponse)<1): ?>
                        <h2 class="edr-course__title"><a href="">Aucune formation enregistré pour le moment</a></h2>

                        <?php else: ?>
                        <div class="row">

                                <?php for($i = 0; $i < sizeOf($reponse); $i++): ?>
                                <div class="col-md-4 col-sm-6  sm-clearfix">
                                        <article id="course-330" class="edr-course">
                                            <div class="edr-thumbnail-wrapper">
                                                <div class="edr-course__image">
                                                    <a href=""><img src="/images/images.jpeg-1.jpg" class="attachment-medium size-medium wp-post-image" alt="" width="370" height="250"></a>
                                                </div>
                                                <div class="duration"><img src="images/horloge.png" class="mn-icon-1104"> <?php if($reponse[$i]->niveau==0): ?> <?php echo e(1); ?> An <?php else: ?> <?php echo e($reponse[$i]->niveau); ?> Ans <?php endif; ?> </div>
                                            </div>
                                            <div class="meta-data clearfix">
                                                <div class="edr-teacher">
                                                    <div class="avatar-img ">
                                                        <img src="/images/IMG-20191109-WA0000.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" width="150" height="150"> </div>

                                                    <div class="description">
                                                        <h4 class="author-title">
                                                            <a href=""> School Monitoring </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="edr-course__price ">
                                                </div>
                                            </div>
                                            <header class="edr-course__header">
                                                <div class="header-meta clearfix">
                                                    <div class="category pull-left">
                                                        <a href=""><?php echo e($reponse[$i]->nom); ?></a> </div>
                                                    <div class="course-review pull-right">
                                                        <div class="review-stars-rated list-rating">
                                                            <div class="rating-print-wrapper">
                                                                <img src="/images/etoiles.png" class="mn-icon-1104"></img>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h2 class="edr-course__title"><a href="">Conseils pour réussir sa formation</a></h2>
                                            </header>
                                        </article>
                                    </div>
                                <?php endfor; ?>








                </div>
                        <?php endif; ?>

        </main>

        </div>
        <nav class="navigation paging-navigation" role="navigation">
                <div class="apus-pagination">
                    <span class="page-numbers"><?php echo e($reponse->links()); ?></span>
                </div>
            </nav>
    </section>
</div>
<?php /**PATH C:\laragon\www\StandPlace\resources\views/layout/formations.blade.php ENDPATH**/ ?>