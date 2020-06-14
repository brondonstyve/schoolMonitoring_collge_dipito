@if (sizeOf($paiement)==0)
                        <h3 class="text-center">Aucun paiement éffectué par {{ $eleve[0]->nom.' '.$eleve[0]->prenom }}</h3>
                    @else
                    @php
                    $total=0;
                    $reste=0;
                @endphp

                @for ($i = 0; $i < sizeOf($paiement); $i++)
                 @php
                  $reste= $paiement[$i]->montant + $reste;
                 @endphp
                @endfor

                @for ($i = 0; $i < sizeOf($resultat); $i++)
                  @php
                   $total= $resultat[$i]->montant + $total;
                  @endphp
                @endfor
<div class="row">
<!-- Column -->
<div class="col-sm-12">
<div class="card card-size2 color-md3">
<div class="card-body">
    <div class="d-flex flex-wrap">
        <div class="ml-auto align-self-center">
            <ul class="list-inline m-b-0">
                <li>
                    <h6 class="text-muted text-info"><a href="">Reste</a>
                    </h6>
                </li>
                <li>
                    <h4 class="text-muted text-info"><a href=""> {{ $total-$reste }} FCFA</a>
                    </h4>
                </li>
            </ul>
        </div>
    </div>
    @if (sizeOf($paiement)==0)
        <h3>Aucun paiement éffectué</h3>
    @else

    @endif
    <div class="campaign ct-charts">

            <div class="card">
                    <div class="card-body">
                        <div class="table-responsive m-t-20">

                            <table class="table stylish-table">
                                    <thead>
                                        <tr>
                                            <th>Tranche</th>
                                            <th>Montant</th>
                                            <th>statut</th>
                                            <th>payé le</th>
                                            <th>date limite</th>
                                            <th>pénalité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                @php
                                                     $penalite=0;
                                                 @endphp
                                        @for ($i = 0; $i < sizeOf($resultat); $i++)
                                        <tr >
                                            @for ($a = 0; $a < sizeOf($paiement); $a++)
                                            @php
                                                $testor=true;
                                            @endphp
                                            @if ($resultat[$i]->libelle == $paiement[$a]->libelle)
                                            <td> {{ $resultat[$i]->libelle }} </td>
                                             <td> {{ $resultat[$i]->montant }} </td>
                                             <td> payé </td>
                                             <td> {{ $paiement[$a]->date }} </td>
                                             <td> {{ $resultat[$i]->date }} </td>
                                             <td>
                                                 @php
                                                     $date1=new Date($paiement[$a]->date);
                                                     $date2=new Date($resultat[$i]->date);
                                                 @endphp

                                                     @if($date1 > $date2)
                                                                    @php
                                                                        $date1=number_format((strtotime($date1)-strtotime($date2))/86400);
                                                                    @endphp
                                                                    @if ($date1<=6 && $date1>0 )
                                                                        {{ $k=$resultat[$i]->penalite }} FCFA
                                                                        @php
                                                                            $penalite=$penalite + $k;
                                                                        @endphp
                                                                    @else

                                                                            @php
                                                                                $compteur=0;
                                                                                $rechargeur=0;
                                                                                $jour_supp=0;
                                                                            @endphp
                                                                                @for ($p = 1; $p <= $date1 ; $p++)
                                                                                    @php
                                                                                        $rechargeur=$rechargeur + 1;
                                                                                    @endphp
                                                                                    @if ($rechargeur<=6)
                                                                                        @php
                                                                                            $jour_supp=1;
                                                                                        @endphp
                                                                                        @else
                                                                                        @php
                                                                                            $jour_supp=0;
                                                                                        @endphp
                                                                                    @endif
                                                                                    @if ($rechargeur==7)
                                                                                        @php
                                                                                            $compteur=$compteur+ 1;
                                                                                            $rechargeur=0;
                                                                                            $jour_supp=0;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endfor

                                                                                @if ($jour_supp==1)
                                                                                {{  $k=($resultat[$i]->penalite * $compteur) + $resultat[$i]->penalite }} FCFA
                                                                                @php
                                                                                 $penalite=$penalite + $k;
                                                                                @endphp
                                                                                @else
                                                                                {{  $k=($resultat[$i]->penalite * $compteur) }} FCFA
                                                                                @php
                                                                                 $penalite=$penalite + $k;
                                                                                @endphp
                                                                                @endif

                                                                    @endif

                                                            @else
                                                            0 FCFA
                                                     @endif
                                             </td>
                                            </tr>
                                            @break
                                            @php
                                                $testor=false;
                                            @endphp
                                             @else
                                              @if ($testor)
                                              <tr style="color: brown">
                                                    <td> {{ $resultat[$i]->libelle }} </td>
                                                     <td> {{ $resultat[$i]->montant }}</td>
                                                     <td> non payé </td>
                                                     <td> / </td>
                                                     <td> {{ $resultat[$i]->date }}</td>
                                                     <td>
                                                         @php
                                                            $date1=new Date();
                                                            $date2=new Date($resultat[$i]->date);
                                                        @endphp

                                                            @if($date1 > $date2)
                                                                           @php
                                                                               $date1=number_format((strtotime($date1)-strtotime($date2))/86400);
                                                                           @endphp
                                                                           @if ($date1<=6 && $date1>0 )
                                                                               {{ $k=$resultat[$i]->penalite }} FCFA
                                                                               @php
                                                                                    $penalite=$penalite + $k;
                                                                               @endphp
                                                                           @else

                                                                                   @php
                                                                                       $compteur=0;
                                                                                       $rechargeur=0;
                                                                                       $jour_supp=0;
                                                                                   @endphp
                                                                                       @for ($p = 1; $p <= $date1 ; $p++)
                                                                                           @php
                                                                                               $rechargeur=$rechargeur + 1;
                                                                                           @endphp
                                                                                           @if ($rechargeur<=6)
                                                                                               @php
                                                                                                   $jour_supp=1;
                                                                                               @endphp
                                                                                               @else
                                                                                               @php
                                                                                                   $jour_supp=0;
                                                                                               @endphp
                                                                                           @endif
                                                                                           @if ($rechargeur==7)
                                                                                               @php
                                                                                                   $compteur=$compteur+ 1;
                                                                                                   $rechargeur=0;
                                                                                                   $jour_supp=0;
                                                                                               @endphp
                                                                                           @endif
                                                                                       @endfor

                                                                                       @if ($jour_supp==1)
                                                                                       {{  $k=($resultat[$i]->penalite * $compteur) + $resultat[$i]->penalite }}FCFA
                                                                                       @php
                                                                                         $penalite=$penalite + $k;
                                                                                       @endphp
                                                                                       @else
                                                                                       {{  $k=($resultat[$i]->penalite * $compteur) }} FCFA
                                                                                       @php
                                                                                          $penalite=$penalite + $k;
                                                                                       @endphp
                                                                                       @endif

                                                                           @endif

                                                                   @else
                                                                   0 FCFA

                                                            @endif
                                                        </td>
                                                        </tr>
                                              @endif
                                            @endif


                                            @endfor



                                        @endfor


                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>
    </div>

    @if ($penalite==0)
    <h1 class="btn btn-success btn-sm right">Pas de pénalités</h1>
    @else
    <h1 class="btn btn-success btn-sm right">statut de pénalités : {{ $penalite }} FCFA</h1>
    @endif
