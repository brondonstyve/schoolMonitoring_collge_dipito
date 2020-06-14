@if ($utilisateur->type=='enseignant')

@if (!$createEpreuve)
   <!--mes salles de classe-->

  <div class="card">
        <div class="card-body bg-info">
            <h4 class="text-white card-title uppercase">Mes salles de classe</h4>
            <h6 class="card-subtitle text-white m-b-0 op-5">Liste des salles où je dispense cours</h6>
        </div>
        <div class="card-body">
            <div class="message-box contact-box">
                    <h2 class="add-ct-btn">
                            <img src="images/icones/add-green.png" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"
                                data-toggle="modal" data-target="#add-contact">
                        </h2>

                        <!-- tout supprimer les epreuves -->
                        @if (sizeOf($epreuve)>0)
                       <a href="" class=" btn-sm btn-danger" data-toggle="modal" data-target="#supp-tout-ep">Tout supprimer</a>
                        @endif

                            <div class="table-responsive ">
                                    <div id="supp-tout-ep" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content col-xs-9">
                                                <div class="modal-header ">
                                                <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer toutes les épreuves?</h4>
                                            </div>
                                            <div class="modal-title">

                                                    <div class="form-group" style="text-align: center;">
                                                        <div class="col-md-12 m-b-20 carousel-inner">
                                                            <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                <span >
                                                                        <a href="{{ route('supprimer_tout_epreuve_path') }}">Confirmer</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                @for ($i =0 ; $i <sizeOf($classe_a_evaluer) ; $i++)
                @php $compteur=0 @endphp
                <div class="message-widget contact-widget" style="background-color: white" title="">


                    <!-- Message -->
                    <a >
                        <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                            <span class="profile-status online pull-right" style="color: black"></span>
                        </div>
                        <div class="mail-contnet">
                            <h5 style="text-transform: uppercase">{{ $classe_a_evaluer[$i]->classe }}</h5>
                            <span class="mail-desc"> Cliquer sur le boutton vert pour ajouter une epreuve à la {{ $classe_a_evaluer[$i]->classe }}</span>

                        </div>
                    </a>
                    <!-- sous menu -->
                    @for ($u =0 ; $u <sizeOf($epreuve) ; $u++)
                    @if ($epreuve[$u]->classe==$classe_a_evaluer[$i]->classe)
                    @php $compteur=$compteur+1 @endphp

                            <div class=" contact-box" style="top: -0px; background-color: white;max-width: 90%; relative;right: -10%;" >

                        <!--eenvoi-->

                        <span class="mail-desc" data-toggle="modal" data-target="#add-envoi{{ $u }}" style="display: inline-block;max-width: 20px;right: -10%;">
                                    <img src="images/icones/share.png" alt="" title="envoyer" >
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <div class="table-responsive ">
                                        <div id="add-envoi{{ $u }}" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content col-xs-9">
                                                    <div class="centre uppercase">
                                                    <h4 class="" >Envoyer l'épreuve</h4>
                                                </div>
                                                <div class="modal-title">

                                                    <form action="{{ route('Envoyer_epreuve_path') }}" method="post" class="centre">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="idEpreuve" value="{{ $epreuve[$u]->id }}">
                                                        <input type="hidden" name="nomEpreuve" value="{{ $epreuve[$u]->epreuve }}">
                                                        <table >
                                                            <tr>
                                                                <td>Choisissez un enseignant</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select name="path_prof">
                                                                        @for ($nb =0 ; $nb <sizeOf($prof) ; $nb++)
                                                                        <option value="{{ $prof[$nb]->id.'-'.$prof[$nb]->nom.' '.$prof[$nb]->prenom }}">
                                                                                {{ $prof[$nb]->nom.' '.$prof[$nb]->prenom }}
                                                                        </option>
                                                                        @endfor
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <input type="submit" value="Envoyer" class="btn btn-success centre">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </a>
                    </span>
            <!--fin envoi-->

                        <!--supprimer-->
                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-target="#add-sup{{ $u }}">
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                                <div id="add-sup{{ $u }}" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content col-xs-9">
                                                            <div class="modal-header ">
                                                            <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer ce ficher?</h4>
                                                        </div>
                                                        <div class="modal-title">

                                                                <div class="form-group" style="text-align: center;">
                                                                    <div class="col-md-12 m-b-20 carousel-inner">
                                                                        <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                            <span >
                                                                                    <a href="{{ route('supprimer_epreuve_path') }}?path_directori={{ $epreuve[$u]->id }}">Suprimer</a>
                                                                            </span>
                                                                        </div>
                                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                            </div>

                                        </div>
                            </span>

                 <!--fin suppression-->

                 <!--modifier-->
                 <span class="mail-desc" style="display: inline-block;max-width: 20px">
                        <img src="images/icones/mis_a_jour.png" data-toggle="modal" data-target="#mod-rep{{ $u }}">
                </span>

                <span class="mail-desc" style="display: inline-block;max-width: 20px">
                        <div id="mod-rep{{ $u }}" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content col-xs-10">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title"><b>Modifier les reponses</b></h4>
                                            <p class="text-muted font-14 m-b-20 btn-sm">
                                                 épreuve de<code>{{ explode('.',$epreuve[$u]->matiere)[1] }}.</code>   {{ $nbr_reponse=sizeOf(explode('.',$epreuve[$u]->reponse))-1 }} questions
                                            </p>

                                            <div class="table-responsive">
                                                <form action="{{ route('modifier_reponses_path') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <table class="table m-0 table-colored-bordered table-bordered-inverse">
                                                            <thead>
                                                            <tr class="btn-sm">
                                                                <th>question</th>
                                                                <th>reponses</th>
                                                                <th>question</th>
                                                                <th>réponse</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <tr>
                                                                            @for ($r = 0; $r < $nbr_reponse; $r++)
                                                                            <tr class="">
                                                                                <td>{{ $r+1 }}</td>

                                                                                <td>
                                                                                    <select name="reponse{{ $r }}" id="">
                                                                                      <option style="background-color: brown" value="{{ explode('.',$epreuve[$u]->reponse)[$r] }}">{{ explode('.',$epreuve[$u]->reponse)[$r] }}</option>
                                                                                        @for ($rep = 0; $rep < 4; $rep++)
                                                                                           @if(explode('.',$epreuve[$u]->reponse)[$r]!=$reponse[$rep])
                                                                                             <Option value="{{ $reponse[$rep] }}">{{ $reponse[$rep] }}</option>
                                                                                           @endif
                                                                                        @endfor
                                                                                    </select>

                                                                                </td>
                                                                                @php $r=$r+2 @endphp
                                                                                <td>{{ $r }}</td>
                                                                                @php $r-- @endphp

                                                                                <td>
                                                                                    <select name="reponse{{ $r }}" id="">
                                                                                      <option style="background-color: brown " value="{{ explode('.',$epreuve[$u]->reponse)[$r] }}">{{ explode('.',$epreuve[$u]->reponse)[$r] }}</option>
                                                                                        @for ($rep = 0; $rep < 4; $rep++)
                                                                                           @if(explode('.',$epreuve[$u]->reponse)[$r]!=$reponse[$rep])
                                                                                             <Option value="{{ $reponse[$rep] }}">{{ $reponse[$rep] }}</option>
                                                                                           @endif
                                                                                        @endfor
                                                                                    </select>
                                                                                </td>

                                                                        </tr>

                                                                        @endfor
                                                                            <tr>
                                                                                <td colspan="2">Matiere et Classe</td>
                                                                                <td colspan="2">
                                                                                        <select name="matiere" required style="min-width: 100%;text-transform: uppercase">
                                                                                                @for ($y =0 ; $y <sizeOf($classe_mat) ; $y++)
                                                                                                <option value="{{ $classe_mat[$y]->id.'.'.$classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe }}">
                                                                                                    {{ $classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe }}
                                                                                                </option>
                                                                                               @endfor
                                                                                            </select>
                                                                                </td>
                                                                            </tr>
                                                                        <tr>
                                                                            <td colspan="4" align="center">
                                                                                <input type="hidden" name="nbre" value="{{ sizeOf(explode('.',$epreuve[$u]->reponse))-1 }}">
                                                                                <input type="hidden" name="id_epreuve" value="{{ $epreuve[$u]->id }}">
                                                                                <input type="submit" value="Modifier" class="btn btn-sm btn-info">
                                                                            </td>
                                                                        </tr>
                                                            </tbody>
                                                        </table>
                                                </form>

                                            </div>
                                        </div>
                            </div>
                    </div>

                </div>
    </span>



                <!--fin modification-->




                        </div>



                        <div class=" contact-box" style="top: -0px; background-color: #57bec5;max-width: 90%; relative;right: -10%;" >
                            <a href="{{ route('evaluer_classe_path') }}?path_directori={{ $epreuve[$u]->id }}&path_directoric={{ $epreuve[$u]->matiere }}&path_dir={{ $epreuve[$u]->classe }}" title="Cliquer pour créer une évaluation">
                                <div class="user-img"> <img src="images/courrs.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>

                                <div class="mail-contnet">
                                        <h5 style="text-transform: uppercase">épreuves de {{ explode('.',$epreuve[$u]->matiere)[1] }}</h5>
                                        <span class="mail-desc">édité le {{ $epreuve[$u]->created_at }} par moi pour la {{ $epreuve[$u]->classe }}</span>


                                    </div>

                                    <span class="btn-sm"
                                        style="text-transform: uppercase;color:brown">Séquence {{ $epreuve[$u]->libelle }}</span>
                            </a>


                    </div>

                    @endif

                   @endfor
                   @if ($compteur==0)

                   <div class=" contact-box" style="top: -0px; background-color: #f96a74;max-width: 90%; relative;right: -10%;" >
                            <a >
                                <div class="user-img"> <img src="images/bloc.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>

                                <div class="mail-contnet" >
                                        <h5 style="text-transform: uppercase">pas d'épreuves</h5>
                                        <span class="mail-desc" style="color: black">vous n'avez pas envore crée d'épreuve pour cette classe. crére en une!</span>


                                    </div>
                            </a>


                    </div>

                   @endif


                </div>

            @endfor

    <!-- autres -->
           @php $compteur=0 @endphp
            <a href="">
                    <div class="message-widget contact-widget" style="background-color: white"
                    title="">
                    <a >
                        <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                            <span class="profile-status online pull-right" style="color: black"></span>
                        </div>
                        <div class="mail-contnet">
                                <h5 style="text-transform: uppercase">Autres</h5>
                                <span class="mail-desc"> Les épreuves recus des autres professeurs</span>
                        </div>
                    </a>

                    @for ($z =0 ; $z <sizeOf($epreuve) ; $z++)
                    @if ($epreuve[$z]->classe=='')
                    @php $compteur=$compteur+1 @endphp
                    <div class=" contact-box" style="top: -0px; background-color: white;max-width: 90%; relative;right: -10%;" >


                        <!--eenvoi-->
                        <span class="mail-desc" data-toggle="modal" data-target="#add-envoi{{ $z }}" style="display: inline-block;max-width: 20px;right: -10%;">
                                    <img src="images/icones/share.png" alt="" title="envoyer" >
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <div class="table-responsive ">
                                        <div id="add-envoi{{ $z }}" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content col-xs-9">
                                                    <div class="centre uppercase">
                                                    <h4 class="" >Envoyer l'épreuve</h4>
                                                </div>
                                                <div class="modal-title">

                                                    <form action="{{ route('Envoyer_epreuve_path') }}" method="post" class="centre">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="idEpreuve" value="{{ $epreuve[$z]->id }}">
                                                        <input type="hidden" name="nomEpreuve" value="{{ $epreuve[$z]->epreuve }}">
                                                        <table >
                                                            <tr>
                                                                <td>Choisissez un enseignant</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select name="path_prof" class="form-control">
                                                                        @for ($nb =0 ; $nb <sizeOf($prof) ; $nb++)
                                                                        <option value="{{ $prof[$nb]->id.'-'.$prof[$nb]->nom.' '.$prof[$nb]->prenom }}">
                                                                                {{ $prof[$nb]->nom.' '.$prof[$nb]->prenom }}
                                                                        </option>
                                                                        @endfor
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <input type="submit" value="Envoyer" class="btn btn-success centre">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </a>
                    </span>
            <!--fin envoi-->

                    <!--supprimer-->
                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                            <img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-target="#add-sup{{ $z }}">
                    </span>

                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                            <div id="add-sup{{ $z }}" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content col-xs-9">
                                                        <div class="modal-header ">
                                                        <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer ce ficher?</h4>
                                                    </div>
                                                    <div class="modal-title">

                                                            <div class="form-group" style="text-align: center;">
                                                                <div class="col-md-12 m-b-20 carousel-inner">
                                                                    <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                        <span >
                                                                                <a href="{{ route('supprimer_epreuve_path') }}?path_directori={{ $epreuve[$z]->id }}">Suprimer</a>
                                                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>
                        </span>


             <!--fin suppression-->

                          <!--modifier-->
                          <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <img src="images/icones/mis_a_jour.png" data-toggle="modal" data-target="#mod-rep{{ $z }}">
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <div id="mod-rep{{ $z }}" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content col-xs-10">
                                                <div class="card-box">
                                                    <h4 class="m-t-0 header-title"><b>Modifier les reponses</b></h4>
                                                    <p class="text-muted font-14 m-b-20 btn-sm">
                                                         épreuve de<code>{{ explode('.',$epreuve[$z]->matiere)[1] }}.</code>   {{ $nbr_reponse=sizeOf(explode('.',$epreuve[$z]->reponse))-1 }} questions
                                                    </p>

                                                    <div class="table-responsive">
                                                        <form action="{{ route('modifier_reponses_path') }}" method="post">
                                                            {{ csrf_field() }}

                                                            <table class="table m-0 table-colored-bordered table-bordered-inverse">
                                                                    <thead>
                                                                    <tr class="btn-sm">
                                                                        <th>question</th>
                                                                        <th>reponses</th>
                                                                        <th>question</th>
                                                                        <th>réponse</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                            <tr>
                                                                                    @for ($r = 0; $r < $nbr_reponse; $r++)
                                                                                    <tr class="">
                                                                                        <td>{{ $r+1 }}</td>

                                                                                        <td>
                                                                                            <select name="reponse{{ $r }}" id="">
                                                                                              <option style="background-color: brown" value="{{ explode('.',$epreuve[$z]->reponse)[$r] }}">{{ explode('.',$epreuve[$z]->reponse)[$r] }}</option>
                                                                                                @for ($rep = 0; $rep < 4; $rep++)
                                                                                                   @if(explode('.',$epreuve[$z]->reponse)[$r]!=$reponse[$rep])
                                                                                                     <Option value="{{ $reponse[$rep] }}">{{ $reponse[$rep] }}</option>
                                                                                                   @endif
                                                                                                @endfor
                                                                                            </select>

                                                                                        </td>
                                                                                        @php $r=$r+2 @endphp
                                                                                        <td>{{ $r }}</td>
                                                                                        @php $r-- @endphp

                                                                                        <td>
                                                                                            <select name="reponse{{ $r }}" id="">
                                                                                              <option style="background-color: brown " value="{{ explode('.',$epreuve[$z]->reponse)[$r] }}">{{ explode('.',$epreuve[$z]->reponse)[$r] }}</option>
                                                                                                @for ($rep = 0; $rep < 4; $rep++)
                                                                                                   @if(explode('.',$epreuve[$z]->reponse)[$r]!=$reponse[$rep])
                                                                                                     <Option value="{{ $reponse[$rep] }}">{{ $reponse[$rep] }}</option>
                                                                                                   @endif
                                                                                                @endfor
                                                                                            </select>
                                                                                        </td>

                                                                                </tr>
                                                                                @endfor
                                                                                    <tr>
                                                                                <td colspan="2">Matiere et classe</td>
                                                                                <td colspan="2">
                                                                                        <select name="matiere" required style="min-width: 100%;text-transform: uppercase">
                                                                                                @for ($y =0 ; $y <sizeOf($classe_mat) ; $y++)
                                                                                                <option value="{{ $classe_mat[$y]->id.'.'.$classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe }}">
                                                                                                    {{ $classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe }}
                                                                                                </option>
                                                                                               @endfor
                                                                                            </select>
                                                                                </td>
                                                                            </tr>
                                                                                <tr>
                                                                                    <td colspan="4" align="center">
                                                                                        <input type="hidden" name="nbre" value="{{ sizeOf(explode('.',$epreuve[$z]->reponse))-1 }}">
                                                                                        <input type="hidden" name="id_epreuve" value="{{ $epreuve[$z]->id }}">
                                                                                        <input type="submit" value="Modifier" class="btn btn-sm btn-info">
                                                                                    </td>
                                                                                </tr>
                                                                    </tbody>
                                                                </table>
                                                        </form>

                                                    </div>
                                                </div>
                                    </div>
                            </div>

                        </div>
                    </div>
            </span>



                        <!--fin modification-->



                        <div class=" contact-box" style="background-color: #57bec5;max-width: 90%; relative;right: -10%" >
                            <a href="#" onclick="alert('attribuer l\'épreuve à une salle de classe avant pouvoir créer une évaluation')">
                                <div class="user-img"> <img src="images/courrs.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5 style="text-transform: uppercase">épreuve de {{ explode('.',$epreuve[$z]->matiere)[1] }}</h5>
                                    <span class="mail-desc"> édité par {{ $epreuve[$z]->editeur }}</span>

                                </div>
                            </a>
                    </div>


                    @endif

                   @endfor

                   @if ($compteur==0)

                   <div class=" contact-box" style="top: -0px; background-color: #f96a74;max-width: 90%; relative;right: -10%;" >
                            <a >
                                <div class="user-img"> <img src="images/bloc.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>

                                <div class="mail-contnet" >
                                        <h5 style="text-transform: uppercase">pas d'épreuves</h5>
                                        <span class="mail-desc" style="color: black">vous n'avez pas envore crée d'épreuve pour cette classe. crére en une!</span>


                                    </div>
                            </a>


                    </div>

                   @endif

    </div>



