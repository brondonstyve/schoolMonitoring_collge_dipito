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
</head>

<body>
    <section id="wrapper">
        <div class="login-register" style="background-image:url(images/profilDef.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="POST" action="<?php echo e(route('compte_store_path')); ?>">
                        <h3 class="box-title m-b-20">Créer votre Compte</h3>
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control"  type="text"  disabled  value="<?php echo e($matricules); ?>" style="text-align: left;">
                                    <input type="hidden" name="matricule" value="<?php echo e($matricules); ?>">
                                    <?php echo e($errors->first('matricule',':message')); ?>

                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control"  type="text"  disabled  value="<?php echo e($nom); ?>" style="text-align: left;">
                                        <input type="hidden" name='nom' value="<?php echo e($nom); ?>">
                                        <?php echo e($errors->first('nom',':message')); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control"  type="text"  disabled value="<?php echo e($prenom); ?>" style="text-align: left;">
                                            <input type="hidden" name='prenom' value="<?php echo e($prenom); ?>">
                                            <?php echo e($errors->first('prenom',':message')); ?>

                                        </div>
                                    </div>
                                <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control"  type="text"  disabled value="<?php if($type==null): ?> <?php echo e($classe); ?> <?php else: ?> XX <?php endif; ?>" style="text-align: left;">
                                                <input type="hidden" name='classe' value="<?php if($type==null): ?> <?php echo e($classe); ?> <?php else: ?> XX <?php endif; ?>">
                                                <input type="hidden" name='type' value="<?php echo e($type); ?>">
                                                <input type="hidden" name='ville' value="<?php echo e($ville); ?>">
                                                <input type="hidden" name='num' value="<?php echo e($num); ?>">

                                                <?php echo e($errors->first('classe',':message')); ?>

                                            </div>
                                        </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" name='email' placeholder="Email" required>
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
                                <input class="btn btn-info " type="submit" value="Enregistrer"/>
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

    <script src="//code.jquery.com/jquery.min.js"></script>
    <?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
