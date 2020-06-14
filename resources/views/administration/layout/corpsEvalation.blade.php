<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            @if (sizeOf($filiere)==0)
            <h4 class="m-t-0 header-title"><b>Aucune évaluation pour le moment</b></h4>
            @else


            <h4 class="m-t-0 header-title"><b>Valider, suspendre ou annuler les évaluations</b></h4>
            <a href="#" data-toggle="modal" class="btn btn-success right ">
                    <code  data-toggle="modal" data-target="#Ajout-filiere">Ajouter</code>
                </a>


            <div class="table-responsive">
                <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableevaluation">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>nom</th>
                            <th>classe</th>
                            <th>durée(min)</th>
                            <th>Manipulations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i =0 ; $i <sizeOf($filiere) ; $i++)
                        <tr id="{{ $filiere[$i]->id }}">
                            <td tabindex="1">{{ $filiere[$i]->id }}</td>
                            <td tabindex="1">{{ $filiere[$i]->nom }}</td>
                            <td tabindex="1">{{ $filiere[$i]->classe }}</td>
                            <td tabindex="1">{{ $filiere[$i]->dure }}</td>
                            <td tabindex="1">

                                @if ($filiere[$i]->statut==true)
                                <a href="#"  id="sus" data-id="{{ $filiere[$i]->id }}" data-toggle="modal">
                                    <code class="badge badge-error" id="code{{ $filiere[$i]->id }}">Suspendre  </code>
                                </a>
                                    @else
                                    <a href="#"  id="lancer" data-id="{{ $filiere[$i]->id }}" data-toggle="modal">
                                        <code class="badge badge-error" id="code{{ $filiere[$i]->id }}">lancer  </code>
                                    </a>
                                @endif

                                <a href="#"  id="suppp" data-id="{{ $filiere[$i]->id }}">
                                    <code class="badge badge-danger">Supprimer  </code>
                                </a>
                            </td>
                        </tr>
                        @endfor

                    </tbody>
                </table>

            </div>
            @endif
        </div>
    </div>
</div>
