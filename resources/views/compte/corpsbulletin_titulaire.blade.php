
<div class="wrapper">



    <section class="content">
        <div class="container-fluid">
            <div class="">

                  <!-- Chargement des données dans le tableau -->
                  @php
                      $moy_gen=0;
                      $moy_ancienne=21;
                  @endphp
                    @foreach ($etudiant as $etud)
                    @php
                        $moy=0;
                        $i=0;
                    @endphp
                    @foreach ($note as $not)

                        @if ($not->id==$etud->id)
                        @php
                          $moy=$moy+$not->note*$not->coef;
                        @endphp
                        @endif

                    @endforeach
                    @php
                        $moy=$moy/$coef;
                        $tableau[$etud->id]=$moy;
                        $moy_gen=$moy+$moy_gen;
                    @endphp
                    @endforeach

                    @php
                        arsort($tableau);
                    @endphp

                    @foreach ($tableau as $key => $item)
                        @php
                            $tableau_classeur[]=$key;
                        @endphp
                    @endforeach


                    <!-- Main content -->
                    @foreach ($tableau_classeur as $key => $item)
                    @for ($i = 0; $i < sizeOf($etudiant); $i++)
                    @if ($etudiant[$i]->id==$item)

                            @php
                                $moy=0;
                                $nb_mat=0;
                                $total=0;
                                $testeur=0;
                            @endphp
                            <div class="invoice p-3 mb-3" style="page-break-after:always;" id="i{{ $key }}">


                                <div class="row">

                                    <div class="col-12 table-responsive">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>
                                                        <strong>REPUBLIQUE DU CAMEROUN</strong><br>
                                                        <i>Paix-travail-patrie</i><br>
                                                        <strong>MINISTERE DES ENSEIGNEMENTS SECONDAIRES</strong>

                                                    </td>

                                                    <td>
                                                        <img src="./images/IMG-20191109-WA0000.jpg" alt="logo"
                                                            class="img-circle" width="75px"><br>
                                                        <h5>BULLETIN DE NOTES</h5>
                                                        <i>{{ $sek }} séquence - Année 2019/2020 </i>

                                                    </td>


                                                    <td>
                                                        <strong>MINISTERE DES ENSEIGNEMENTS SECONDAIRES <br> </strong>
                                                        <strong>LYCEE DE YAOUNDE</strong><br>
                                                        <i>Tel:690322179/6788054321</i>

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        <img src="images/profilDef.jpg" alt="logo" class="img-size-50 mr-3"
                                                            width="20px">
                                                            <strong>{{ $etudiant[$i]->nom }}</strong><br>
                                                            @php
                                                                $date=new Date($etudiant[$i]->naissance);
                                                            @endphp
                                                            <img src="images/localisation.png" alt="logo" class="img-size-50 mr-3"
                                                            width="20px">
                                                            <strong>{{ $date->format('d M Y') }} {{ $etudiant[$i]->ville }}</strong><br>
                                                            <img src="images/admin/contact.png" alt="logo" class="img-size-50 mr-3"
                                                            width="20px">
                                                            <strong>{{ $etudiant[$i]->numero }}</strong><br>

                                                    </td>
                                                    <td>
                                                        <strong>{{ $etudiant[$i]->prenom }}</strong><br>
                                                        <strong>{{ $etudiant[$i]->numero }}</strong><br>
                                                        <strong>{{ $etudiant[$i]->email}}</strong><br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Matière</th>
                                                    <th>Enseignant</th>
                                                    <th>Coef</th>
                                                    <th>Note</th>
                                                    <th>Total</th>
                                                    <th>Appréciation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($matiere as $element)
                                                @php
                                                    $nb_mat=1;
                                                @endphp
                                                <tr>
                                                    <td>{{ $element->nom }}</td>
                                                    <td>{{ $element->nom_prof.' '.$element->prenom }}</td>
                                                    <td>{{ $element->coef }}</td>
                                                    @foreach ($note as $not)
                                                        @if ($not->compte==$etudiant[$i]->id)
                                                        @if ($not->id_mat==$element->id)
                                                                <td>{{ $total=$not->note }}</td>
                                                                <td>{{ $not->note*$element->coef }}</td>
                                                                @php
                                                                $moy=$moy+$total*$element->coef;
                                                                @endphp
                                                                @php
                                                                    $testeur=1;
                                                                @endphp
                                                        @endif

                                                        @endif
                                                    @endforeach
                                                    @if ($testeur==0)
                                                    <td>/</td>
                                                    <td>/</td>
                                                    @endif


                                                    <td>

                                                        @if ($testeur==0)
                                                        /
                                                        @else
                                                        @if ($total<10)
                                                        Faible
                                                    @else
                                                    @if ($total<12)
                                                    Passable
                                                @else
                                                @if ($total<=14)
                                                Assez bien
                                            @else
                                            @if ($total<=16)
                                            Bien
                                        @else
                                        @if ($total<=19)
                                                        Tres Bien
                                                    @else
                                                    @if ($total==20)
                                                    Parfait
                                                @else
                                                @endif
                                                    @endif

                                        @endif
                                            @endif
                                                @endif
                                                    @endif
                                                        @endif

                                                    </td>
                                                </tr>

                                                @endforeach
                                                <tr>
                                                    <td colspan="2" class="text-right">Total coeficient</td>
                                                    <td>{{ $coef }}</td>
                                                    <td class="text-right">Total note</td>
                                                    <td>{{ $moy }}</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row" style="min-height: 270px; max-height: 270px">
                                    <!-- accepted payments column -->
                                    <div class="col-6 form-group" style="min-height: 270px">
                                        <p class="lead">Mot du titulaire</p>
                                        <textarea name="" placeholder="Rien à Signaler"  class="form-control" style="min-height: 65%"></textarea>

                                        <table>
                                            <tr>
                                                <th>Heure d'absence</th>
                                                <th>
                                                    @foreach ($absence as $abs)
                                                        @if ($etudiant[$i]->id==$abs->matricule)
                                                            {{ $abs->absence }}
                                                        @endif
                                                    @endforeach
                                                </th>
                                            </tr>
                                        </table>

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6" style="min-height: 270px; max-height: 270px">
                                        <p class="lead">Récapitulatif</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>

                                                    <tr>
                                                        <th style="width:50%">Moyenne générale de la classe:</th>
                                                        <td>{{ number_format($moy_gen/sizeOf($etudiant),'2',',','') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Moyenne</th>
                                                        <td>{{ number_format($moy=$moy/$coef,'2',',','') }} / 20</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rang:</th>
                                                        <td>
                                                            @if ($moy_ancienne==$moy)
                                                            {{ $key }} <sup>exc</sup> / {{ sizeOf($etudiant) }}
                                                            @else
                                                            {{ $key+1 .'/'. sizeOf($etudiant) }}
                                                            @endif
                                                            @php
                                                                $moy_ancienne=$moy
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Appreciation:</th>
                                                        <td>@if ($moy<10)
                                                            Faible
                                                        @else
                                                        @if ($moy<12)
                                                        Passable
                                                    @else
                                                    @if ($moy<14)
                                                    Assez bien
                                                @else
                                                @if ($moy<16)
                                                Bien
                                            @else
                                            @if ($moy<19)
                                                            Tres Bien
                                                        @else
                                                        Parfait
                                                        @endif

                                            @endif
                                                @endif
                                                    @endif
                                                        @endif</td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Décision :
                                                        </th>
                                                        <td>
                                                            @if ($moy<10)
                                                                Echoué
                                                            @else
                                                                Admis
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="text-center ne_pas_imprimer">
                                <button type="button" class="btn btn-success" onclick="imprimer('i{{ $key }}')">Imprimer le bulletin de {{ $etudiant[$i]->nom.' '.$etudiant[$i]->prenom }}</button>
                            </div>
                            <hr>
                    @endif

                    @endfor



                    @endforeach





                    <!-- /.invoice -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="text-right ne_pas_imprimer">
                <button type="button" class="btn btn-success" id="imprimer_tout" onclick="window.print()">Imprimer tous les bulletins</button>
              </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