</div>

</div>
</div>
    @endif






<!--creation des données d'epreuve-->







<!-- creation d'épreuves -->

@if ($createForm)
<!-- liste de mes evaluations -->

        <div class="card-body bg-info">
                @if (sizeOf($evaluation)==0)
                <h4 class="text-white card-title uppercase">aucune évaluation crée pour le moment</h4>
                <h6 class="card-subtitle text-white m-b-0 op-5">Créer des evaluations a partir de vos épreuves</h6>
                @else
                <h4 class="text-white card-title uppercase">Mes evaluations</h4>
                <h6 class="card-subtitle text-white m-b-0 op-5">Liste de mes évaluations</h6>
            </div>

            <!-- tout supprimer evaluation -->

            <a href="" class="btn-sm btn-danger" data-toggle="modal" data-target="#supp-tout">Tout supprimer</a>

            <span class="mail-desc" style="display: inline-block;max-width: 20px">
                    <a href="">
                            <div class="table-responsive ">
                                    <div id="supp-tout" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content col-xs-9">
                                                <div class="modal-header ">
                                                <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer toutes les évaluations?</h4>
                                            </div>
                                            <div class="modal-title">

                                                    <div class="form-group" style="text-align: center;">
                                                        <div class="col-md-12 m-b-20 carousel-inner">
                                                            <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                <span >
                                                                        <a href="{{ route('supprimer_tout_evaluation_path') }}">Confirmer</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    </a>
                </span>





            <div class="card-body">

                <div class="message-box contact-box">

                    @for ($i =0 ; $i <sizeOf($evaluation) ; $i++)

                    <div class="message-widget contact-widget" style="background-color: antiquewhite"
                        title="">


                        <!-- Message -->
                        <a href="storage\epreuve\{{ $evaluation[$i]->epreuve }}">
                            <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right" style="color: black"></span>
                            </div>
                            <div class="mail-contnet">
                                <h5 style="text-transform: uppercase">évaluation de {{ $evaluation[$i]->nom }} en {{ $evaluation[$i]->class_mat }} pour la séquence : {{ $evaluation[$i]->libelle }}</h5>
                                <span class="mail-desc"> En attente de validation par l'administration...</span>

                            </div>

                            <span class="btn-sm"
                                style="text-transform: uppercase;color:brown">durée::{{ $evaluation[$i]->dure }} minutes</span>

                        </a>
                    </div>

                <!--voir evaluation-->
                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <a href="{{ route('modifier_evaluation_path') }}?path_directrieRetry={{ $evaluation[$i]->id }}">
                                    <img src="images/icones/oeil.png" alt="supprimer" title="supprimer">
                                </a>
                            </span>
                <!--Supprimer eva-->
                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                            <a data-toggle="modal" data-target="#add-sup-eva{{ $i }}">
                                <img src="images/icones/del-red.png" alt="supprimer" title="supprimer">
                            </a>
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <a href="">
                                        <div class="table-responsive ">
                                                <div id="add-sup-eva{{ $i }}" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content col-xs-9">
                                                            <div class="modal-header ">
                                                            <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer cet évaluation?</h4>
                                                        </div>
                                                        <div class="modal-title">

                                                                <div class="form-group" style="text-align: center;">
                                                                    <div class="col-md-12 m-b-20 carousel-inner">
                                                                        <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                            <span >
                                                                                    <a href="{{ route('supprimer_evaluation_path') }}?path_direc={{ $evaluation[$i]->id }}">Suprimer</a>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                </a>
                            </span>




                        @endfor




                </div>
                @endif



        </div>
    </div>




