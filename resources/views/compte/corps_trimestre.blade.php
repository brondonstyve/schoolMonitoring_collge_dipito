                    @php
                      $moy_gen=0;
                      $moy_ancienne=21;
                  @endphp

                    @foreach ($etudiant as $eleve)
                            @php
                                $moy=0;
                                $i=0;
                                $coef=0;
                            @endphp


                        @foreach ($matiere as $mat)
                                @php
                                    $tab=array();
                                @endphp




@php
$a_compose=false
@endphp
@foreach ($cc1 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif



@php
$a_compose=false
@endphp
@foreach ($cc2 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif




@php
$a_compose=false
@endphp
@foreach ($sequence1 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif


@php
$a_compose=false
@endphp
@foreach ($sequence2 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif


                             @php
                                  $note1=($tab[0]*0.2)+($tab[2]*0.8);
                                  $note2=($tab[1]*0.2)+($tab[3]*0.8);
                                  $moy=((($note1+$note2)/2)*$mat->coef)+$moy;
                                  $coef=$coef+$mat->coef;
                             @endphp
                    @endforeach

                    @php
                        $moy=$moy/$coef;
                        $tableau[$eleve->id]=$moy;
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


                    @foreach ($tableau_classeur as $key => $item)
                    @foreach ($etudiant as $eleve)
                    @if ($eleve->id==$item)
                                @php
                                    $coef=0;
                                    $total=0;
                                    $total_coef=0;
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
                                                            <i> séquence - Année 2019/2020 </i>

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
                                                                <strong>{{ $eleve->nom }}</strong><br>
                                                                <img src="images/localisation.png" alt="logo" class="img-size-50 mr-3"
                                                                width="20px">
                                                                @php
                                                                    $date=new Date($eleve->naissance);
                                                                @endphp
                                                                <strong>{{ $date->format('d M Y') }} {{ $eleve->ville }}</strong><br>
                                                                <img src="images/admin/contact.png" alt="logo" class="img-size-50 mr-3"
                                                                width="20px">
                                                                <strong>{{ $eleve->numero }} </strong><br>

                                                        </td>
                                                        <td>
                                                            <strong>{{ $eleve->prenom }} </strong><br>
                                                            <strong>{{ $eleve->numero }}</strong><br>
                                                                                <strong>{{ $eleve->email}}</strong><br>
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
                                                            @php
                                                                $sequence=explode('e',$libelle)[2];
                                                            @endphp
                                                            @switch($sequence)
                                                                @case(1)
                                                                <th>Séquence 1</th>
                                                                <th>Séquence 2</th>
                                                                @break
                                                                @case(2)
                                                                <th>Séquence 3</th>
                                                                <th>Séquence 4</th>
                                                                @break
                                                                @case(3)
                                                                <th>Séquence 5</th>
                                                                <th>Séquence 6</th>
                                                                @break
                                                                @default

                                                            @endswitch
                                                        <th>note</th>
                                                        <th>Coef</th>
                                                        <th>Total</th>
                                                        <th>Appréciation</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($matiere as $mat)
                                                    @php
                                                        $tab=array();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $mat->nom }}</td>
                                                        <td>{{ $mat->nom_prof.' '.$mat->prenom }}</td>



                                                        @php
$a_compose=false
@endphp
@foreach ($cc1 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif



@php
$a_compose=false
@endphp
@foreach ($cc2 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif




@php
$a_compose=false
@endphp
@foreach ($sequence1 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif


@php
$a_compose=false
@endphp
@foreach ($sequence2 as $controle1)
@if ($controle1->compte==$eleve->id)
@if ($mat->id==$controle1->id_mat)
    @php
        $tab[]=$controle1->note;
        $a_compose=true;
        break;
    @endphp
@endif
@endif
@endforeach
@if (!$a_compose)
@php
$tab[]=0;
@endphp
@endif


                                                        <td>{{ $note1=($tab[0]*0.2)+($tab[2]*0.8) }}</td>
                                                        <td>{{ $note2=($tab[1]*0.2)+($tab[3]*0.8) }}</td>
                                                        @php
                                                            $coef=$coef+$mat->coef;
                                                            $total=$total+(($note1+$note2)/2);
                                                            $total_coef=($total* $mat->coef)+$total_coef;
                                                        @endphp
                                                        <td>{{ (($note1+$note2)/2) }}</td>
                                                        <td>{{ $mat->coef }}</td>
                                                        <td>{{ $total* $mat->coef }}</td>


                                                        <td>

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
                                                        </td>
                                                    </tr>

                                                    @endforeach

                                                    <tr>

                                                        <td></td>
                                                        <td class="text-right">Total</td>
                                                        <td colspan="2" class="text-right"></td>
                                                        <td>{{ $total }}</td>
                                                        <td>{{ $coef }}</td>
                                                        <td>{{ $total_coef }}</td>
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
                                            <textarea name="" placeholder="Rien à Signaler"  class="form-control" style="min-height: 50%"></textarea>

                                            <table>
                                                <tr>
                                                    <th>Heure d'absence</th>
                                                    <th>
                                                        @foreach ($absence as $abs)
                                                            @if ($eleve->id==$abs->matricule)
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
                                                            <td>{{ number_format($moy=$total_coef/$coef,'2',',','') }} / 20</td>
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
                    @endforeach
                    @endforeach

            <div class="text-right ne_pas_imprimer">
                <button type="button" class="btn btn-success" id="imprimer_tout" onclick="window.print()">Imprimer tous les bulletins</button>
              </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
