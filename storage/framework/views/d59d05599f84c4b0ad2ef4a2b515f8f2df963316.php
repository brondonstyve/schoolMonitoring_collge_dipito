<!-- Debut page -->
<!-- Row-->
<div class="row">

        <!-- Column -->

        <?php if(sizeOf($evenement)==0): ?>

        <?php else: ?>
              <?php if(sizeOf($evenement)==1): ?>
              <?php for($i = 0; $i < 2; $i++): ?>
              <div class="col-md-4 col-sm-6  md-clearfix  sm-clearfix">
                    <div id="post-289" class="type-tribe_events post-289 tribe-clearfix tribe-events-category-distance-learning tribe-events-category-english-for-university tribe-events-venue-303 tribe-events-organizer-306 tribe-events-first">
                        <div class="tribe-events-list event-grid">

                            <div class="tribe-events-image">
                                <div class="tribe-events-event-image">
                                    <a href="#">
                                        <img src="images/we.jpg" class="attachment-full size-full wp-post-image">
                                    </a>
                                </div>
                                <div class="tribe-events-title-wrapper">
                                    <h2 class="tribe-events-list-event-title">
                                        <a class="tribe-event-url" href="" title="Remise des diplomes"><?php echo e($evenement[0]->titre); ?> </a>
                                    </h2>
                                </div>
                            </div>
                            <div class="tribe-events-inner">
                                <?php
                                    $date=new Date($evenement[0]->date);
                                ?>
                                <div class="entry-date-wrapper">
                                    <div class="entry-date">
                                        <span class="day"><?php echo e($date->format('d')); ?></span>
                                        <span class="month-year"><?php echo e($date->format('M Y')); ?></span>
                                    </div>
                                </div>
                                <div class="entry-meta-wrapper">

                                    <div class="tribe-event-cost">
                                        <span><i class="mn-icon-961"></i><?php echo e($date->format('d  M Y')); ?></span>
                                    </div>
                                    <div class="info-time">
                                        <i class="mn-icon-1111"></i><?php echo e($evenement[0]->debut); ?> <span class="space">A</span> <?php echo e($evenement[0]->fin); ?> </div>

                                    <div class="tribe-events-venue-details">
                                        <i class="mn-icon-1142"></i> <?php echo e($evenement[0]->description); ?> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <?php endfor; ?>
                <?php else: ?>
                <?php for($i = 0; $i < 2; $i++): ?>
                <div class="col-md-4 col-sm-6  md-clearfix  sm-clearfix">
                      <div id="post-289" class="type-tribe_events post-289 tribe-clearfix tribe-events-category-distance-learning tribe-events-category-english-for-university tribe-events-venue-303 tribe-events-organizer-306 tribe-events-first">
                          <div class="tribe-events-list event-grid">

                              <div class="tribe-events-image">
                                  <div class="tribe-events-event-image">
                                      <a href="#">
                                          <img src="images/we.jpg" class="attachment-full size-full wp-post-image">
                                      </a>
                                  </div>
                                  <div class="tribe-events-title-wrapper">
                                      <h2 class="tribe-events-list-event-title">
                                          <a class="tribe-event-url" href="" title="Remise des diplomes"><?php echo e($evenement[$i]->titre); ?> </a>
                                      </h2>
                                  </div>
                              </div>
                              <div class="tribe-events-inner">
                                  <?php
                                      $date=new Date($evenement[$i]->date);
                                  ?>
                                  <div class="entry-date-wrapper">
                                      <div class="entry-date">
                                          <span class="day"><?php echo e($date->format('d')); ?></span>
                                          <span class="month-year"><?php echo e($date->format('M Y')); ?></span>
                                      </div>
                                  </div>
                                  <div class="entry-meta-wrapper">

                                      <div class="tribe-event-cost">
                                          <span><i class="mn-icon-961"></i><?php echo e($date->format('d  M Y')); ?></span>
                                      </div>
                                      <div class="info-time">
                                          <i class="mn-icon-1111"></i><?php echo e($evenement[$i]->debut); ?> <span class="space">A</span> <?php echo e($evenement[$i]->fin); ?> </div>

                                      <div class="tribe-events-venue-details">
                                          <i class="mn-icon-1142"></i> <?php echo e($evenement[$i]->description); ?> </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php endfor; ?>
              <?php endif; ?>
        <?php endif; ?>



        <!-- Column -->
        <?php if($utilisateur->type==null): ?>
        <div class="col-lg-4 col-md-4">
            <div class="card card-size3">
                <img class="" src="images/weatherbg.jpg" alt="Card image cap">
                <div class="card-img-overlay" style="height:110px;">
                    <h3 class="card-title text-white m-b-0 dl">Absence globale </h3>
                    <p class="card-text text-white font-light">Discipline</p>
                </div>
                <div class="card-body weather-small ">
                    <div class="row ">
                        <div class="col-6 b-r align-self-center">
                            <div class="d-flex">
                                <div class="display-6 text-info"><i class="wi wi-day-rain-wind"></i></div>
                                <div class="m-l-20">
                                    <h1 class="font-light text-info m-b-0"><?php echo e(100-$presence); ?><sup>%</sup></h1>
                                    <small>presence aux cours</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <h1 class="font-light m-b-0"><?php echo e($presence); ?><sup>%</sup></h1>
                            <small>absence globale</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
          <?php if(sizeOf($evenement)==0): ?>
              <?php else: ?>
              <?php
                  $t=sizeOf($evenement)-1;
              ?>
              <div class="col-md-4 col-sm-6  md-clearfix  sm-clearfix">
                    <div id="post-289" class="type-tribe_events post-289 tribe-clearfix tribe-events-category-distance-learning tribe-events-category-english-for-university tribe-events-venue-303 tribe-events-organizer-306 tribe-events-first">
                        <div class="tribe-events-list event-grid">

                            <div class="tribe-events-image">
                                <div class="tribe-events-event-image">
                                    <a href="#">
                                        <img src="images/we.jpg" class="attachment-full size-full wp-post-image">
                                    </a>
                                </div>
                                <div class="tribe-events-title-wrapper">
                                    <h2 class="tribe-events-list-event-title">
                                        <a class="tribe-event-url" href="" title="Remise des diplomes"><?php echo e($evenement[$t]->titre); ?> </a>
                                    </h2>
                                </div>
                            </div>
                            <div class="tribe-events-inner">
                                <?php
                                    $date=new Date($evenement[$t]->date);
                                ?>
                                <div class="entry-date-wrapper">
                                    <div class="entry-date">
                                        <span class="day"><?php echo e($date->format('d')); ?></span>
                                        <span class="month-year"><?php echo e($date->format('M Y')); ?></span>
                                    </div>
                                </div>
                                <div class="entry-meta-wrapper">

                                    <div class="tribe-event-cost">
                                        <span><i class="mn-icon-961"></i><?php echo e($date->format('d  M Y')); ?></span>
                                    </div>
                                    <div class="info-time">
                                        <i class="mn-icon-1111"></i><?php echo e($evenement[$t]->debut); ?> <span class="space">A</span> <?php echo e($evenement[$t]->fin); ?> </div>

                                    <div class="tribe-events-venue-details">
                                        <i class="mn-icon-1142"></i> <?php echo e($evenement[$t]->description); ?> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          <?php endif; ?>
        <?php endif; ?>

        <!-- Column -->
    </div>
    <!-- Row -->



