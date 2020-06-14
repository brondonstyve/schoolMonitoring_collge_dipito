<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title" id="statutclasse"><b>Cliquer sur voir pour consulter les differentes listes</b></h4>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableSolvabilite">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Série</th>
                                <th>Niveau</th>
                                <th>Code de la classe</th>
                                <th>nom classe</th>
                                <th>Manipulations</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @for ($i =0 ; $i <sizeOf($classe) ; $i++)
                            <tr id="">
                                <td tabindex="1">{{ $classe[$i]->id }}</td>
                                <td tabindex="1" >{{ $classe[$i]->nom }}</td>
                                <td tabindex="1" >{{ $classe[$i]->niveau }}</td>
                                <td tabindex="1">{{ $classe[$i]->code_classe }}</td>
                                <td tabindex="1">{{ $classe[$i]->code_f.' '.$classe[$i]->code_classe }}</td>
                                <td tabindex="1">
                                    <a href="{{ route('liste_penalite_path') }}?classe={{ $classe[$i]->code_f.' '.$classe[$i]->code_classe }}&filiere={{ $classe[$i]->filiere }}&niveau={{ 0 }}">
                                            <code class="badge badge-info">Voir  </code>
                                    </a>
                                </td>
                            </tr>
                            <tr id="{{ $classe[$i]->code_f.' '.$classe[$i]->code_classe }}">

                            </tr>
                            @endfor

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td class="right">{{ $classe->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>