<!--creation des données d'epreuve-->



    <div class="table-responsive ">
            <div id="add-contact" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog" style="min-width: 90%">

                    <div class="col-md-4 modal-content" style="">

                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Détails de l'évaluation</b></h4>
                            <div class="table-responsive">
                                    <form action="{{ route('generer_epreuve_path') }}" method="post">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                        <div class="col-md-7"><strong>Matièere:</strong></div>
                                                            <select name="matiere" required class="form-control" style="text-transform: uppercase">
                                                                @for ($i =0 ; $i <sizeOf($classe_mat) ; $i++) <option
                                                                    value="{{ $classe_mat[$i]->id.'.'.$classe_mat[$i]->nom.'->'.$classe_mat[$i]->classe }}">
                                                                    {{ $classe_mat[$i]->nom.'->'.$classe_mat[$i]->classe }}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                                <div class="col-md-7"><strong>Libellé:</strong></div>

                                                                <select name="libelle" id="" class="form-control" style="min-width: 100%;text-transform: uppercase">
                                                                        @php
                                                                        $cc=0;
                                                                        $sequence=0;
                                                                        $parcoureur=0;
                                                                        $trimestre=0;
                                                                    @endphp
                                                                @for ($sek = 0; $sek < $sekuence; $sek++)

                                                                            @if($parcoureur<2)

                                                                            <option value="{{ $sek+1 }}">CC {{ ++ $cc }}</option>

                                                                               @php
                                                                                    $parcoureur=$parcoureur+1;
                                                                                @endphp

                                                                             @else

                                                                        <option value="{{ $sek+1 }}">Séquence {{ ++ $sequence }}</option>

                                                                              @php
                                                                                 $parcoureur=$parcoureur+1;
                                                                             @endphp

                                                                             @if ($parcoureur==4)


                                                                              @php
                                                                              $parcoureur=0;
                                                                             @endphp

                                                                             @endif



                                                                            @endif
                                                                    @endfor
                                                                </select>
                                                        </div>
                                                            <div class="form-group">
                                                                    <div class="col-md-7"><strong>nombre de questions :</strong></div>

                                                            <select name="nbre_kuestion" id="" class="form-control">
                                                                <option value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="30">30</option>
                                                                <option value="40">40</option>
                                                            </select>
                                                        </div>
                                            <input type="submit" class=" btn-sm btn-info pull-left" value="Valider">
                                            <button type="button" class="btn-sm btn-default pull-right" data-dismiss="modal">Annuler</button>
                                        </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>




