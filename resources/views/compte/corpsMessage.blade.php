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
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card blog-widget card-size1 color-md1">
                <div class="card-body">
                    <div class="blog-image"><img src="images/img1.jpg" alt="img" class="img-responsive"></div>
                    <h3 class="@if ($total - $reste ==0) btn btn-sm btn-success @else btn btn-sm btn-danger @endif" >Statut Pension : @if ($total - $reste ==0) Solvable @else Non solvable @endif</h3>
                    <br>
                        <p class="btn btn-sm btn-success"><span>{{ $utilisateur->matricule }}</span></p>
                        <br>
                        <p class="btn btn-sm btn-success"><span>Classe: {{ $utilisateur->classe }}</span></p>
                    </span>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card card-size2 color-md3">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h3 class="card-title">Total a payer</h3>
                            <h3 class="card-subtitle">
                                {{ $total }} FCFA
                            </h3>
                        </div>
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
