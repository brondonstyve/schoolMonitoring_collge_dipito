<!DOCTYPE html>
<html lang="fr-fr">

<head>
        <title> {{ $etat }}</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="css/bootstrap1.css" rel="stylesheet">

    <link href="css/style1.css" rel="stylesheet">
    <link rel="stylesheet" href="css/newsletter.css" type="text/css" media="all">

    <link rel="stylesheet" id="bootstrap-css" href="css/bootstrap.css" type="text/css" media="all">
    <link rel="stylesheet" id="campress-template-css" href="css/template.css" type="text/css" media="all">
    <link rel="stylesheet" id="campress-style-css" href="css/style.css" type="text/css" media="all">

    <script src="js/jquery.js"></script>
    <script src="//code.jquery.com/jquery.min.js"></script>

</head>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">

<header class="topbar ne_pas_imprimer" >
            <nav class="navbar top-navbar navbar-expand-md navbar-light" >
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('profil_path') }}">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->

                            <ul class="navbar-nav my-lg-0">
                            <li class="nav-item dropdown">
                                    <img src="images/logo.png" width="150px" class="flag-icon flag-icon-us dark-logo" style="margin-top: -9%">
                                </li>
                            </ul>

                            <img src="" alt="homepage" class="hide">
                            <!-- Light Logo icon -->
                            <img src="" alt="homepage" class="hide">
                        </b>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"></a> </li>


                    </ul>
                    @php
                       $compteur=0;
                    @endphp
                    @for ($i = 0; $i < sizeOf($notificate); $i++)
                    @if ($notificate[$i]->matricule=='public' || $notificate[$i]->matricule==$utilisateur->matricule ||
                         $notificate[$i]->classe==$utilisateur->classe || $notificate[$i]->compte==$utilisateur->id )
                         @php
                             $compteur=$compteur+1;
                         @endphp
                    @endif
                    @endfor
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown  show" >
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" > <img width="25px" src="images/notif2.png" class="mdi mdi-email">
                                    <!-- si nouveau message -->
                                    @if ($compteur!=0)
                                   <div class="notify"> <span class="heartbit"></span> <span class="point">{{ $compteur }}</span></div>

                                    @endif
                                </a>
                                <div class="dropdown-menu mailbox dropdown-menu-right scale-up btn-sm" aria-labelledby="2" >
                                    <ul>
                                        <li>
                                            <div class="drop-title btn-info">heyy {{ $utilisateur->prenom }} vous avez {{ $compteur }} notification(s) non lues</div>
                                        </li>
                                        <li style="overflow: visible;">
                                            <div class="slimScrollDiv" >
                                                <div class="message-center" style="overflow: hidden; width: auto; height: 250px;">
                                                    <!-- Message -->

                                                    @if ($compteur==0)
                                                    <div class="mail-contnet">
                                                            <h5 class="text-center">Aucune notifications non lue!</h5> <span class="mail-desc"></span>
                                                    </div>
                                                    @else
                                                    @for ($i = 0; $i < sizeOf($notificate); $i++)
                                                    @if ($notificate[$i]->matricule=='public' || $notificate[$i]->matricule==$utilisateur->matricule ||
                                                         $notificate[$i]->classe==$utilisateur->classe || $notificate[$i]->compte==$utilisateur->id )

