<div class="row">
        <div class="col-sm-12">
            <div class="card-box">



                <div class="table-responsive" >
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableetudiants">

                        <thead id="entete">
                            <tr>
                                <th>Nom</th>
                                <th>prénom</th>
                                @for ($r = 0; $r < sizeOf($resultat); $r++)
                                 <th>
                                     @if ($resultat[$r]->libelle=='tranche1')
                                    Inscription
                                @else
                                    @php
                                        $t=explode('e',$resultat[$r]->libelle)[1];
                                    @endphp
                                    Tranche{{ $t-1 }}
                                @endif
                            </th>
                                @endfor
                                <th>pénalités</th>
                                <th>Situation</th>
                                <th>Manipulations</th>

                            </tr>
                        </thead>
                        <tbody id="corps">
                            @for ($l =0 ; $l <sizeOf($liste) ; $l++)
                                @php
                                $compter=0;
                                $compteur=0;
                                $penalite=0;
                                @endphp
                            <tr id="">
                                <td tabindex="1">{{ $liste[$l]->nom }}</td>
                                <td tabindex="1" >{{ $liste[$l]->prenom }}</td>
                                @for ($r = 0; $r < sizeOf($resultat); $r++)
                                    @for ($p = 0; $p < sizeOf($paiement); $p++)
                                    @php
                                        $testor=false;
                                    @endphp
                                        @if ($liste[$l]->matricule==$paiement[$p]->matricule)



                                            @if ($resultat[$r]->libelle==$paiement[$p]->libelle)
                                              <td tabindex="1"style="color: green" >Payé</td>

                                                                        @php
                                                                            $date1=new Date($paiement[$p]->date);
                                                                            $date2=new Date($resultat[$r]->date);
                                                                        @endphp

                                                                            @if($date1 > $date2)
                                                                                           @php
                                                                                               $date1=number_format((strtotime($date1)-strtotime($date2))/86400);
                                                                                           @endphp
                                                                                           @if ($date1<=6 && $date1>0 )
                                                                                               @php
                                                                                                    $penalite=$penalite + $resultat[$r]->penalite;
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
                                                                                                       @php
                                                                                                         $penalite=$penalite + ($resultat[$r]->penalite * $compteur) + $resultat[$r]->penalite;
                                                                                                       @endphp
                                                                                                       @else
                                                                                                       @php
                                                                                                          $penalite=$penalite + ($resultat[$r]->penalite * $compteur);
                                                                                                       @endphp
                                                                                                       @endif

                                                                                           @endif

                                                                                   @else

                                                                            @endif


                                                @break
                                                @php
                                                    $testor=true;
                                                @endphp

                                              @else

                                                    @for ($nbPay = 0; $nbPay < sizeOf($paiement); $nbPay++)
                                                        @if ($liste[$l]->matricule==$paiement[$nbPay]->matricule)
                                                            @php
                                                                 $compter=$compter+1;
                                                            @endphp
                                                        @endif

                                                    @endfor
                                                      @if(!$testor)

                                                        <td tabindex="1" style="color: brown">Impayé</td>
                                                        @php
                                                                            $date1=new Date();
                                                                            $date2=new Date($resultat[$r]->date);
                                                                        @endphp

                                                                            @if($date1 > $date2)
                                                                                           @php
                                                                                              $date1= number_format((strtotime($date1)-strtotime($date2))/86400);
                                                                                           @endphp
                                                                                           @if ($date1<=6 && $date1>0 )
                                                                                               @php
                                                                                                    $penalite=$penalite + $resultat[$r]->penalite ;
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
                                                                                                       @php
                                                                                                         $penalite=$penalite + ($resultat[$r]->penalite * $compteur) + $resultat[$r]->penalite;
                                                                                                       @endphp
                                                                                                       @else
                                                                                                       @php
                                                                                                          $penalite=$penalite + ($resultat[$r]->penalite * $compteur);
                                                                                                       @endphp
                                                                                                       @endif

                                                                                           @endif

                                                                                   @else

                                                                            @endif
                                                      @endif


                                            @endif





                                        @endif
                                    @endfor
                                @endfor
                                @php
                                    $compt=0;
                                @endphp
                                @for ($nbPay = 0; $nbPay < sizeOf($paiement); $nbPay++)
                                    @if ($liste[$l]->matricule==$paiement[$nbPay]->matricule)
                                         @php
                                            $compt=$compt+1;
                                         @endphp
                                    @endif

                                @endfor

                                @php
                                    $statue=true;
                                @endphp
                                @foreach ($moratoire as $morat)
                                    @if ($liste[$l]->id==$morat->matricule)
                                        <td style="color: rgb(19, 177, 79)">Moratoire</td>
                                         @break
                                    @else
                                    @php
                                        $statue=false;
                                    @endphp
                                @endif
                                @endforeach

                                @if (!$statue)
                                        @if ($penalite<=0)
                                        <td>{{ $penalite }} FCFA</td>
                                        @else
                                        <td style="color: brown">{{ $penalite }} FCFA</td>
                                        @endif
                                @endif



                                @if ($penalite<=0 && sizeOf($resultat)==$compt)
                                    <td><a><code class="btn btn-success btn-sm">étudiant solvable</code></a></td>
                                    @else
                                    <td><a><code class="btn btn-danger btn-sm">étudiant insolvable</code></a></td>
                                @endif
                                @if ($penalite>0)
                                        <td><a href="{{ route('payer_penalite_path') }}?filiere={{ $resultat[0]->filiere }}&niveau={{ $resultat[0]->niveau }}&mat={{ $liste[$l]->matricule }}&classe={{ $liste[$l]->classe }}">
                                        <code class="btn btn-success btn-sm">Payer les pénalités</code></a></td>
                                    @else
                                    <td><code>pas de pénalités</code></td>
                                @endif
                             </tr>
                            @endfor

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
