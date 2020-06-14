<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/paiement/ccs1.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="js/jQuery.js"></script>
    <title>Paiement</title>
</head>
<body>

<div class="container wrapper">
        <div class="row cart-head">
            <div class="container">
            <div class="row">
                <p></p>
            </div>
            <div class="row">
                <div style="display: table; margin: auto;">
                    <span class="step step_complete"> <a href="#" class="check-bc"> <h3>Classe:{{ $classe }}</h3> </a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                </div>
            </div>
            <div class="row">
                <p></p>
            </div>
            </div>
        </div>
        <div class="row cart-body">
            <form action="@if($test) {{ route('valider_suite_paiement_path') }}  @else {{ route('valider_paiement_path') }} @endif" method="post" class="form-horizontal"   id="form-paiement">

                {{ csrf_field() }}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Vérifier vos informations</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <strong>Nom:</strong>
                                <input type="text" name="nom" class="form-control" value="{{ $nom }}" />
                            </div>
                            <div class="span1"></div>
                            <div class="col-md-6 col-xs-12">
                                <strong>Prénom:</strong>
                                <input type="text" name="prenom" class="form-control" value="{{ $prenom }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Sexe:</strong>
                                    <select name="sexe" id="" class="form-control">
                                            <option value="masculin">{{ $sexe }}</option>
                                            <option value="feminin">@if ($sexe=='Masculin') Féminin @else Masculin  @endif</option>
                                        </select>
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                <div class=""><strong>Date de naissance</strong></div>
                                <input type="date" name="naissance" value="{{ $naissance }}" class="form-control" required/>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Adresse:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="adresse" class="form-control" value="{{ $adresse }}" />
                                <input type="hidden" name="classe" value="{{ $classe }}" />
                                <input type="hidden" name="matricule" value="@if ($test){{ $matri }} @endif" />
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12"><strong>Pays:</strong></div>
                                <div class="col-md-12">
                                        <select name="pays" id="" class="form-control">
                                                <option selected="selected">{{ $pays }}</option>
                                                <option >Cameroun</option>
                                                <option >Gabon</option>
                                                <option >Tchad</option>
                                                <option >Algérie</option>
                                                <option >France</option>
                                                <option >Guinée</option>
                                            </select>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Ville:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="ville" class="form-control" value="{{ $ville }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Numéro de téléphone:</strong></div>
                            <div class="col-md-12"><input type="text" name="number" class="form-control" value="{{ $numero }}" /></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Email:</strong></div>
                            <div class="col-md-12"><input type="text" name="email" class="form-control" value="{{ $email }}" /></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>CNI:</strong></div>
                            <div class="col-md-12"><input type="text" name="cni" class="form-control" value="{{ $cni }}" /></div>
                        </div>

                    </div>
                </div>


            </div>



            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">

                <!-- PAYMENT-->

                <div class="panel panel-info">
                    @if(sizeOf($reponse)==0)
                    <div class="panel-heading">Les taux de paiement n'ont pas encor été fixer pour cette salle de classe</div>

                    @else
                    <div class="panel-heading">Que voulez vous payer?</div>
                    <br>
                     @if ($test)
                     @for ($i =0 ; $i <sizeOf($reponse) ; $i++)
                     <div class="">
                         <div class="">
                             @for ($verif =0 ; $verif < sizeOf($paiement_effectue) ; $verif++)
                             @php $testeur=false @endphp
                             @if( $reponse[$i]->libelle==$paiement_effectue[$verif]->libelle)
                             <div class="form-group">
                                    <div class="col-md-12"><strong><input disabled type="checkbox" name="{{ $reponse[$i]->libelle }}" value="{{ $reponse[$i]->montant }}">@if($reponse[$i]->libelle=='tranche1') Inscription @else @php $t=explode('e',$reponse[$i]->libelle)[1] @endphp TRANCHE {{ $t-1 }} @endif</strong></div>
                                    <div class="col-md-12"><input type="text"  disabled value=" Déjà payé" checked/>

                                    </div>

                                </div>@break
                               @else
                                @php $testeur=true; @endphp
                               @endif
                             @endfor
                             @if($testeur)
                             <div class="form-group">
                                    <div class="col-md-12"><strong><input  type="checkbox" name="{{ $reponse[$i]->libelle }}" value="{{ $reponse[$i]->montant }}">@if($reponse[$i]->libelle=='tranche1') Inscription @else @php $t=explode('e',$reponse[$i]->libelle)[1] @endphp TRANCHE {{ $t-1 }} @endif</strong></div>

                                    <div class="col-md-12"><input type="text"  disabled value="{{ $reponse[$i]->montant }} Fcfa" />
                                        <input type="hidden" name="date_L{{ $i+1 }}" value="{{ $reponse[$i]->date }}" class="form-control">
                                        <strong> Date de paiement</strong><input type="date" name="date_pay{{ $i+1 }}" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                    </div>

                                </div>

                             @endif
                         </div>
                     </div>
                     <hr>
                     @endfor
                     @else
                     @for ($i =0 ; $i <sizeOf($reponse) ; $i++)
                            <div class="form-group">
                                    <div class="col-md-12"><strong><input  type="checkbox" name="{{ $reponse[$i]->libelle }}" value="{{ $reponse[$i]->montant }}">@if($reponse[$i]->libelle=='tranche1') Inscription @else @php $t=explode('e',$reponse[$i]->libelle)[1] @endphp TRANCHE {{ $t-1 }} @endif</strong></div>

                                    <div class="col-md-12"><input type="text"  disabled value="{{ $reponse[$i]->montant }} Fcfa"class="form-control" />
                                        <input type="hidden" name="date_L{{ $i+1 }}" value="{{ $reponse[$i]->date }}">
                                        <strong>Date de paiement</strong><input type="date" name="date_pay{{ $i+1 }}" class="form-control" value="{{ date('Y-m-d') }}">

                                    </div>

                                </div>

                     <hr>
                     @endfor
                     @endif


                        <input type="hidden" name="nbpaiement" value="{{ sizeOf($reponse) }}">

                    @endif

                                <br>
                                @if ($type!='superadmin' && $type!='admin')
                                <div class="panel-heading" >Paiement</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>type de la carte</strong></div>
                                        <div class="col-md-12">
                                            <select id="CreditCardType" name="CreditCardType" class="form-control">
                                                <option value="5">Visa</option>
                                                <option value="6">MasterCard</option>
                                                <option value="7">American Express</option>
                                                <option value="8">Discover</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Numéro de la carte de crédit:</strong></div>
                                        <div class="col-md-12"><input type="number" class="form-control" name="num_carte" required/></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Carte CVV:</strong></div>
                                        <div class="col-md-12"><input type="number" name="cvv" class="form-control" required/></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <span>Payer en toute sécurité.</span>
                                        </div>
                                        <div class="col-md-12">
                                            <ul class="cards">
                                                <li class="visa hand">
                                                    <img src="images/pp.png" alt="">
                                                    <img src="images/PP.jpg" alt="">
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div>
                                @else
                                <div >
                                        <div class="col-md-12"><input type="hidden" class="form-control" name="num_carte" value="123456789" required/></div>

                                        <div class="col-md-12"><input type="hidden" name="cvv" class="form-control" value="123456" required/></div>
                                    </div>
                                @endif



                </div>
                <!--CREDIT CART PAYMENT END-->
                <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="submit" value="Placer le paiement" class="btn btn-primary btn-submit-fix">
                        </div>
                    </div>
            </div>


        </div>
    </form>
        <div class="row cart-footer">

        </div>
</div>

<script src="//code.jquery.com/jquery.min.js"></script>
    @include('flashy::message')

    <script>

    </script>
</body>
</html>