<div class="row">
    <!-- Column -->

    <div class="col-lg-8 col-md-7 ">

        <div class="card color-md card-size">
            <div class="card-body">

                <div class="row">
                    <div class="d-flex flex-wrap">


                        <div class="ml-auto">
                            <ul class="list-inline">
                                <li>
                                    <a href="" class="text-muted text-success">Annones</a>
                                </li>
                                <li>
                                    <a href="" class="text-muted  text-info">Communiqués</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php for($i = 0; $i < sizeOf($evenement); $i++): ?>
                <?php if(sizeOf($evenement)<10): ?>
                <div class="col-12" style="background-color: aliceblue">
                    -<?php echo e($evenement[$i]->titre); ?>

                    <?php
                          $date=new Date($evenement[$i]->date);
                    ?>
                    <span class="day"><?php echo e($date->format('d')); ?></span>
                    <span class="month-year"><?php echo e($date->format('M Y')); ?></span> de
                    <i class="mn-icon-1111"></i><?php echo e($evenement[$i]->debut); ?> <span class="space">A</span> <?php echo e($evenement[$i]->fin); ?>

              </div>
              <br>
                <?php endif; ?>

                <?php endfor; ?>

            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-6">
        <div class="card card-size color-md1">
            <div class="card-body">
                <h3 class="card-title">Résultat du dernier vote</h3>
                <h6 class="text-muted  text-info">Le Vainqueur</h6>
                <div id="visitor" style="height: 400px; width: 100%; max-height: 300px; position: relative;" class="c3">




                    <?php if(sizeOf($premier)==0): ?>
                    <h6 class="card-subtitle">pas de vote pour le moment</h6>

                    <?php else: ?>
                    <div class="dl m-l-10" style="margin-top: -20px;">
                        <h6 class="card-subtitle"><?php echo e($premier[0]->voix); ?> Voix</h6>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($premier[0]->voix); ?>%; height:25px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="apus-teacher-inner text-center style2">
                        <div class="author-avatar">
                            <div class="post-thumbnail">
                                <img src="images/we.jpg" class="attachment-full size-full wp-post-image" alt="" width="200" height="200">
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
                    <?php endif; ?>




                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card blog-widget card-size1 color-md1">
                <div class="card-body">
                        <div class="blog-image"><img src="images/img1.jpg" alt="img" class="img-responsive"></div>
            <?php if(sizeOf($blog)<1): ?>

            <h3>Aucun sujet de blog pour le moment</h3>
            <?php else: ?>

                    <h3><?php echo e($blog[0]->titre); ?></h3>
                    <label class="label label-rounded label-success"><?php echo e($blog[0]->titre); ?></label>
                    <p class="m-t-20 m-b-20">
                            <?php echo e($blog[0]->description); ?>

                    </p>
                    <div class="d-flex">
                        <div class="read"><a href="" class="link font-medium"><a href="<?php echo e(route('blog_detail_path')); ?>?di=<?php echo e($blog[0]->id); ?>">Lire plus</a> </a></div>

                    </div>

            <?php endif; ?>
        </div>


        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card card-size2 color-md3">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div>
                        <h3 class="card-title">Notre Newsletter</h3>
                        <h6 class="card-subtitle">Vue d'ensemble de la newsletter</h6>
                    </div>
                    <div class="ml-auto align-self-center">
                        <ul class="list-inline m-b-0">
                            <li>
                                <h6 class="text-muted text-info"><a href="">Vue Complète</a>
                                </h6>
                            </li>
                            <li>
                                <h6 class="text-muted text-info"><a href="">m'abonner</a>
                                </h6>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="campaign ct-charts">


                </div>
                <div class="row text-center">
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h1 class="text-muted text-success">50</h1><small>Total Recu</small>
                    </div>
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h1 class="text-muted text-success">7</h1><small>Mail lus</small>
                    </div>
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h1 class="text-muted text-success">3</h1><small>Mail aimés</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <!-- Column -->
        <div class="card">
            <img class="card-img-top" src="images/profile-bg.jpg" alt="Card image cap">
            <div class="card-body little-profile text-center">
                <div class="pro-img">
                    <nav class="">
                        <ul class="navbar-nav mr-auto mt-md-0 ">

                            <li class="nav-item dropdown mega-dropdown show">
                                <a href="" class="btn carousel-item active" data-toggle="modal"
                                    data-target="#add-contact">
                                    <img src=" <?php if($utilisateur->photo==null): ?> images/profilDef.jpg <?php else: ?>  /storage/avatars/<?php echo e($utilisateur->photo); ?>  <?php endif; ?>"
                                        alt="user">
                                </a>

                            </li>
                        </ul>

                    </nav>
                </div>

                <div class=" ">
                        <a href=""  class="btn btn-danger centre " data-toggle="modal"  data-target="#valid-supp">Supprimer mon avatar</a>

                    </div>

                <div class="row text-center m-t-5">
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h3 class="text-muted text-success">xx</h3><small>Articles</small>
                    </div>
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h3 class="text-muted text-success">23</h3><small>Followers</small>
                    </div>
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h3 class="text-muted text-success">xx</h3><small>Groupes</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="card">
            <div class="card-body bg-info">
                <h4 class="text-white card-title">Mes Contacts</h4>
                <h6 class="card-subtitle text-white m-b-0 op-5">Liste de mes contacts</h6>
            </div>
            <div class="card-body">
                <div class="message-box contact-box">
                    <h2 class="add-ct-btn"><button type="button"
                            class="btn btn-circle btn-lg btn-success waves-effect waves-dark">+</button>
                    </h2>
                    <div class="message-widget contact-widget">
                        <!-- Message -->
                        <a href="#">
                            <div class="user-img"> <img src="images/9.jpg" alt="user" class="img-circle">
                                <span class="profile-status online pull-right"></span>
                            </div>
                            <div class="mail-contnet">
                                <h5>Brondon</h5> <span class="mail-desc"><?php echo e($utilisateur->téléphone); ?></span>
                            </div>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Paramètres</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 b-r"> <strong>prenom</strong>
                                <p class="text-muted"><?php echo e($utilisateur->prenom); ?></p>
                            </div>
                            <div class="col-md-2 col-xs-6 b-r"> <strong>Numéro</strong>
                                <p class="text-muted"><?php echo e($utilisateur->téléphone); ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                <p class="text-muted"><?php echo e($utilisateur->email); ?></p>
                            </div>
                            <div class="col-md-2 col-xs-6"> <strong>Vile</strong>
                                <p class="text-muted"><?php echo e($utilisateur->ville); ?></p>
                            </div>
                        </div>
                        <hr>
                        <h4 class="font-medium m-t-30">Competences</h4>
                        <hr>
                        <h5 class="m-t-30">Bases de données <span class="pull-right">80%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                aria-valuemax="100" style="width:80%; height:6px;">
                            </div>
                        </div>
                        <h5 class="m-t-30">Oracle <span class="pull-right">90%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100" style="width:90%; height:6px;">
                            </div>
                        </div>
                        <h5 class="m-t-30">Java <span class="pull-right">50%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                aria-valuemax="100" style="width:50%; height:6px;">
                            </div>
                        </div>
                        <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                aria-valuemax="100" style="width:70%; height:6px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card-body">
                        <form action=" <?php echo e(route('compte_edit_path')); ?> " method="POST"
                            class="form-horizontal form-material">

                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="col-md-12">Nom</label>
                                <div class="col-md-12">
                                    <input type="text" name="nom" value="<?php echo e($utilisateur->nom); ?>" name="prenom"
                                        class="form-control form-control-line" disabled>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-12">prenom</label>
                                <div class="col-md-12">
                                    <input type="text" name="prenom" value="<?php echo e($utilisateur->prenom); ?>" name="prenom"
                                        class="form-control form-control-line" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" name="email" value="<?php echo e($utilisateur->email); ?>"
                                        class="form-control form-control-line" name="email" id="example-email">
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-12">No téléphone</label>
                                <div class="col-md-12">
                                    <input type="text" name="phone" value="<?php echo e($utilisateur->téléphone); ?>"
                                        class="form-control form-control-line" name="phone">
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Ville</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line" name="ville" disabled>
                                <option selected="selected"><?php echo e($utilisateur->ville); ?></option>

                            </select>
                        </div>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>


    <div class="table-responsive ">
            <div id="add-contact" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content col-xs-9">
                        <div class="modal-header ">
                        <h4 class="modal-title" id="myModalLabel">Modifier l'avatar du compte</h4>
                    </div>
                    <div class="modal-title">
                        <form action="/modification_avatar" method="POST" class="form-horizontal form-material " enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group" style="text-align: center;">
                                <div class="col-md-12 m-b-20 carousel-inner">
                                    <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" ><span >Importer l'image</span>
                                        <input type="file" class="upload" id="imgInp" accept="image/*" name="avatar">
                                    </div>
                                </div>
                            </div>

                            <div class=" slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="container"><img id="blah" width="460" height="360" src="<?php if($utilisateur->photo==null): ?> images/profilDef.jpg <?php else: ?>  /storage/avatars/<?php echo e($utilisateur->photo); ?>  <?php endif; ?>"
                                                alt="Choissez une image"></div>
                                    </div>
                                </div>
                            </div>



                            <div class="fileupload btn btn-rounded waves-effect waves-light carousel-inner">
                                <input type="submit" class="bouton btn-info" value="Modifier">
                            </div>


                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

    </div>

    <div class="table-responsive ">
            <div id="valid-supp" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content col-xs-12">
                        <div class="modal-header ">
                            <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer votre profil?</h4>
                        </div>
                        <div class="modal-body ">
                            <form action="<?php echo e(route('avatar_supp_path')); ?>" method="POST" class="form-horizontal form-material "
                                enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>




                                <div class="">
                                    <input type="submit" class="btn btn-danger " value="Supprimer">
                                </div>


                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

        </div>






</div>
</div>





</div>
</div>


<script type='text/javascript'>
    //<![CDATA[
$(window).load(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });
});//]]>

</script>






</body>

</html>
<?php /**PATH C:\laragon\www\StandPlace\resources\views/compte/corps_profile.blade.php ENDPATH**/ ?>