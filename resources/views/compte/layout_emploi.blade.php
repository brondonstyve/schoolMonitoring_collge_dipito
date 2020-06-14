@if (sizeOf($resultat)==0)
<h1 class="centre">
    @if($utilisateur->type=='superadmin' || $utilisateur->type=='admin')
     Cette salle ne possède pas encore d'emploi de temps
    @else
    Vous n'êtes pas encore programmé
    @endif

</h1>
@else


<div class="card-body">
        <a href="#" class="register col-lg-12 modal-content fileupload bouton b1 btn-rounded waves-effect carousel-inner"
        style="font-size: 15px;color: #002b46">
        <span style="float: left;"> Emploi de temps delivré le {{ $resultat[0]->created_at }}
    </a>
    <br>
    <div class="table-responsive " style="margin-top: -20px;">
        <table class="table table-striped m-b-10 centre btn btn-sm" style="font-size: 15px;color: black;text-align: left; ">
            <thead class="btn-info">
                <th>HORAIRES</th>
                @for ($i = 0; $i < sizeOf($configedt); $i++)
                <th>
                    {{ $configedt[$i]->hd.' à '.$configedt[$i]->hf }}
                </th>
                @endfor
            </thead>
            @php
            $jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
            @endphp


            <tbody>
                    @for ($j =0 ; $j <sizeOf($jour) ; $j++)
                    <tr>
                            <td>{{ $jour[$j] }}</td>

                            @for ($conf =0 ; $conf <sizeOf($configedt) ; $conf++)
                            @if ($configedt[$conf]->libelle=='pause')
                            <td style="background-color: gray"> PAUSE</td>
                            @else
                            <td>
                                    @for ($i =0 ; $i <sizeOf($resultat) ; $i++)

                                          @if ('tranche'.$resultat[$i]->tranche==$configedt[$conf]->tranche && $resultat[$i]->jour==$jour[$j])
                                                <i>{{ $resultat[$i]->matiere }}</i><br>
                                                 <p class="register btn btn-sm btn-reverse">M. {{ $resultat[$i]->nom }}</p>
                                                <br>
                                                @if ($periode[$i] <= 0)
                                                <code>Cours terminé</code>
                                                @else
                                                <code>{{ $periode[$i] }} H-R</code>
                                                @endif

                                          @endif

                                    @endfor
                                </td>
                            @endif

                            @endfor

                      </tr>
                    @endfor
            </tbody>




        </table>
    </div>
</div>
@endif
