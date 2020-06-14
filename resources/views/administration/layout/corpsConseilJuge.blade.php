<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                @if (sizeOf($reponse)==0)
                <h4 class="m-t-0 header-title" id="statutclasse"><b>Aucun conseils de discipline  jugés</b></h4>
                @else
                <h4 class="m-t-0 header-title" id="statutclasse"><b>Liste des conseils de discipline jugés</b></h4>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tablecd">
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Nom / Prénom</th>
                                <th>Classe</th>
                                <th>Motif</th>
                                <th>nom du juge</th>
                                <th>Decision</th>
                                <th>Sanction</th>
                            </tr>
                        </thead>
                        <tbody id="nouveau">
                            <!--Nouvelle insertion-->
                        </tbody>
                        <tbody id="tbody">
                            @for ($i =0 ; $i <sizeOf($reponse) ; $i++)
                            <tr id="{{ $reponse[$i]->id }}">
                                <td tabindex="1">{{ $reponse[$i]->matricule }}</td>
                                <td tabindex="1">{{ $reponse[$i]->nom_e.' '.$reponse[$i]->prenom_e }}</td>
                                <td tabindex="1">{{ $reponse[$i]->classe }}</td>
                                <td tabindex="1">{{ $reponse[$i]->motif }}</td>
                                <td tabindex="1">{{ $reponse[$i]->nom_juge }}</td>
                                @if ($reponse[$i]->coupable==1)
                                <td tabindex="1" class="badge-danger">Coupable</td>
                                <td tabindex="1" class="btn-info">{{ $reponse[$i]->sanction }}</td>
                                    @else
                                <td tabindex="1" class="badge-success">Nom coupable</td>
                                <td tabindex="1" class="btn-info">Pas de sanction</td>
                                @endif


                            </tr>
                            @endfor

                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="right" colspan="7">{{ $reponse->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
                @endif

            </div>
        </div>
    </div>
