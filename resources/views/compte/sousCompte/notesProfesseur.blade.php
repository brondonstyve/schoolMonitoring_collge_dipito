<div class="card-body">
    <h4 class="card-title">Mes salles de classes</h4>

            @for ($i =0 ; $i <sizeOf($classe) ; $i++)
            <div class="col-lg-3 col-md-6" style="color: black">
                    <div class="card" style="background-color: aliceblue">
                        <div class="card-body" >
                            <div class="row p-t-10 p-b-10">
            <a class="nav-link  active btn-sm">
                 Fiche {{ $i+1 }} : {{ $classe[$i]->classe }}
                 <hr>
                 <span>{{ $classe[$i]->nom }}</span>
                 <form action="{{ route('remplir_note_path') }}" method="post">
                    {{ csrf_field() }}
                     <input type="hidden" name="classe" value="{{ $classe[$i]->classe }}">
                     <input type="hidden" name="id" value="{{ $classe[$i]->id }}">
                     <input type="hidden" name="matiiere" value="{{ $classe[$i]->nom }}">
                        <input type="submit" value="Liste des élèves" class="btn-sm">
                </form>
            </a>
    </div>
</div>
</div>
</div>
            @endfor

@if (!$ouverture)
<h4 class="card-title">...</h4>

@else

   @if (sizeOf($liste)==0)
      <h3 class="card-title">Aucun élève dans cette salle de classe! </h3>
   @else
   <div class="card-body" >
        <div style="color: black">
        <div id="visitor" >

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des séquences</h4>
                        <ul class="nav nav-pills m-t-30 m-b-30" style="margin-top: -10px">

                            @php
                                $cc=0;
                                $sequence=0;
                                $parcoureur=0;
                                $trimestre=0;
                            @endphp
                            @for ($i = 0; $i < $sekuence[0]->nbsequence; $i++)
                            <li class="nav-item">

                                    @if($parcoureur<2)
                                      <a class="nav-link  @if($i+1==$sek) active @endif " href=" {{ route('inserer_noteSek_path')}}?sek={{ $i+1 }}&classe={{ $liste[0]->classe}}&id={{ $id}}&matiiere={{ $matiiere}}" role="tab" title="">
                                             CC {{ ++$cc }}
                                      </a>
                                    @php
                                            $parcoureur=$parcoureur+1;
                                        @endphp

                                     @else
                                      <a class="nav-link  @if($i+1==$sek) active @endif " href=" {{ route('inserer_noteSek_path')}}?sek={{ $i+1 }}&classe={{ $liste[0]->classe}}&id={{ $id}}&matiiere={{ $matiiere}}" role="tab" title="">
                                        Séquence {{ ++$sequence }}
                                      </a>
                                      @php
                                         $parcoureur=$parcoureur+1;
                                     @endphp

                                     @if ($parcoureur==4)
                                      @php
                                      $parcoureur=0;
                                     @endphp

                                     @endif



                                    @endif

                            </li>
                            @endfor



                        </ul>

                    <hr>
                    <div class="tab-content br-n pn">

                    <div id="sek" class="tab-pane active">

                                <div class="row">

                                    <div class="table-responsive m-t-20">
                                        <form action="{{ route('inserer_note_path') }}" method="post" style="margin-left: 2%;margin-right: 2%;">
                                            {{ csrf_field() }}
                                                <h3 class="card-title">notes des élèves de la {{ $liste[0]->classe}} en {{ $matiiere }}
                                                    @switch($sek)
                                                        @case(1)
                                                          CC 1
                                                            @break
                                                        @case(2)
                                                            CC 2
                                                            @break
                                                            @case(3)
                                                          Séquence 1
                                                            @break
                                                        @case(4)
                                                            Séquence 2
                                                            @break
                                                            @case(5)
                                                          CC 3
                                                            @break
                                                        @case(6)
                                                            CC 4
                                                            @break
                                                            @case(7)
                                                            Séquence 3
                                                            @break
                                                        @case(8)
                                                            Séquence 4
                                                            @break
                                                            @case(9)
                                                          CC 5
                                                            @break
                                                        @case(10)
                                                            CC 6
                                                            @break
                                                            @case(11)
                                                          Séquence 5
                                                            @break
                                                        @case(12)
                                                            Séquence 6
                                                            @break
                                                        @default

                                                    @endswitch
                                                </h3>
                                            <table class="table stylish-table" >
                                                <thead>
                                                        <tr>
                                                            <th>Numéro</th>
                                                            <th>Nom</th>
                                                            <th>Prenom</th>
                                                            <th>Note / 20</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                    @php
                                                        $spacer='';
                                                    @endphp
                                        @for ($i = 0; $i < sizeOf($liste); $i++)
                                             <tr class="">

                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ $liste[$i]->nom }}</td>
                                                    <td>{{ $liste[$i]->prenom }}</td>
                                                    <td><input type="number" name="note{{ $i }}" min="0" max="20" step="0.01"
                                                    value="@for($r = 0; $r < sizeOf($remplisseur); $r++)@if($remplisseur[$r]->compte==$liste[$i]->id){{$remplisseur[$r]->note }}@endif{{ $spacer }}@endfor">
                                                    </td>


                                                    <input type="hidden" name="sek{{ $i }}" value="{{ $sek }}">
                                                    <input type="hidden" name="id_matiere{{ $i }}" value="{{ $id }}">
                                                    <input type="hidden" name="id_compte{{ $i }}" value="{{ $liste[$i]->id }}">

                                                </tr>

                                        @endfor


                                      </tbody>
                                      </table>
                                     <input type="hidden" name="compteur" value="{{ sizeOf($liste) }}">
                                      <input type="submit" value="Soumettre">
                                      </form>
                                   </div>
                                </div>

                        </div>


                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
   @endif
   @endif

