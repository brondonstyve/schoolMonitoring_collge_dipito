<!-- menu flottant    -->

<div class="table-responsive ">
    <div id="add-suite-paiement" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-9">
                <div class="modal-title">
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





                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

</div>


<div class="table-responsive ">
    <div id="add-paiement" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-9">
                <div class="modal-title">
                    <form action="<?php echo e(route('paiement_path')); ?>" method="POST" class="form-horizontal form-material "
                        enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>



                        <div class="panel panel-info">
                            <div class="panel-heading">Informations de l'etudiant</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-6 col-xs-12">
                                        <strong>Filière:</strong>
                                        <select name="filiere" id="" class="form-control">
                                            <option>gl</option>
                                            <option>sr</option>
                                            <option>se</option>
                                        </select>
                                    </div>
                                    <div class="span1"></div>
                                    <div class="col-md-6 col-xs-12">
                                        <strong>Niveau:</strong>
                                        <select name="niv" id="" class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option disabled>3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-xs-12">
                                        <strong>Nom:</strong>
                                        <input type="text" name="nom" class="form-control" required />
                                        <?php echo $errors->first('nom',' <p style="color: red;font-family: italic"> :message
                                        </p> '); ?>

                                    </div>
                                    <div class="span1"></div>
                                    <div class="col-md-6 col-xs-12">
                                        <strong>Prenom:</strong>
                                        <input type="text" name="prenom" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Sexe</strong></div>
                                    <div class="col-md-12">
                                        <select name="sexe" id="" class="form-control">
                                            <option>Masculin</option>
                                            <option>Féminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Pays</strong></div>
                                    <div class="col-md-12">
                                        <select name="pays" id="" class="form-control">
                                            <option>Afghanistan</option>
                                            <option>Îles Åland</option>
                                            <option>Albanie</option>
                                            <option>Algérie</option>
                                            <option>Samoa américaines</option>
                                            <option>Andorre</option>
                                            <option>Angola</option>
                                            <option>Anguilla</option>
                                            <option>Antarctique</option>
                                            <option>Antigua et Barbuda</option>
                                            <option>Argentine</option>
                                            <option>Arménie</option>
                                            <option>Aruba</option>
                                            <option>Australie</option>
                                            <option>Autriche</option>
                                            <option>Azerbaïdjan</option>
                                            <option>Bahamas</option>
                                            <option>Bahreïn</option>
                                            <option>Bangladesh</option>
                                            <option>Barbade</option>
                                            <option>Biélorussie</option>
                                            <option>Belgique</option>
                                            <option>Belize</option>
                                            <option>Bénin</option>
                                            <option>Bermudes</option>
                                            <option>Bhoutan</option>
                                            <option>Bolivie</option>
                                            <option>Bosnie-Herzégovine</option>
                                            <option>Botswana</option>
                                            <option>Île Bouvet</option>
                                            <option>Brésil</option>
                                            <option>Territoire britannique de l'Océan Indien</option>
                                            <option>Brunei Darussalam</option>
                                            <option>Bulgarie</option>
                                            <option>Burkina Faso</option>
                                            <option>Burundi</option>
                                            <option>Cambodge</option>
                                            <option selected="selected">Cameroun</option>
                                            <option>Canada</option>
                                            <option>Cap-Vert</option>
                                            <option>Îles Caïmans</option>
                                            <option>République Centrafricaine</option>
                                            <option>Tchad</option>
                                            <option>Chili</option>
                                            <option>Chine</option>
                                            <option>Île Christmas</option>
                                            <option>Îles Cocos (Keeling)</option>
                                            <option>Colombie</option>
                                            <option>Comores</option>
                                            <option>Congo (Brazzaville)</option>
                                            <option>Congo (Kinshasa)</option>
                                            <option>Îles Cook</option>
                                            <option>Costa Rica</option>
                                            <option>Côte d'Ivoire</option>
                                            <option>Croatie</option>
                                            <option>Cuba</option>
                                            <option>Chypre</option>
                                            <option>République tchèque</option>
                                            <option>Danemark</option>
                                            <option>Djibouti</option>
                                            <option>Dominique</option>
                                            <option>République dominicaine</option>
                                            <option>Équateur</option>
                                            <option>Égypte</option>
                                            <option>Salvador</option>
                                            <option>Guinée équatoriale</option>
                                            <option>Érythrée</option>
                                            <option>Estonie</option>
                                            <option>Éthiopie</option>
                                            <option>Îles Malouines</option>
                                            <option>Îles Féroé</option>
                                            <option>Fidji</option>
                                            <option>Finlande</option>
                                            <option>France</option>
                                            <option>Guyane française</option>
                                            <option>Polynésie française</option>
                                            <option>Terres australes françaises</option>
                                            <option>Gabon</option>
                                            <option>Gambie</option>
                                            <option>Géorgie</option>
                                            <option>Allemagne</option>
                                            <option>Ghana</option>
                                            <option>Gibraltar</option>
                                            <option>Grèce</option>
                                            <option>Groenland</option>
                                            <option>Grenade</option>
                                            <option>Guadeloupe</option>
                                            <option>Guam</option>
                                            <option>Guatemala</option>
                                            <option>Guernesey</option>
                                            <option>Guinée</option>
                                            <option>Guinée-Bissau</option>
                                            <option>Guyane française</option>
                                            <option>Haïti</option>
                                            <option>Îles Heard et McDonald</option>
                                            <option>Honduras</option>
                                            <option>Hong-Kong</option>
                                            <option>Hongrie</option>
                                            <option>Islande</option>
                                            <option>Inde</option>
                                            <option>Indonésie</option>
                                            <option>Iran</option>
                                            <option>Irak</option>
                                            <option>Irlande</option>
                                            <option>Île de Man</option>
                                            <option>Israël</option>
                                            <option>Italie</option>
                                            <option>Jamaïque</option>
                                            <option>Japon</option>
                                            <option>Jersey</option>
                                            <option>Jordanie</option>
                                            <option>Kazakhstan</option>
                                            <option>Kenya</option>
                                            <option>Kiribati</option>
                                            <option>Corée du Nord</option>
                                            <option>Corée du Sud</option>
                                            <option>Koweït</option>
                                            <option>Kirghizistan</option>
                                            <option>Laos</option>
                                            <option>Lettonie</option>
                                            <option>Liban</option>
                                            <option>Lesotho</option>
                                            <option>Liberia</option>
                                            <option>Libye</option>
                                            <option>Liechtenstein</option>
                                            <option>Lituanie</option>
                                            <option>Luxembourg</option>
                                            <option>Macao</option>
                                            <option>Macédoine</option>
                                            <option>Madagascar</option>
                                            <option>Malawi</option>
                                            <option>Malaisie</option>
                                            <option>Maldives</option>
                                            <option>Mali</option>
                                            <option>Malte</option>
                                            <option>Îles Marshall</option>
                                            <option>Martinique</option>
                                            <option>Mauritanie</option>
                                            <option>Île Maurice</option>
                                            <option>Mayotte</option>
                                            <option>Mexique</option>
                                            <option>Micronésie</option>
                                            <option>Moldavie</option>
                                            <option>Monaco</option>
                                            <option>Mongolie</option>
                                            <option>Monténégro</option>
                                            <option>Montserrat</option>
                                            <option>Maroc</option>
                                            <option>Mozambique</option>
                                            <option>Myanmar</option>
                                            <option>Namibie</option>
                                            <option>Nauru</option>
                                            <option>Népal</option>
                                            <option>Pays-Bas</option>
                                            <option>Antilles néerlandaises</option>
                                            <option>Nouvelle-Calédonie</option>
                                            <option>Nouvelle-Zélande</option>
                                            <option>Nicaragua</option>
                                            <option>Niger</option>
                                            <option>Nigeria</option>
                                            <option>Niue</option>
                                            <option>Île Norfolk</option>
                                            <option>Îles Mariannes du Nord</option>
                                            <option>Norvège</option>
                                            <option>Oman</option>
                                            <option>Pakistan</option>
                                            <option>Palau</option>
                                            <option>Palestine</option>
                                            <option>Panama</option>
                                            <option>Papouasie-Nouvelle-Guinée</option>
                                            <option>Paraguay</option>
                                            <option>Pérou</option>
                                            <option>Philippines</option>
                                            <option>Pitcairn</option>
                                            <option>Pologne</option>
                                            <option>Portugal</option>
                                            <option>Porto Rico</option>
                                            <option>Qatar</option>
                                            <option>Réunion</option>
                                            <option>Roumanie</option>
                                            <option>Fédération de Russie</option>
                                            <option>Rwanda</option>
                                            <option>Saint-Barthélemy</option>
                                            <option>Sainte-Hélène</option>
                                            <option>Saint-Christophe-et-Niévès</option>
                                            <option>Sainte-Lucie</option>
                                            <option>Saint Martin</option>
                                            <option>Saint-Pierre-et-Miquelon</option>
                                            <option>Saint-Vincent-et-les Grenadines</option>
                                            <option>Samoa</option>
                                            <option>Saint-Marin</option>
                                            <option>Sao Tomé et Principe</option>
                                            <option>Arabie Saoudite</option>
                                            <option>Sénégal</option>
                                            <option>Serbie</option>
                                            <option>Seychelles</option>
                                            <option>Sierra Leone</option>
                                            <option>Singapour</option>
                                            <option>Slovaquie</option>
                                            <option>Slovénie</option>
                                            <option>Îles Salomon</option>
                                            <option>Somalie</option>
                                            <option>Afrique du Sud</option>
                                            <option>Géorgie du Sud et Îles Sandwich du Sud</option>
                                            <option>Espagne</option>
                                            <option>Sri Lanka</option>
                                            <option>Soudan</option>
                                            <option>Surinam</option>
                                            <option>Îles Svalbard et Jan Mayen</option>
                                            <option>Swaziland</option>
                                            <option>Suède</option>
                                            <option>Suisse</option>
                                            <option>Syrie</option>
                                            <option>Taïwan</option>
                                            <option>Tadjikistan</option>
                                            <option>Tanzanie</option>
                                            <option>Thaïlande</option>
                                            <option>Timor oriental</option>
                                            <option>Togo</option>
                                            <option>Tokelau</option>
                                            <option>Tonga</option>
                                            <option>Trinidad et Tobago</option>
                                            <option>Tunisie</option>
                                            <option>Turquie</option>
                                            <option>Turkménistan</option>
                                            <option>Îles Turks-et-Caïques</option>
                                            <option>Tuvalu</option>
                                            <option>Ouganda</option>
                                            <option>Ukraine</option>
                                            <option>Émirats arabes unis</option>
                                            <option>Royaume-Uni</option>
                                            <option>Îles mineures éloignées des États-Unis</option>
                                            <option>États-Unis d'Amérique</option>
                                            <option>Uruguay</option>
                                            <option>Ouzbékistan</option>
                                            <option>Vanuatu</option>
                                            <option>Cité du Vatican</option>
                                            <option>Venezuela</option>
                                            <option>Vietnam</option>
                                            <option>Îles Vierges britanniques</option>
                                            <option>Îles Vierges américaines</option>
                                            <option>Wallis et Futuna</option>
                                            <option>Sahara occidental</option>
                                            <option>Yémen</option>
                                            <option>Zambie</option>
                                            <option>Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12"><strong>Adresse:</strong></div>
                                    <div class="col-md-12">
                                        <input type="text" name="adresse" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Ville:</strong></div>
                                    <div class="col-md-12">
                                        <input type="text" name="ville" class="form-control" required />
                                        <?php echo $errors->first('ville',' <p style="color: red;font-family: italic"> :message
                                        </p> '); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Numéro de téléphone:</strong></div>
                                    <div class="col-md-12">
                                        <input type="number" name="number" class="form-control" required />
                                        <?php echo $errors->first('number',' <p style="color: red;font-family: italic">
                                            :message</p> '); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Email:</strong></div>
                                    <div class="col-md-12"><input type="email" name="email" class="form-control"
                                            required /></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="submit" class="bouton btn-success">Envoyer</button>
                                    </div>
                                </div>
                            </div>
                        </div>





                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

</div>


<div class="table-responsive">
    <div id="add-matricule" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-xs-6">
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
                            <input type="submit" class="btn btn-info">
                        </div>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<!--add con -->
<div class="table-responsive" >
    <div id="add-con" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="display: none;" aria-hidden="true" >
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
                            <div class="col-xs-12 " >
                                <input class="form-control" type="email" name='email' placeholder="Email" required>
                                <?php echo e($errors->first('email',':message')); ?>

                            </div>
                        </div>


                        <div class="form-group btn-sm">
                            <div class="col-xs-12 ">
                                <input class="form-control" type="password" name='mdp' required=""
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
                            <input type="submit" class="btn btn-info"></div>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<div id="fond-2" class="header-mobile hidden-lg hidden-md clearfix">



    <div class="active-mobile pull-right">

        <div class="pull-right accept-account ">
            <div class="login-topbar">
                <a class="login btn btn-sm btn-reverse couleur" href="" data-toggle="modal" data-target="#add-matricule"
                    title="Login"><img src="/images/comte.png" class="mn-icon-47"> Créer Compte</a>
                <a class="register btn btn-sm btn-reverse couleur" href="" data-toggle="modal" data-target="#add-con"
                    title="Sign Up"><img src="/images/connexion.png" class="mn-icon-47"> connexion</a>
                <a data-toggle="offcanvas" class="fa fa-bars" title="Sign Up"><button type="button"><img
                            src="/images/menu.PNG"></button></a>
            </div>


        </div>

    </div>





    <div class="left-topbar clearfix pull-left">
        <aside id="apus_socials_widget-2" class="widget widget_apus_socials_widget">
            <ul class="social list-unstyled list-inline bo-sicolor">
                <li>
                    <a href="#">
                        <img src="/images/fb.png" class="couleur">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/images/in.png" class="couleur">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/images/goo.png" class="couleur">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/images/tw.png" class="couleur">
                    </a>
                </li>
                <li class="couleur">
                    contact@iaicameroun.com
                </li>

                <li class="couleur">
                    Tél. (237) 242 72 99 58
                </li>


            </ul>
        </aside>
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
            <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                <div>
                    <ul id="main-mobile-menu" class="nav navbar-nav">

                        <ul class="sub-menu">

                            <li id="menu-item-318" class="menu-item-318"><a href="index.blade.php"
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
                                        <a href="coursfc.blade.php"  style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">
                                            Cours de la FC</a>
                                    </li>
                                    <hr>
                                    <li class="menu-item-390 aligned-">
                                        <a href="coursfi.blade.php"  style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">
                                        Cours de la FI</a>
                                    </li>
                                    <hr>
                                    <li class="menu-item-351 aligned-">
                                        <a href="coursligne.blade.php"  style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">
                                            Cours en ligne</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <hr>
                        <ul class="sub-menu">
                            <li id="menu-item-318" class="menu-item-318"><a href="evenement.blade.php"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">évènement
                                    <hr></a></li>
                            <li id="menu-item-205" class="menu-item-205"><a href="#"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Forum
                                    <hr></a></li>
                            <li id="menu-item-234" class="menu-item-234"><a href="marche.blade.php"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Gallery
                                    <hr></a></li>
                            <li id="menu-item-125" class="menu-item-125"><a href="Apropos.blade.php"
                                    style="font-weight: bold; color:black; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:17px;">Apropos
                                    <hr></a></li>
                            <li id="menu-item-134" class="menu-item-134"><a href="contact.blade.php"
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
<div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix">
    <div class="container" style="float: left;">
        <div class="row">
            <div class="col-xs-5">
                <div class="logo logo-theme">
                    <a href="index.blade.php">
                        <img src="/images/logo.png" alt="IAI">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="collapse navbar-collapse centre" >
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
                                <a href="#">
                                    <img src="/images/fb.png" class="couleur">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/images/in.png" class="couleur">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/images/goo.png" class="couleur">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/images/tw.png" class="couleur">
                                </a>
                            </li>
                        </ul>
                    </aside>
                    <!--                  Contact                -->
                    <aside id="text-2" class="widget widget_text">
                        <div class="textwidget">
                            <div class="contact-topbar btn-sm">
                                <span>contact@iaicameroun.com</span>
                                <span>Tél. (237) 242 72 99 58</span>
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
                            <div class="col-md-2">
                                <div class="logo-in-theme text-center">
                                    <div class="logo logo-theme">
                                        <a href="index.blade.php">
                                            <img src="/images/logo.png" alt="IAIStandPace">
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
                                            <li class="dropdown menu-item-64 aligned-"><a href="index.blade.php"
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
                                                            href="coursfc.blade.php">Cours de la FC</a></li>
                                                    <li class="menu-item-390 aligned-"><a href="coursfi.blade.php">Cours
                                                            de la FI</a></li>
                                                    <li class="menu-item-351 aligned-"><a
                                                            href="coursligne.blade.php">Cours en ligne</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-318 aligned-left"><a
                                                    href="evenement.blade.php">évènements</a></li>
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


                                            <li class="menu-item-125 aligned-left"><a href="Apropos.blade.php">A
                                                    propos</a></li>
                                            <li class="menu-item-134 aligned-left"><a
                                                    href="contact.blade.php">Contact</a></li>
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
