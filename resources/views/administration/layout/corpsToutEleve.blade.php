<div class="row">
    <div class="col-sm-12">
        <div class="card-box">




            @foreach ($classe as $item)

            <div class="table-responsive" style="page-break-after:always;" >
            <h4 class="m-t-0 header-title text-center"  id="title"><b id="b">Liste des élèves de la {{ $item->nom_classe }}</b></h4>

                <table class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableetudiants">

                    <thead id="entete">
                        <tr>
                            <th>Numéro</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>sexe</th>
                            <th>Date de naissance</th>
                        </tr>
                    </thead>
                    <tbody id="corps">

                        @php
                        $verif=false;
                        $compt=0;
                        @endphp
                        @for ($i =0 ; $i < sizeOf($reponse) ; $i++)
                         @if ($reponse[$i]->classe==$item->nom_classe)
                            <tr id="">
                                <td tabindex="1">{{ $i }}</td>
                                <td tabindex="1">{{ $reponse[$i]->matricule }}</td>
                                <td tabindex="1">{{ $reponse[$i]->nom }}</td>
                                <td tabindex="1">{{ $reponse[$i]->prenom }}</td>
                                <td tabindex="1">{{ $reponse[$i]->sexe}}</td>
                                <td tabindex="1">{{ $reponse[$i]->naissance }}</td>

                            </tr>
                            @php
                            $verif=true;
                            $compt=$compt+1;
                            @endphp
                            @endif
                            @endfor
                            @if (!$verif)
                            <tr>
                                <td colspan="6" class="text-center alert-danger">

                                    <h4 class="m-t-0 header-title" id="title"><b id="b">Aucun élève dans cette salle de classe</b></h4>
                                </td>
                            </tr>
                            @endif

                    </tbody>
                </table>
                <br><br>
                <code> {{ $compt }} élève(s)</code>
                <br>
                @php
                    $test=false;
                @endphp
                @foreach ($titulaire as $titu)
                    @if ($titu->classe==$item->id)
                        <code>TITULAIRE : {{ $titu->nom.' '.$titu->prenom }}</code>
                        @php
                            $test=true;
                        @endphp
                    @endif
                @endforeach

                @if (!$test)
                <code>TITULAIRE : Pas de titulaire</code>
                @endif

            </div>
            @endforeach



        </div>
        <input type="button" class="btn btn-success  ne_pas_imprimer" style="float: right" button value="imprimer" onclick="window.print()">

    </div>
</div>