<a href="{{ route('voir_notifications_path') }}?id={{ $notificate[$i]->id }}">
     <div class="user-img"> <img src="images/notif2.png" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span>
     </div>
     <div class="mail-contnet">
         <h5>{{ $notificate[$i]->type }}</h5> <span class="mail-desc">{{ $notificate[$i]->message }}!</span>
         <span class="time">
             @php
                 $date1=new Date($notificate[$i]->created_at);
                 $date2=new Date();
                 $date=number_format((strtotime($date2)-strtotime($date1))/60);
                 $date_h=number_format((strtotime($date2)-strtotime($date1))/3600);
                 $date_j=number_format((strtotime($date2)-strtotime($date1))/86400);

             @endphp
             @if ($date_j>0)
                il y'a {{ $date_j }}  @if ($date_j<=1) Jour @else Jours @endif

               @else
               @if ($date<=60)
                  il y'a {{ $date }}  @if ($date<=1) minute @else minutes @endif
              @else
               @if ($date_h<=24)
                  il y'a {{ $date_h }}  @if ($date_h<=1) heure @else heures @endif
               @endif
              @endif
             @endif

         </span>
     </div>
 </a>
                                                    @endif

                                                 @endfor</div>
                                                 <div class="slimScrollBar" style="background: rgb(220, 220, 220) none repeat scroll 0% 0%; width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 183.824px;"></div>
                                                 <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
                                             </div>
                                         </li>



                                                    @endif

                                                    <li>
                                                                <a class="nav-link text-center btn-info" href="{{ route('notifications_path') }}" style="color: white">
                                                                  Voir tout
                                                                </a>

                                                        </li>

                                                </ul>
                                </div>
                            </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->


                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/lang.png" width="25px" class="flag-icon flag-icon-us"></a>
                                <div class="dropdown-menu dropdown-menu-right btn-sm">
                                    <a class="dropdown-item" href="#"><img src="images/anglais.png" width="30px" class="flag-icon flag-icon-in"></i> Anglais</a>
                                    <a class="dropdown-item" href="#"><img src="images/france.png" width="30px" class="flag-icon flag-icon-fr"></i> Francais</a>
                                </div>
                            </li>
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                     <div style="margin-top: 8%">
                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark " href="" data-toggle="dropdown">
                                        <img src=" @if ($utilisateur->photo==null) images/profilDef.jpg @else  /storage/avatars/{{ $utilisateur->photo }}  @endif" alt="user" class="profile-pic">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right scale-up" >
                                        <ul class="dropdown-user btn-sm " >
                                            <li style="width: 120%">
                                                <div class="dw-user-box">
                                                    <div class="u-img"><img src=" @if ($utilisateur->photo==null) images/profilDef.jpg @else  /storage/avatars/{{ $utilisateur->photo }}  @endif" alt="user"></div>
                                                    <div class="u-text">
                                                        <h4>{{ $utilisateur->prenom }}</h4>
                                                        <p class="">{{ $utilisateur->email }}</p>
                                                    </div>
                                                </div>
                                            </li>

                                            @if ($utilisateur->type =='enseignant')


                                            <li><a href="{{ route('profil_path') }}"><img src="images/icones/compt.PNG" width="10%" > Mon profil</a></li>
                                            <li><a href="{{ route('note_path') }}"><img src="images/icones/stat.png" width="10%"/>Remplir notes</a></li>

                                            @if ($titulaire)
                                            <li><a href="{{ route('bulletin_titulaire_path') }}" data-toggle="modal" data-target="#myModal" id="id_sek"><img src="images/note.png" width="10%"/>bulletin</a></li>
                                            @endif
                                            <li><a href=" {{ route('coursProf_path') }} "><img src="images/bloc.png" width="10%"> Cours </a></li>
                                            <li><a href="{{ route('appel_ct_path') }}"><img src="images/icones/appel.png" width="10%"/>Appel/cahier de texte</a></li>
                                            <li><a href="{{ route('vote_path') }}"><img src="images/icones/vote.png" width="10%"/> Vote</a></li>
                                            <li><a href="{{ route('blog_etu_path') }}"><img src="images/icones/blog.png" width="10%"/>blog</a></li>
                                            <li><a href="{{ route('generer_edt_path') }}"><img src="images/icones/edt.png" width="10%"/> Emploi de temps</a></li>
                                            <li><a href="{{ route('evaluation_path') }}"><img src="images/icones/evaluation.png" width="10%"/> Evaluation</a></li>
                                            <li><a href="{{ route('notifications_path') }}" ><img src="images/notif2.png" width="10%"/> Notifications <code style="background-color: skyblue">{{ $compteur }}</code></a> </li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><img src="images/setting.png" width="10%"/> Paramètre</a></li>
                                            <li><a href="deconnexion.blade.php"><img src="images/power.png" width="10%"/>Déconnexion</a></li>

                                            @else
                                                   @if ($utilisateur->type==null)
                                                   <li><a href="{{ route('profil_path') }}"><img src="images/icones/compt.PNG" width="10%" > Mon profil</a></li>
                                                   <li><a href="{{ route('evaluation_path') }}"><img src="images/icones/evaluation.png" width="10%"/> Evaluation</a></li>
                                                   <li><a href="{{ route('note_path') }}"><img src="images/icones/stat.png" width="10%"/> Notes</a></li>
                                                   <li><a href=" {{ route('coursEtu_path') }} "><img src="images/bloc.png" width="10%"> Cours </a></li>
                                                   <li><a href="{{ route('blog_etu_path') }}"><img src="images/icones/blog.png" width="10%"/>Blog</a></li>
                                                   <li><a href="{{ route('solvabilitee_path') }}"><img src="images/messagerie.png" width="10%" /> Solvabilité</a></li>
                                                   <li><a href="{{ route('vote_path') }}"><img src="images/icones/vote.png" width="10%"/> Vote</a></li>
                                                   <li><a href="{{ route('generer_edt_path') }}"><img src="images/icones/edt.png" width="10%"/> Emploi de temps</a></li>
                                                   <li><a href="{{ route('discipline_path') }}"><img src="images/discipline.png" width="10%"/> Discipline</a></li>
                                                   <li><a href="{{ route('notifications_path') }}" ><img src="images/notif2.png" width="10%"/> Notifications <code style="background-color: skyblue">{{ $compteur }}</code></a> </li>
                                                   <li role="separator" class="divider"></li>
                                                   <li><a href="#"><img src="images/setting.png" width="10%"/> Paramètre</a></li>
                                                   <li><a href="deconnexion.blade.php"><img src="images/power.png" width="10%"/>Déconnexion</a></li>
                                                    @else
                                                    @if ($utilisateur->type=='superadmin')
                                                            <li><a href="{{ route('profil_path') }}"><img src="images/icones/compt.PNG" width="10%" > Mon profil</a></li>
                                                            <li><a href="{{ route('accueil_index_path') }}" class="btn-sm btn-success" style="color: black;">Passer en mode Administrateur</a></li>
                                                            <li><a href="{{ route('blog_etu_path') }}"><img src="images/icones/blog.png" width="10%"/>Blog</a></li>
                                                            <li><a href="{{ route('vote_path') }}"><img src="images/icones/vote.png" width="10%"/> Vote</a></li>
                                                            <li><a href="{{ route('notifications_path') }}" ><img src="images/notif2.png" width="10%"/> Notifications <code style="background-color: skyblue">{{ $compteur }}</code></a> </li>
                                                            <li role="separator" class="divider"></li>
                                                            <li><a href="#"><img src="images/setting.png" width="10%"/> Paramètre</a></li>
                                                            <li><a href="deconnexion.blade.php"><img src="images/power.png" width="10%"/>Déconnexion</a></li>

                                                    @endif
                                                   @endif
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            </div>
                            </ul>
                        </div>
            </nav>
 </header>







        <aside class="left-sidebar ne_pas_imprimer">
            <!-- bare de menu-->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="scroll-sidebar" style="overflow: hidden; width: auto; height: 100%;">
                    <!-- fond de profil -->
                    <div class="user-profile" style="background: url( @if ($utilisateur->photo==null) images/profilDef.jpg @else  /storage/avatars/{{ $utilisateur->photo }}  @endif) no-repeat;">
                        <!--image profile  -->

                        <div class="profile-img"> <img src=" @if ($utilisateur->photo==null) images/profilDef.jpg @else  /storage/avatars/{{ $utilisateur->photo }}  @endif" alt="user"> </div>
                        <!-- profil-->
                        <div class="profile-text">
                            <a href="#" class=" u-dropdown" data-toggle="dropdown" >{{ $utilisateur->prenom }}</a>
                         </div>
                    </div>



                    <nav class="sidebar-nav">
                        <ul id="sidebarnav" class="in">
                            <ul aria-expanded="true" class="collapse in">
                                @if ($utilisateur->type=="enseignant")
                                    <li><a href="{{ route('profil_path') }}"><img src="images/icones/compt.png" width="10%"/> Mon profil</a></li>
                                    <li><a href="{{ route('note_path') }}"><img src="images/icones/stat.png" width="10%"/>Remplir notes</a></li>
                                    @if ($titulaire)
                                            <li><a href="{{ route('bulletin_titulaire_path') }}" data-toggle="modal" data-target="#myModal" id="id_sek"><img src="images/note.png" width="10%"/>bulletin</a></li>
                                    @endif
                                    <li><a href=" {{ route('coursProf_path') }} "><img src="images/bloc.png" width="10%"> Cours </a></li>
                                    <li><a href="{{ route('appel_ct_path') }}"><img src="images/icones/blog.png" width="10%"/>Appel/CT</a></li>
                                    <li><a href="{{ route('generer_edt_path') }}"><img src="images/icones/edt.png" width="10%"/> Emploi de temps</a></li>
                                    <li><a href="{{ route('evaluation_path') }}"><img src="images/icones/evaluation.png" width="10%"/> Evaluation</a></li>
                                    <li><a href="{{ route('blog_etu_path') }}"><img src="images/icones/blog.png" width="10%"/>Blog</a></li>
                                    <li><a href="{{ route('vote_path') }}"><img src="images/icones/vote.png" width="10%"/> Vote</a></li>
                                    <li><a href="{{ route('notifications_path') }}" ><img src="images/notif2.png" width="10%"/> Notifications <code style="background-color: skyblue">{{ $compteur }}</code></a> </li>

                                    @else
                                         @if ($utilisateur->type==null)
                                         <li><a href="{{ route('profil_path') }}"><img src="images/icones/compt.png" width="10%"/> Mon profil</a></li>
                                         <li><a href="{{ route('evaluation_path') }}"><img src="images/icones/evaluation.png" width="10%" > Evaluation</a></li>
                                         <li><a href="{{ route('note_path') }}"><img src="images/icones/stat.png" width="10%"/> Notes</a></li>
                                         <li><a href=" {{ route('coursEtu_path') }} "><img src="images/bloc.png" width="10%"> Cours </a></li>
                                         <li><a href="{{ route('generer_edt_path') }}"><img src="images/icones/edt.png" width="10%"/> Emploi de temps</a></li>
                                         <li><a href="{{ route('discipline_path') }}"><img src="images/icones/discipline.png" width="10%"/> Discipline</a></li>
                                         <li><a href="{{ route('solvabilitee_path') }}"><img src="images/sms1.png" width="10%"/> Solvabilité</a></li>
                                         <li><a href="{{ route('blog_etu_path') }}"><img src="images/icones/blog.png" width="10%"/> Blog</a></li>
                                         <li><a href="{{ route('vote_path') }}"><img src="images/icones/vote.png" width="10%"/> Vote</a></li>
                                         <li><a href="{{ route('notifications_path') }}" ><img src="images/notif2.png" width="10%"/> Notifications <code style="background-color: skyblue">{{ $compteur }}</code></a> </li>

                                         @else
                                         @if ($utilisateur->type=='superadmin')<li role="separator" class="divider"></li>
                                         <li><a href="{{ route('profil_path') }}"><img src="images/icones/compt.PNG" width="10%" > Mon profil</a></li>
                                         <li><a href="{{ route('blog_etu_path') }}"><img src="images/icones/blog.png" width="10%"/>Blog</a></li>
                                         <li><a href="{{ route('vote_path') }}"><img src="images/icones/vote.png" width="10%"/> Vote</a></li>
                                         <li><a href="{{ route('notifications_path') }}" ><img src="images/notif2.png" width="10%"/> Notifications <code style="background-color: skyblue">{{ $compteur }}</code></a> </li>
                                         <li role="separator" class="divider"></li>
                                         <li><a href="#"><img src="images/setting.png" width="10%"/> Paramètre</a></li>
                                         <li><a href="deconnexion.blade.php"><img src="images/power.png" width="10%"/>Déconnexion</a></li>
                                         @endif
                                         @endif
                                    @endif

                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
                <div class="slimScrollBar" style="background: rgb(220, 220, 220) none repeat scroll 0% 0%; width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; left: 1px; height: 284.688px;"></div>
                <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; left: 1px;"></div>
            </div>

            <div class="sidebar-footer">
               <a href="#" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><img src="images/setting.png" class="ti-settings" width="50%"/></a>
               <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Email"><img src="images/gmail.png" class="mdi mdi-gmail" width="50%"/></a>
               <a href="deconnexion.blade.php" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><img src="images/power.png" class="mdi mdi-power" width="50%"/></a> </div>

        </aside>

