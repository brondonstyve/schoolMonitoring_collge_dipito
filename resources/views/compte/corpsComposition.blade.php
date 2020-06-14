@if ($compo)


<h3 class="centre">evaluation de {{ $evaluation[0]->matiere }} pour
    @switch($evaluation[0]->libelle)
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
</h3>


                    <input type="hidden" name="jbh" id="compteur" value="{{ $temps_restant*60 }}">

                    <table class="table m-0 table-colored-bordered table-bordered-success">
                            <thead>
                                <tr class="btn-sm">
                                    <th style="color: white">Temps donné:</th>
                                    <th style="color: white">Temps restant(min)</th>
                                    <th style="color: white">CHRONO(sec)</th>
                                    <th style="color: white"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $evaluation[0]->dure }} minutes</td>
                                    <td>{{ $temps_restant }} minutes</td>
                                    <td><span  id="time" style="display: inline-block"></span> secondes</td>
                                    <td><img src="images/horloge.png" class="mdi mdi-account-circle"></td>
                                </tr>
                            </tbody>
                     </table>




<br>
    <!-- Column -->
    <div class="col-lg-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-box">
                    <iframe src="storage/epreuve/{{ $evaluation[0]->fichier }}" frameborder="0" class="table m-0 " width="490"
                        height="500">
                        alt: <a href="storage/epreuve/{{ $evaluation[0]->fichier }}">Cliquer ici</a>
                    </iframe>

                </div>
            </div>
        </div>
</div>




<div class="col-md-12">
        <h3 class="font-light" id="time"> Réponses</h3>
    <div class="card-box">
        <div class="table-responsive">
            <form action="{{ route('compose_path') }}" method="post">
                {{ csrf_field() }}
                <table class="table m-0 table-colored-bordered table-bordered-success">
                    <thead>
                        <tr class="btn-sm">
                            <th style="color: white">Numéro</th>
                            <th style="color: white">Réponse</th>
                            <th style="color: white">Numéro</th>
                            <th style="color: white">Réponse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                    </tbody>
                    <tr>
                        <td colspan="4" class="centre">
                            <input type="hidden" name="nbre_rep" value="{{ encrypt($nbre_k) }}">
                            <input type="hidden" name="sek" value="{{ encrypt( $evaluation[0]->libelle) }}">
                            <input type="hidden" name="evaluation" value="{{ encrypt($evaluation[0]->evaluation_id) }}">
                            <input type="submit" id="button" value="Soumettre" class="btn btn-sm btn-success">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

</div>
@else

<div class="col-md-10">
        <h3 class="centre">résultat de l'évaluation de {{ $matiere }} pour :
            @switch($libelle)
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
        </h3>
        <!-- Column -->
    <div class="card-box">
        <div class="table-responsive">
            <table class="@if($note<10) table-colored-bordered table-bordered-danger @else table m-0 table-colored-bordered table-bordered-success @endif ">
                <thead>
                    <tr class="btn-sm">
                        <th style="color: white">Numéro</th>
                        <th style="color: white">Réponse</th>
                        <th style="color: white">statut</th>
                        <th style="color: white">Numéro</th>
                        <th style="color: white">Réponse</th>
                        <th style="color: white">statut</th>
                    </tr>
                </thead>
                <tbody>
                                @php
                                    $reponse_prof=explode('.',$rep_prof) ;
                                    $reponse_etud=explode('.',$rep_etud) ;
                                @endphp

                                @for ($i = 0; $i < sizeOf($reponse_prof)-1; $i++)
                                <tr class="">
                                    <td>{{ $i+1 }}</td>

                                    <td> {{ $reponse_etud[$i] }} </td>

                                    <td >
                                        @if ($reponse_etud[$i]==$reponse_prof[$i])
                                          <img src="images/icones/succes.png" alt="trouvé" style="max-width: 15px">
                                          @else
                                          <img src="images/icones/echec.png" alt="trouvé" style="max-width: 15px">
                                        @endif
                                    </td>

                                    @php $i=$i+2 @endphp
                                    <td >{{ $i }}</td>
                                    @php $i-- @endphp

                                    <td > {{ $reponse_etud[$i] }} </td>

                                    <td>
                                            @if ($reponse_etud[$i]==$reponse_prof[$i])
                                            <img src="images/icones/succes.png" alt="trouvé" style="max-width: 15px">
                                            @else
                                            <img src="images/icones/echec.png" alt="trouvé" style="max-width: 15px">
                                          @endif
                                    </td>
                                </tr>
                              @endfor
                              <thead>
                                    <tr >
                                            <td colspan="3" style="color: forestgreen">@if($compteur>1) réponses justes: @else réponse juste: @endif {{ $compteur }}</td>
                                            <td colspan="3" style="color: brown">@if((sizeOf($reponse_prof) - 1 - $compteur)>1) réponses fausses: @else réponse fausse: @endif  {{ sizeOf($reponse_prof) - 1 - $compteur }}</td>
                                    </tr>
                                    <tr>
                                            <td colspan="6" style="color: @if($note>=0) @if($note<=10) red @else @if($note<=12) blue  @else green @endif @endif @endif">total : {{ $note }} / 20</td>

                                    </tr>
                              </thead>
                </tbody>
            </table>
            <a href="{{ route('evaluation_path') }}" style="text-align: center">
                    <input type="button" value="OK" class="btn btn-sm btn-success">
                </a>

        </div>
    </div>

</div>
@endif


