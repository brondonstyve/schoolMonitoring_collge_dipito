<!-- menu flottant    -->
    <div id="add-suite-paiement" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-9">
                    <form action="<?php echo e(route('suite_paiement_path')); ?>" method="POST" class="form-horizontal form-material " enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>



                        <div class="panel panel-info">
                            <div class="panel-heading centre">Entrer le matrucule de l'étudiant</div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Matricule:</strong></div>
                                    <div class="col-md-12">
                                        <input type="text" name="matricule" class="form-control" />
                                        <?php echo $errors->first('matricule',' <p style="color: red;font-family: italic"> :message
                                        </p> '); ?>

                                    </div>
                                </div>

                                <div class="centre">
                                    <input type="submit" class="btn btn-info">
                                </div>

                            </div>
                        </div>
                </form>
            <!-- /.modal-content -->
        </div>
    </div>
    </div>



    <div id="add-paiement" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">

                    <!-- contenu-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouveau Paiement</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('paiement_path')); ?>" method="post" class="form-horizontal form-material "
                                id="formulaire">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group ">
                                    <div class="">
                                        <strong>Filière:</strong>
                                        <select name="filiere" class="form-control" id="liste-filier">
                                        </select>
                                    </div>

                                    <div class="">
                                        <strong>Niveau:</strong>
                                        <select name="niv" id="liste-niveau" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="">
                                        <strong>classe:</strong>
                                        <select name="classe" class="form-control" id="liste-classe">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="">
                                        <strong>Nom:</strong>
                                        <input type="text" name="nom" class="form-control" required />
                                        <?php echo $errors->first('nom',' <p style="color: red;font-family: italic"> :message
                                        </p> '); ?>

                                    </div>

                                    <div class="">
                                        <strong>Prenom:</strong>
                                        <input type="text" name="prenom" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=""><strong>Sexe</strong></div>
                                    <select name="sexe" id="" class="form-control">
                                        <option>Masculin</option>
                                        <option>Féminin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Pays</strong></div>
                                    <select name="pays" id="" class="form-control">
                                        <option >Cameroun</option>
                                                            <option >Gabon</option>
                                                            <option >Tchad</option>
                                                            <option >Algérie</option>
                                                            <option >France</option>
                                                            <option >Guinée</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Adresse:</strong></div>
                                    <input type="text" name="adresse" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Ville:</strong></div>
                                    <input type="text" name="ville" class="form-control" required />
                                    <?php echo $errors->first('ville',' <p style="color: red;font-family: italic"> :message
                                    </p> '); ?>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Numéro de téléphone:</strong></div>
                                    <input type="number" name="number" class="form-control" required />
                                    <?php echo $errors->first('number',' <p style="color: red;font-family: italic">
                                        :message</p> '); ?>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Email:</strong></div>
                                    <input type="email" name="email" class="form-control" required />
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Envoyer" class="left btn btn-success">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                        </form>
                    </div>

                </div>
    </div>



    <div id="add-matricule" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-6" style="width: 60%">
                <div class="modal-header">
                    <h4 class="modal-title centre" id="myModalLabel">Votre Matricule</h4>
                </div>
                <div class="modal-body ">
                    <form action="<?php echo e(route('find_matricule_path')); ?>" method="POST"
                        class="form-horizontal form-material " enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name='matricule' required=""
                                    placeholder="Matricule">
                                <?php echo e($errors->first('Matricule',':message')); ?>

                            </div>
                        </div>
                        <div class="centre">
                            <input type="submit" class="btn btn-info btn-sm" value="envoyer">
                        </div>

                </div>
            </div>
            </form>
        </div>
    </div>


<!--add con -->
    <div id="add-con" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true" style="width: 40%">
        <div class="modal-dialog" >
            <div class="modal-content col-xs-6" >
                <div class="modal-header">
                    <h4 class="modal-title centre" id="myModalLabel" style="color: #002b46">Connexion</h4>
                </div>
                <div class="modal-body ">
                    <form action="<?php echo e(route('connex_show')); ?>" method="POST" class="form-horizontal form-material "
                        enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <br>

                        <div class="form-group btn-sm" >
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name='email' placeholder="Email" required>
                                <?php echo e($errors->first('email',':message')); ?>

                            </div>
                        </div>


                        <div class="form-group btn-sm">
                            <div class="col-xs-12 ">
                                <input class="form-control btn-sm" type="password" name='mdp' required=""
                                    placeholder="Mot de passe">
                                <?php echo e($errors->first('mdp',':message')); ?>

                            </div>
                        </div>
                        <br>
                        <div class="contact-topbar btn-sm" style="text-align: right">
                                <span >Créer un
                                    <a href="#" style="color: #002b46" data-toggle="modal" data-target="#add-matricule" title="Login">
                                        compte
                                    </a>
                                </span>
                        </div>

                        <div class="centre">
                            <input type="submit" class="btn btn-sm btn-success" value="envoyer"></div>

                </div>
            </div>
            </form>
        </div>
    </div>


<div id="fond-2" class="header-mobile hidden-lg hidden-md clearfix">

        <div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-3" style="max-width: 100%;top: 15px">
                            <div class="logo logo-theme">
                                <a href="">
                                    <img src="images/logo-icon.png" alt="standplace" >
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="action-right clearfix">
                                <div class="active-mobile pull-right">
                                    <button class="btn btn-sm btn-danger btn-offcanvas btn-toggle-canvas offcanvas" data-toggle="offcanvas"  title="Sign Up" style="max-width: 40px;">
                                    MENU <img src="images/menu-noir.png" class="fa fa-bars">
                                   </button>
                                </div>
                                <div class="active-mobile top-cart pull-right">
                                    <div class="dropdown">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <div class="active-mobile pull-right" style="margin-right: 20px">

        <div class="pull-right accept-account " style="display: inline-block;color: white">
            <div class="login-topbar" >

                <a class="login  btn-sm" href="" data-toggle="modal" data-target="#add-matricule"
                    title="Login" style="color: white">
                    <img src="/images/comte.PNG" class="mn-icon-47">
                    Créer compte
                </a>
                <a class="register  btn-sm" href="" data-toggle="modal" data-target="#add-con" title="Sign Up" style="color: white">
                    <img src="/images/connexion.PNG" class="mn-icon-47">
                    Connexion
                </a>
            </div>


        </div>

    </div>
</div>



<div id="wrapper-container" class="wrapper-container">
    <div id="apus-mobile-menu" class="apus-offcanvas hidden-lg hidden-md">
        <div class="apus-offcanvas-body">
            <div class="apus-search-form">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" placeholder="Search" name="s" class="apus-search form-control">
                        <span class="input-group-btn">
                            <div class="heading-right pull-right hidden-sm hidden-xs">
                                <div class="pull-right header-setting">
                                    <div class="apus-search pull-right">
                                        <button type="button" class="button-show-search button-setting"><img
                                                src="images/recherche.PNG" class="couleur"></button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <input type="hidden" name="post_type" value="edr_course" class="post_type">
                </form>
            </div>

            <h3 class="input" style="color:green"><i class="fa fa-cog" aria-hidden="true"></i> Menu</h3>
            <hr>
            <nav class="navbar navbar-offcanvas navbar-static " role="navigation">
                <div>
                    <ul id="main-mobile-menu" class="nav navbar-nav btn-sm">

                        <ul class="sub-menu">

                            <li id="menu-item-318" class="menu-item-318"><a href="<?php echo e(route('home')); ?>"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Accueil
                                    <hr></a></li>

                            <li id="menu-item-318" class="menu-item-318"><a href="#"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Parents
                                    <hr></a></li>


                            <li class="dropdown active menu-item-69 aligned- menu-item-318">
                                <a data-hover="dropdown" data-toggle="dropdown"  style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">
                                Cours<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="menu-item-69 aligned-">
                                        <a href="<?php echo e(route('cour_for_cont_path')); ?>"  style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">
                                            Cours de la FC</a>
                                    </li>
                                    <hr>
                                    <li class="menu-item-390 aligned-">
                                        <a href="<?php echo e(route('cour_for_INI_path')); ?>"  style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">
                                        Cours de la FI</a>
                                    </li>
                                    <hr>
                                    <li class="menu-item-351 aligned-">
                                        <a href="<?php echo e(route('cour_ligne_path')); ?>"  style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">
                                            Cours en ligne</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <hr>
                        <ul class="sub-menu">
                            <li id="menu-item-318" class="menu-item-318"><a href="<?php echo e(route('evenment_path')); ?>"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">évènement
                                    <hr></a></li>
                            <li id="menu-item-205" class="menu-item-205"><a href="#"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Forum
                                    <hr></a></li>
                            <li id="menu-item-234" class="menu-item-234"><a href="marche.blade.php"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Gallery
                                    <hr></a></li>
                            <li id="menu-item-125" class="menu-item-125"><a href="<?php echo e(route('apropos_path')); ?>"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Apropos
                                    <hr></a></li>
                            <li id="menu-item-134" class="menu-item-134"><a href="<?php echo e(route('contact_path')); ?>"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Contact
                                    <hr></a></li>


                        </ul>
                </div>
            </nav>
        </div>
    </div>
    <div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix">
        <div class="container">
            <div class="row">


            </div>
        </div>
    </div>
</div>


<!-- logo et menu flottant   -->
<div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix" style="text-align: center">
    <div class="container" style="">
            <ul id="primary-menu" class="nav navbar-nav megamenu">


                    <li class="dropdown active menu-item-69 aligned-">
                            <a data-hover="dropdown" data-toggle="dropdown" style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Paiements <b class="caret"></b></a>
                               <ul class="dropdown-menu">
                                   <li class=" menu-item-389 aligned-">
                                       <a  data-toggle="modal" data-target="#add-paiement" style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Nouvel étudiant</a></li>
                                   <li class=" menu-item-389 aligned-">
                                       <a  data-toggle="modal" data-target="#add-suite-paiement" style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Ancien étudiant</a></li>
                               </ul>
                           </li>
    </ul>
    </div>

</div>





<!--                  Reseaux sociaux               -->
<div id="wrapper-container" class="wrapper-container">

    <div id="searchverlay"></div>
    <header id="apus-header" class="site-header apus-header header-v1 hidden-sm hidden-xs" role="banner">
        <div id="apus-topbar" class="apus-topbar">
            <div class="container">
                <div class="left-topbar clearfix pull-left">
                    <aside id="apus_socials_widget-2" class="widget widget_apus_socials_widget">
                        <ul class="social list-unstyled list-inline bo-sicolor">
                            <li>
                                <a href="
                                <?php echo e($r=(sizeOf($adresse)>0)? 'http://'.$adresse[0]->facebook :'http://facebook.com'); ?>

                                ">
                                    <img src="/images/fb.png" class="couleur">
                                </a>
                            </li>
                            <li>
                                <a href="
                                <?php echo e($r=(sizeOf($adresse)>0)? 'http://'.$adresse[0]->instagram :'http://instagram.com'); ?>

                                ">
                                    <img src="/images/in.png" class="couleur">
                                </a>
                            </li>
                            <li>
                                <a href="
                                <?php echo e($r=(sizeOf($adresse)>0)? 'http://'.$adresse[0]->google :'http://google+.com'); ?>

                                ">
                                    <img src="/images/goo.png" class="couleur">
                                </a>
                            </li>
                            <li>
                                <a href="
                                <?php echo e($r=(sizeOf($adresse)>0)? 'http://'.$adresse[0]->twiter :'http://twitter.com'); ?>

                                ">
                                    <img src="/images/tw.png" class="couleur">
                                </a>
                            </li>
                        </ul>
                    </aside>
                    <!--                  Contact                -->
                    <aside id="text-2" class="widget widget_text">
                        <div class="textwidget">
                            <div class="contact-topbar btn-sm">
                                <span><?php echo e($r=(sizeOf($adresse)>0)? $adresse[0]->email :'contact@schoolmonitoring.com'); ?></span>
                                <span>Tél. <?php echo e($r=(sizeOf($adresse)>0)? $adresse[0]->numero :'(237) 6 97 32 09 74'); ?></span>
                            </div>
                        </div>
                    </aside>
                </div>
                <!--                 connexion et compte                -->
                <div class="pull-right accept-account">
                    <div class="login-topbar">
                        <a class="login btn btn-sm btn-reverse" href="" data-toggle="modal" data-target="#add-matricule"
                            title="Login"><img src="/images/comte.png" class="mn-icon-47">Créer Compte</a>
                        <a class="register btn btn-sm btn-reverse" href="" data-toggle="modal" data-target="#add-con"
                            title="Sign Up"><img src="/images/connexion.png" class="mn-icon-47"> connexion</a>
                    </div>
                </div>

            </div>


        </div>
        <!--                  logo               -->

        <div class="headertop main-sticky-header-wrapper" style="height: 120px;">
            <div class="header-main clearfix main-sticky-header">
                <div class="container">
                    <div class="header-inner">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="logo-in-theme text-center">
                                    <div class="logo logo-theme">
                                        <a href="<?php echo e(route('home')); ?>">
                                            <img src="/images/IMG-20191109-WA0000.jpg" alt="IAIStandPace">
                                        </a>
                                    </div>
                                </div>
                            </div>



                            <!--                  recherche               -->

                            <!--                 menu              -->
                            <div class="main-menu  pull-right ">


                                <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar"
                                    role="navigation">
                                    <div class="collapse navbar-collapse">
                                        <ul id="primary-menu" class="nav navbar-nav megamenu">
                                            <li class="dropdown menu-item-64 aligned-"><a href="<?php echo e(route('home')); ?>"
                                                    class="dropdown-toggle" data-hover="dropdown"
                                                    data-toggle="dropdown">Accueil </a></li>

                                                    <li class="dropdown menu-item-64 aligned-"><a href="#"
                                                    class="dropdown-toggle" data-hover="dropdown"
                                                    data-toggle="dropdown">Parents </a></li>

                                            <li class="dropdown  menu-item-69 aligned-"><a class="dropdown-toggle"
                                                    data-hover="dropdown" data-toggle="dropdown">Cours <b
                                                        class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li class=" menu-item-389 aligned-"><a
                                                            href="<?php echo e(route('cour_for_cont_path')); ?>">Cours de la FC</a></li>
                                                    <li class="menu-item-390 aligned-"><a href="<?php echo e(route('cour_for_INI_path')); ?>">Cours
                                                            de la FI</a></li>
                                                    <li class="menu-item-351 aligned-"><a
                                                            href="<?php echo e(route('cour_ligne_path')); ?>">Cours en ligne</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-318 aligned-left"><a
                                                    href="<?php echo e(route('evenment_path')); ?>">évènements</a></li>
                                            <li class="menu-item-205 aligned-left"><a href="blog.blade.php">Forum</a>
                                            </li>
                                            <li class="dropdown  menu-item-69 aligned-"><a class="dropdown-toggle"
                                                    data-hover="dropdown" data-toggle="dropdown">Paiements <b
                                                        class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li class=" menu-item-389 aligned-"><a href="" data-toggle="modal"
                                                            data-target="#add-paiement">Nouvel étudiant</a></li>
                                                    <li class=" menu-item-389 aligned-"><a href="" data-toggle="modal"
                                                            data-target="#add-suite-paiement">Ancien étudiant</a></li>
                                                </ul>
                                            </li>


                                            <li class="menu-item-125 aligned-left"><a href="<?php echo e(route('apropos_path')); ?>">A
                                                    propos</a></li>
                                            <li class="menu-item-134 aligned-left"><a
                                                    href="<?php echo e(route('contact_path')); ?>">Contact</a></li>
                                            </li>
                                        </ul>
                                    </div>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--                 formulaire de recherche-->
</div>
<?php /**PATH C:\laragon\www\StandPlace primaire\resources\views/layout/header.blade.php ENDPATH**/ ?>