<br><br><br>
        <div class="page-wrapper" style="min-height: 583px;">


            <div class="container-fluid">


                <div class="row page-titles ne_pas_imprimer" style=" min-width: 100%;">

                    <div class="col-md-5  align-self-center">
                        <h3 class="text-themecolor">Tableau de bord </h3>
                        <ol class="breadcrumb btn-sm">
                            <li class="breadcrumb-item"><a href="#"> Compte  </a> </li>
                            <li class="">{{ $etat }}</li>
                        </ol>
                    </div>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">

                                @if ($utilisateur->type=="enseignant")



                                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                                @if ($utilisateur->droit=='admin')
                                                <li><a href="{{ route('accueil_index_path') }}" class="badge badge-success"> Administrer</a></li>
                                                @endif
                                    </div>
                                @else
                                     @if ($utilisateur->type==null)
                                     <div class="d-flex m-r-20 m-l-10 hidden-md-down">

                                            <div class="chart-text m-r-10">
                                                    <h4 class="m-b-0"><small>CLASSE</small></h4>
                                                    <h6 class="m-t-0 text-info btn-sm" style="text-transform: uppercase; font-size: 15px;">{{ $utilisateur->classe }}</h6>
                                                </div>

                                                <div class="spark-chart">
                                                        <div id="monthchart"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"
                                                                width="60" height="35"></canvas></div>
                                                    </div>

                                        @if ($etat=="Discipline")
                                        <div class="chart-text m-r-10">
                                            <h4 class="m-b-0"><small>HEURES D'ABSENCES</small></h4>
                                            <h6 class="m-t-0 text-info btn-sm">{{ $remplisseur }} @if($remplisseur==0) heure @else heures @endif </h6>
                                        </div>
                                        <div class="spark-chart">
                                            <div id="monthchart"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"
                                                    width="60" height="35"></canvas></div>
                                        </div>

                                    <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                            <div class="chart-text m-r-10">
                                                <h4 class="m-b-0 "><small>DISCIPLINE</small></h4>
                                                <h6 class="m-t-0 text-primary btn-sm"> @if($remplisseur<=10) bonne @else @if($remplisseur<=30) Attention @else Mauvaise @endif @endif</h6>
                                            </div>
                                        </div>
                                      @endif
                                    </div>
                                     @else
                                     @if ($utilisateur->type=='superadmin')
                                     <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                            <div class="chart-text m-r-10">
                                                    <h4 class="btn-sm btn-success" style="font-size: 20px;text-transform: uppercase">
                                                        <small>
                                                           <a href="{{ route('accueil_index_path') }}" >Passer en mode Administrateur</a>
                                                        </small>
                                                </h4>
                                            </div>
                                        </div>
                                     @endif
                                     @endif
                                @endif



                        </div>
                    </div>
                </div>

                  <!-- The Modal -->
                  <div class="modal" id="myModal">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Choisir une séquences</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{ route('bulletin_titulaire_path') }}" method="post" id="form_bul">
                        @csrf
                            <div class="modal-body" id="selecteur">
                            <span>liste des séquences</span>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" >envoyer</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                      </div>
                    </div>
                  </div>