</div>
</div>
</div>
</div>



                    @endif


<br><br>


<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            @if (sizeOf($reponse)<=0)
            <h4 class="m-t-0 header-title" id="title"><b id="b">Aucun Paiement fixé pour {{ $filiere[0]->nom }}</b></h4>
              @else
              <h4 class="m-t-0 header-title" id="title"><b id="b">Moratoire pour {{ $eleve[0]->nom.' '.$eleve[0]->prenom }}</b></h4>


              <div class="table-responsive">
                  <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableetudiants">

                      <thead id="entete">
                          <tr>
                              <th>Tranche</th>
                              <th>montant</th>
                              <th>Pénalilité</th>
                              <th>date limite</th>
                              <th>Moratoire</th>
                          </tr>
                      </thead>
                      <tbody id="corps">
                          @for ($i =0 ; $i < sizeOf($reponse) ; $i++)
                          <tr id="">
                              <td tabindex="1">
                                @if ($reponse[$i]->libelle=='tranche1')
                                Inscription
                            @else
                                @php
                                    $t=explode('e',$reponse[$i]->libelle)[1];
                                @endphp
                                Tranche{{ $t-1 }}
                            @endif
                              </td>
                              <td tabindex="1" >{{ $reponse[$i]->montant }}</td>
                              <td tabindex="1" >{{ $reponse[$i]->penalite }}</td>
                              <td tabindex="1">{{ $reponse[$i]->date }}</td>
                              <td><input type="button" value="moratoire" name="morat" id="moratoire"
                                data-moratoire_lib="{{ $reponse[$i]->libelle }}" data-date="{{ $reponse[$i]->date }}"
                                data-id="{{ $eleve[0]->id }}" data-classe="{{ $eleve[0]->classe }}"
                                data-matricule="{{ $eleve[0]->matricule }}" class="btn btn-success"></td>
                              <input type="button" value="ok"  id="valider" data-toggle="modal" data-target="#demande_morat" class="fade">
                          </tr>
                          @endfor

                      </tbody>
                      <tfoot>
                          <tr>
                              <th></th>
                              <th></th>
                              <th></th>
                          </tr>
                      </tfoot>
                  </table>

              </div>
          </div>
      </div>
  </div>
@endif




<div id="demande_morat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Demande de moratoire</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('payer_moratoire_path') }}" method="post" class="form-horizontal form-material "
                    id="form_moratoire">
                    @csrf
                    <div class="form-group ">
                        <div class="">
                            <strong>Date limite</strong>
                           <input class="form-control"  id="anc-date" disabled>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="">
                            <strong>Nouvelle échèance</strong>
                           <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>

                    <input type="hidden" name="matricule" id="id-elev">
                    <input type="hidden" name="tranche" id="nom_tranche">
                    <input type="hidden" name="ancDate" id="anc-dat">
                    <input type="hidden" name="classe" id="classe">
                    <input type="hidden" name="matri" id="matric">


            </div>
            <div class="modal-footer">
                <input type="submit" value="Demander" id="submit" class="left btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>

