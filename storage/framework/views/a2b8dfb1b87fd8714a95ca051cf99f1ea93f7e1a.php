<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IAI</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bt.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/st.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colorr.css" id="theme" rel="stylesheet">


</head>

<body>
    <section id="wrapper">
        <div class="login-register" style="background-image:url(images/profilDef.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="index.html">
                        <h3 class="box-title m-b-20">Créer votre Compte</h3>
                        <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" data-toggle="modal" type="button" name='matricule' required="" value="matricule" style="text-align: left;">
                                    <?php echo e($errors->first('matricule',':message')); ?>

                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" data-toggle="modal" type="button" name='nom' required="" value="Nom" style="text-align: left;">
                                        <?php echo e($errors->first('nom',':message')); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" data-toggle="modal" type="button" name='prenom' required="" value="prenom" style="text-align: left;">
                                            <?php echo e($errors->first('prenom',':message')); ?>

                                        </div>
                                    </div>
                                <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" data-toggle="modal" type="button" name='classe' required="" value="classe" style="text-align: left;">
                                                <?php echo e($errors->first('classe',':message')); ?>

                                            </div>
                                        </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name='email' required="" placeholder="Email">
                                    <?php echo e($errors->first('email',':message')); ?>

                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name='mdp' required="" placeholder="Mot de passe">
                                    <?php echo e($errors->first('mdp',':message')); ?>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name='mdpconf' required="" placeholder="Confirmer le mot de passe">
                                    <?php echo e($errors->first('mdpconf',':message')); ?>

                                </div>
                            </div>
                        <div class="form-group">
                            <div class="">
                                <div class="checkbox checkbox-success p-t-0">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup"> Accepter nos <a href="#">termes</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info " type="submit">Enregistrer</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Avez-vous un compte? <a href="" class="text-info m-l-5"><b>Connexion</b></a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/popper.js"></script>
    <script src="js/bt.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery_003.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/sticky-kit.js"></script>
    <script src="js/jquery_002.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="js/jQuery.js"></script>


</body>

</html>
