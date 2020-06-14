@if (sizeOf($note)<=0)
<h2 class="card-title">Aucune note n'est disponible pour le moment</h2>
@else


<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Liste des séquences</h4>
            <ul class="nav nav-pills m-t-30 m-b-30" style="margin-top: -10px">
                @for ($i = 0; $i < $sekuence[0]->nbsequence; $i++)
                @php
                $cc=0;
                $sequence=0;
                $parcoureur=0;
                $trimestre=0;
            @endphp
            @for ($i = 0; $i < $sekuence[0]->nbsequence; $i++)
            <li class="nav-item">

                    @if($parcoureur<2)
                    <a class="nav-link  @if($i+1==$sek) active @endif " href=" {{ route('mesNotes_path')}}?sek={{ $i+1 }}" role="tab" title="">
                         CC {{ ++$cc }}
                      </a>
                    @php
                            $parcoureur=$parcoureur+1;
                        @endphp

                     @else
                    <a class="nav-link  @if($i+1==$sek) active @endif " href=" {{ route('mesNotes_path')}}?sek={{ $i+1 }}" role="tab" title="">
                        Séquence {{ ++$sequence }}
                      </a>
                      @php
                         $parcoureur=$parcoureur+1;
                     @endphp

                     @if ($parcoureur==4)
                     <li class="nav-item">
                      <a class="nav-link btn btn-default" href="" title="" >
                        Trimestre {{ ++ $trimestre }}
                      </a>
                    </li>
                      @php
                      $parcoureur=0;
                     @endphp

                     @endif



                    @endif

            </li>
            @endfor
                @endfor
            </ul>







@php
        $credit=0;
        $coef_total=0;

@endphp


@for ($g = 0; $g < sizeOf($groupe); $g++)
@php
        $noteg=array();
        $nb=0;
 @endphp


<div class="col-md-12">
<h2 class="card-title">Groupe {{ $g+1 }} :{{ $groupe[$g]->nom }}</h2>

@for ($i =0 ; $i <sizeOf($note) ; $i++)

@if ($groupe[$g]->id==$note[$i]->groupe)

@php
    $coef_total=$coef_total+$note[$i]->coef;
@endphp

<div class="col-lg-3 col-md-6">

        <div class="card">
            <div class="card-body">
                <div class="text-left">
                    <span class="text-muted">{{ $note[$i]->nom }}</span>
                </div>
                <div class="text-right">
                  Coéficient : <span class="text-muted">{{ $note[$i]->coef }}</span>
                </div>

                <h5 class="">Note : <span style="color:@if ($note[$i]->note<5) red @else @if ($note[$i]->note<12) blue @else green @endif @endif ;float: right" >{{  $note[$i]->note }}/20</span> </h5>
                         @php
                             $comptNote=0;
                             $comptCoef=0;
                             $final=($note[$i]->note*$note[$i]->coef)
                         @endphp
                    <h5 class="">Note finale : <span style="color:@if ($final<5) red @else @if ($final<12) blue @else green  @endif @endif ;float: right" >{{ $final }}/{{ 20*$note[$i]->coef }}</h5>

                <span class="text-success"> {{ (( $note[$i]->note )/20)*100 }}%  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if ($note[$i]->note<5) danger @else @if ($note[$i]->note<10) Mauvais @else  @if ($note[$i]->note<=12)moyen @else bon @endif @endif @endif </span>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ (($note[$i]->note)/20)*100 }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
</div>
    @php
        $noteg[$nb][0]=$note[$i]->nom;
        $noteg[$nb][1]=$note[$i]->coef;
        $noteg[$nb][2]=$final;
        $nb ++;
    @endphp
@endif

@endfor





</div>
@endfor

</div>
</div>
</div>





@php
    $tot=0;
@endphp


            <div class="col-md-10">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Bulletin instantané de pour

                            @switch($sek)
                                                        @case(1)
                                                          le CC 1
                                                            @break
                                                        @case(2)
                                                           le CC 2
                                                            @break
                                                            @case(3)
                                                            la Séquence 1
                                                            @break
                                                        @case(4)
                                                        la Séquence 2
                                                            @break
                                                            @case(5)
                                                            le CC 3
                                                            @break
                                                        @case(6)
                                                        le CC 4
                                                            @break
                                                            @case(7)
                                                            la  Séquence 3
                                                            @break
                                                        @case(8)
                                                          la  Séquence 4
                                                            @break
                                                            @case(9)
                                                            le CC 5
                                                            @break
                                                        @case(10)
                                                        le CC 6
                                                            @break
                                                            @case(11)
                                                          Séquence 5
                                                            @break
                                                        @case(12)
                                                            Séquence 6
                                                            @break
                                                        @default

                                                    @endswitch

                        </b></h4>

                        <div class="table-responsive">
                            <table class="table m-0 table-colored-full table-full-inverse table-hover btn-sm" style="color: white">
                                <thead>
                                <tr>
                                        <th>matière</th>
                                        <th>Note(/20)</th>
                                        <th>Coeficient</th>
                                        <th>total</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @for ($i =0 ; $i <sizeOf($classeE) ; $i++)
                                          <tr>
                                                <td>{{ $classeE[$i]->nom }}</td>
                                                <td>@for ($n = 0; $n < sizeOf($note); $n++)
                                                    @php
                                                        $bare=false;
                                                    @endphp
                                                      @if ($note[$n]->id==$classeE[$i]->id && $note[$n]->sequence==$sek)
                                                         {{ $note[$n]->note }}
                                                         @break
                                                         @else
                                                         @php
                                                             $bare=true;
                                                         @endphp
                                                      @endif
                                                    @endfor
                                                    @if ($bare)
                                                      /
                                                    @endif
                                                </td>

                                                <td>{{ $classeE[$i]->coef }}</td>
                                                <td>
                                                    @if ($n>=sizeOf($note))
                                                        /
                                                    @else
                                                       {{ $note[$n]->note*$classeE[$i]->coef }}
                                                    @endif

                                                </td>
                                          </tr>
                                          @php
                                          if ($n>=sizeOf($note)) {
                                            $comptNote= $comptNote + 0;
                                          } else {
                                            $comptNote= $comptNote + $note[$n]->note*$classeE[$i]->coef;
                                          }

                                           $comptCoef=$comptCoef+$classeE[$i]->coef;
                                          @endphp
                                        @endfor

                                        <tr>
                                                <td class="text-right"></td>
                                                <td class="text-right">total coéficient</td>
                                                <td > <span>{{ $comptCoef }}</span> <span style="float: right">Total de points</span></td>
                                                <td>{{ $comptNote }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" style="text-align: right;">Moyenne</td>
                                            <td style="background-color: white"> <span style="color:@if ($comptNote/$comptCoef<10) red @else green @endif " >{{ number_format($comptNote/$comptCoef,2,',','') }}</span> </td>

                                        </tr>

                                        <tr>
                                            <td colspan="3" style="text-align: right;">décision du conseil</td>
                                            <td style="background-color: white;text-transform: uppercase"> <span style="color:@if ($comptNote/$comptCoef<10) red @else green @endif " >@if ($comptNote/$comptCoef<10) échec @else admis @endif </span> </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

@endif
