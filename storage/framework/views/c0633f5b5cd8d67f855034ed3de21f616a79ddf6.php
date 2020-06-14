<div id="apus-main-content">
    <section id="main-container" class="main-content  container inner">
        <div class="row">
            <div id="main-content" class="col-sm-12 col-md-12 col-sm-12 col-xs-12">
                <main id="main" class="site-main layout-blog" role="main">
                    <div id="tribe-events" class="" data-live_ajax="1" data-datepicker_format="0" data-category=""
                        data-featured="">
                        <div class="tribe-events-before-html">
                        </div>
                        <h3>Evènements</h3>
                        <div id="tribe-events-content-wrapper" class="tribe-clearfix">
                            <input type="hidden" id="tribe-events-list-hash" value="">
                            <div id="tribe-events-content" class="tribe-events-list">


                                <div class="tribe-events-loop clearfix">



                                    <?php if(sizeOf($evenement)==0): ?>
                                    <h3>aucun événement pour le moment</h3>
                                    <?php else: ?>
                                    <?php for($t = 0; $t < sizeOf($evenement); $t++): ?> <div class="col-md-4 col-sm-6   ">

                                        <div>
                                            <div class="tribe-events-list event-grid">

                                                <div class="tribe-events-image">
                                                    <div class="tribe-events-event-image">
                                                        <a href="" title="<?php echo e($evenement[$t]->description); ?>">
                                                            <img src="images/we.jpg"
                                                                class="attachment-full size-full wp-post-image">
                                                        </a>
                                                    </div>
                                                    <div class="tribe-events-title-wrapper">
                                                        <h2 class="tribe-events-list-event-title">
                                                            <a class="tribe-event-url" href=""
                                                                title="<?php echo e($evenement[$t]->description); ?>"><?php echo e($evenement[$t]->titre); ?> </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                                <?php
                                                $date=new Date($evenement[$t]->date);
                                                ?>
                                                <div class="tribe-events-inner">
                                                    <div class="entry-date-wrapper">
                                                        <div class="entry-date">
                                                            <span class="day"><?php echo e($date->format('d')); ?></span>
                                                            <span class="month-year"><?php echo e($date->format('M Y')); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="entry-meta-wrapper">

                                                        <div class="tribe-event-cost">
                                                            <span><i
                                                                    class="mn-icon-961"></i><?php echo e($date->format('d  M Y')); ?></span>
                                                        </div>
                                                        <div class="info-time">
                                                            <i class="mn-icon-1111"></i><?php echo e($evenement[$t]->debut); ?>

                                                            <span class="space">A</span> <?php echo e($evenement[$t]->fin); ?>

                                                        </div>


                                                        <div class="tribe-events-venue-details">
                                                            <i class="mn-icon-1142"><?php echo e($evenement[$t]->lieu); ?></i>
                                                             </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <?php endfor; ?>
                                <?php endif; ?>





                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <?php echo e($evenement->links()); ?>

</div>
</div>
</div>
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/layout/evenement.blade.php ENDPATH**/ ?>