@if (sizeOf($resultatprof)==0)
<h1 class="centre">Vous n'êtes pas encore programmé</h1>
@else


<div class="card-body">
        <a href="#" class="register col-lg-12 modal-content fileupload bouton b1 btn-rounded waves-effect carousel-inner" class="btn-info" href=""
        style="font-size: 15px;color: #002b46">Mon Emploi de temps
    </a>
    <br>
    <div class="table-responsive " style="margin-top: -20px;">
        <table class="btn btn-sm " style="font-size: 15px;color: black;text-align: left; ">
            <tr class="btn-info">
                <th>HORAIRES</th>
                @for ($i = 0; $i < sizeOf($configedt); $i++)
                <th>
                    {{ $configedt[$i]->hd.' à '.$configedt[$i]->hf }}
                </th>
                @endfor
            </tr>
            @php
            $jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
            @endphp


            @for ($j =0 ; $j <sizeOf($jour) ; $j++)
            <tr>
                    <td>{{ $jour[$j] }}</td>

                    @for ($conf =0 ; $conf <sizeOf($configedt) ; $conf++)
                       @if ($configedt[$conf]->libelle=='pause')
                        <td style="background-color: gray"> PAUSE</td>
                       @else
                    <td>
                        @for ($i =0 ; $i <sizeOf($resultatprof) ; $i++)

                              @if ('tranche'.$resultatprof[$i]->tranche==$configedt[$conf]->tranche && $resultatprof[$i]->jour==$jour[$j])
                                    {{ $resultatprof[$i]->matiere }}
                                    <br>
                                    <p class="register btn btn-sm btn-reverse">{{ $resultatprof[$i]->classe }}</p>
                                    <br>
                                    @for ($p = 0; $p < sizeOf($mati); $p++)
                                       @if ($resultatprof[$i]->classe==$mati[$p]->classe && $resultatprof[$i]->matiere==$mati[$p]->nom)
                                       @if ($mati[$p]->nombre_heure <= 0)
                                       <code>Cour terminé</code>
                                       @else
                                       <code>{{ $mati[$p]->nombre_heure }} H-R</code>
                                       @endif

                                       @break
                                       @endif
                                    @endfor



                              @endif

                        @endfor
                    </td>
                    @endif
                    @endfor
              </tr>
            @endfor



        </table>
    </div>
</div>
@endif
