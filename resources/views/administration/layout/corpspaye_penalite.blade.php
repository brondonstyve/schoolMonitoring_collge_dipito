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

        <div class="col-lg-12 col-xlg-9 col-md-7">
            <div class="card card-size2 color-md3">
                    <h3 class="card-title">Etudiant {{ $paiement[0]->nom.' '.$paiement[0]->prenom }} de la {{ $paiement[0]->classe }}</h3>

                <div class="card-body">
                    <div class="d-flex flex-wrap">

                        <div>
                            <h4 class="card-title">Total a payer : {{ $total }} FCFA</h4>
                        </div>
                        <div class="ml-auto align-self-center">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <h5 class="text-muted text-info"><a href="">Reste : {{ $total-$reste }} FCFA</a>
                                    </h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="campaign ct-charts">

                            <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive m-t-20">
                                            <form action="{{ route('val_payer_penalite_path') }}" method="post">
                                                {{ csrf_field() }}
                                            <table class="table stylish-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Tranche</th>
                                                            <th>Montant</th>
                                                            <th>statut</th>
                                                            <th>payé le</th>
                                                            <th>date limite</th>
                                                            <th>pénalité</th>
                                                            <th>payer</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                @php
                                                                     $penalite=0;
                                                                 @endphp
                                                        @for ($i = 0; $i < sizeOf($resultat); $i++)
                                                        @php
                                                            $pen=0;
                                                        @endphp
                                                        <tr >
                                                            @for ($a = 0; $a < sizeOf($paiement); $a++)
                                                            @php
                                                                $testor=true;
                                                            @endphp
                                                            @if ($resultat[$i]->libelle == $paiement[$a]->libelle)
                                                              @php
                                                                $plus=$i+1;
                                                              @endphp
                                                            <td>
                                                                @if ($resultat[$i]->libelle=='tranche1')
                                                                    Inscription
                                                                @else
                                                                    @php
                                                                        $t=explode('e',$resultat[$i]->libelle)[1];
                                                                    @endphp
                                                                    Tranche{{ $t-1 }}
                                                                @endif
                                                             </td>
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
                                                                                            $pen=1;
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
                                                                                                 $pen=1;
                                                                                                @endphp
                                                                                                @else
                                                                                                {{  $k=($resultat[$i]->penalite * $compteur) }} FCFA
                                                                                                @php
                                                                                                 $penalite=$penalite + $k;
                                                                                                 $pen=1;
                                                                                                @endphp
                                                                                                @endif

                                                                                    @endif

                                                                            @else
                                                                            0 FCFA
                                                                     @endif
                                                                     @if ($pen<=0)
                                                                            <td><input type="checkbox" name="payer{{ $i }}" id="" value="{{ $paiement[$a]->id }}" disabled></td>
                                                                            @else
                                                                           <td><input type="checkbox" name="payer{{ $i }}" id="" value="{{ $paiement[$a]->id }}"></td>
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
                                                                    <td> @if ($resultat[$i]->libelle=='tranche1')
                                                                        Inscription
                                                                    @else
                                                                        @php
                                                                            $t=explode('e',$resultat[$i]->libelle)[1];
                                                                        @endphp
                                                                        Tranche{{ $t-1 }}
                                                                    @endif</td>
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
                                                                                                    $pen=1;
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
                                                                                                         $pen=1;
                                                                                                       @endphp
                                                                                                       @else
                                                                                                       {{  $k=($resultat[$i]->penalite * $compteur) }} FCFA
                                                                                                       @php
                                                                                                          $penalite=$penalite + $k;
                                                                                                          $pen=1;
                                                                                                       @endphp
                                                                                                       @endif

                                                                                           @endif

                                                                                   @else
                                                                                   0 FCFA

                                                                            @endif
                                                                        </td>
                                                                        @if ($pen<=0)
                                                                            <td><input type="checkbox" name="payer{{ $i }}" id="" value="{{ $paiement[$a]->id }}" disabled></td>
                                                                            @else
                                                                           <td><input type="checkbox" name="payer{{ $i }}" id="" value="{{ $paiement[$a]->id }}" disabled></td>
                                                                        @endif
                                                                        </tr>
                                                              @endif
                                                            @endif


                                                            @endfor



                                                        @endfor


                                                    </tbody>
                                                    <tr>
                                                        <input type="hidden" name="nbre" value="{{ sizeOf($resultat) }}">
                                                        <td><input type="submit" value="payer" class="btn btn-success btn-sm"></td>
                                                    </tr>
                                                </table>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                    </div>

                    @if ($penalite==0)
                    <h1 class="btn btn-success btn-sm right">Pas de pénalités</h1>
                    @else
                    <h1 class="btn btn-success btn-sm right">statut de pénalités : {{ $penalite }} FCFA</h1>
                    @endif

                    <div class="row text-center" style="float: right">
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>





    </div>
    </div>


    </body>

    </html>