<!--creation des données d'epreuve-->


@endif


<!--creation epreuve-->
@if ($createEpreuve)

<div class="card">
        <div class="card-body btn-info centre">
            <h4 class="text-white card-title">Fiche d'épreuve</h4>
        </div>
        <div class="card-body">
            <div class="message-box contact-box">
                <h2 class="add-ct-btn">
                    <a href="{{ route('evaluation_path') }}">
                    <button type="" class="btn btn-circle btn-lg btn-danger waves-effect waves-dark">
                        X
                    </button>
                </a>
                </h2>
<div class="col-md-12" style="background-color: azure;">

    <div class="card-box">
        <div class="table-responsive">
            <form action="{{ route('enregistrer_epreuve_path') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table class="table-colored-full table-full-inverse table-hover" style="font-size: 15px;color: white">
                    <thead>
                        <tr style="color: white">
                            <th colspan="4" class="centre"> Epreuve de {{ explode('.',$matiere_classe[0])[1] }} de la
                                {{ $matiere_classe[1] }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <div class="col-md-13 m-b-20 carousel-inner">
                                    <div class="fileupload  bouton  btn-info btn-rounded waves-effect carousel-inner"><span
                                            style="font-size: 20px;text-transform: uppercase">AJOUTER UN
                                            FICHIER</span>
                                        <input type="file" id="imgInp" accept="image/jpg,image/jpeg,application/pdf"
                                            name="fichier" class=" btn-sm " style="width: 100%" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <td colspan="4">
                            <div class="col-md-13 m-b-20 carousel-inner">
                                <div class="fileupload bouton  btn-info btn-rounded waves-effect carousel-inner"><span
                                        style="font-size: 20px;text-transform: uppercase">Inserer les
                                        reponses</span>

                                </div>
                            </div>
                        </td>
                        </tr>

                        @for ($i = 0; $i < $nbre_k; $i++) <tr class="">
                            <td class="centre">{{ $i+1 }}</td>

                            <td class="centre">
                                <select name="kcm{{ $i }}" id="">
                                    @for ($rep = 0; $rep < 4; $rep++) <Option value="{{ $reponse[$rep] }}">
                                        {{ $reponse[$rep] }} </option>
                                        @endfor
                                </select>
                            </td>
                            @php $i=$i+2 @endphp
                            <td class="centre">{{ $i }}</td>
                            @php $i-- @endphp

                            <td class="centre">
                                <select name="kcm{{ $i }}" id="">
                                    @for ($rep = 0; $rep < 4; $rep++) <Option value="{{ $reponse[$rep] }}">
                                        {{ $reponse[$rep] }} </option>
                                        @endfor
                                </select>
                            </td>

                            </tr>
                            @endfor

                            <tr>
                                <td colspan="4">
                                    <div class="col-md-13 m-b-20 carousel-inner">
                                        <div class="fileupload bouton  btn-info btn-rounded waves-effect carousel-inner"
                                            style="text-transform: uppercase"><span
                                                style="font-size: 20px">confirmation du lbellé et la durée</span>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <th style="text-transform: uppercase;float: right">Séquence</th>
                                <td style="width: 25%">
                                    <select name="libelle" id="" style="min-width: 100%;text-transform: uppercase">

                                            @php
                                            $cc=0;
                                            $sequence=0;
                                            $parcoureur=0;
                                            $trimestre=0;
                                        @endphp

                                    @for ($sek = 0; $sek < $sekuence; $sek++)

                                                @if($parcoureur<2)

                                                <option value="{{ $sek+1 }}">CC {{ ++ $cc }}</option>

                                                   @php
                                                        $parcoureur=$parcoureur+1;
                                                    @endphp

                                                 @else

                                            <option value="{{ $sek+1 }}">Séquence {{ ++ $sequence }}</option>

                                                  @php
                                                     $parcoureur=$parcoureur+1;
                                                 @endphp

                                                 @if ($parcoureur==4)


                                                  @php
                                                  $parcoureur=0;
                                                 @endphp

                                                 @endif



                                                @endif
                                        @endfor
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <th style="text-transform: uppercase;float: right">classe</th>
                                <td style="width: 25%">{{ $matiere_classe[1] }}</td>
                                <th style="text-transform: uppercase;float: right">matière</th>
                                <td style="width: 25%">{{ explode('.',$matiere_classe[0])[1] }}</td>
                            </tr>
                    </tbody>


                    <thead>

                        <tr>
                            <td colspan="4" align="center">
                                <input type="hidden" name="classe" value="{{ $matiere_classe[1] }}">
                                <input type="hidden" name="matiere" value="{{ $matiere_classe[0] }}">
                                <input type="hidden" name="nbre" value="{{ $nbre_k }}">
                                <input type="submit" class="btn btn-info" value="Valider"
                                    style="font-size: 15px;"></span>

                            </td>
                        </tr>
                    </thead>

                </table>

            </form>
        </div>
    </div>

</div>
</div></div></div>

@endif

@else

@endif
