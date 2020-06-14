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
                    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('compte_store_path') }}">
                        <h3 class="box-title m-b-20">Créer votre Compte</h3>
                        {{ csrf_field() }}
                        <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control"  type="text"  disabled  value="{{ $matricules }}" style="text-align: left;">
                                    <input type="hidden" name="matricule" value="{{ $matricules }}">
                                    {{ $errors->first('matricule',':message') }}
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control"  type="text"  disabled  value="{{ $nom }}" style="text-align: left;">
                                        <input type="hidden" name='nom' value="{{ $nom }}">
                                        {{ $errors->first('nom',':message') }}
                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control"  type="text"  disabled value="{{ $prenom }}" style="text-align: left;">
                                            <input type="hidden" name='prenom' value="{{ $prenom }}">
                                            {{ $errors->first('prenom',':message') }}
                                        </div>
                                    </div>
                                <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control"  type="text"  disabled value="@if($type==null) {{ $classe }} @else XX @endif" style="text-align: left;">
                                                <input type="hidden" name='classe' value="@if($type==null) {{ $classe }} @else XX @endif">
                                                <input type="hidden" name='type' value="{{ $type }}">
                                                <input type="hidden" name='ville' value="{{ $ville }}">
                                                <input type="hidden" name='num' value="{{ $num }}">

                                                {{ $errors->first('classe',':message') }}
                                            </div>
                                        </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" name='email' placeholder="Email" required>
                                    {{ $errors->first('email',':message') }}
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name='mdp' required="" placeholder="Mot de passe">
                                    {{ $errors->first('mdp',':message') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name='mdpconf' required="" placeholder="Confirmer le mot de passe">
                                    {{ $errors->first('mdpconf',':message') }}
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
    @include('flashy::message')


</body>

</html>
