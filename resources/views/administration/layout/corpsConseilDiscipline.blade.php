<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                @if (sizeOf($reponse)==0)
                <h4 class="m-t-0 header-title" id="statutclasse"><b>Pas de  conseils de discipline non jugés</b></h4>
                @else
                <h4 class="m-t-0 header-title" id="statutclasse"><b>Liste des conseils de discipline non jugés</b></h4>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tablecd">
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Nom / Prénom</th>
                                <th>Classe</th>
                                <th>Motif</th>
                                <th>nom du plaignant</th>
                                <th>Date du C/D</th>
                                <th>manipulations</th>
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
                                <td tabindex="1">{{ $reponse[$i]->nom_p.' '.$reponse[$i]->prenom_p }}</td>
                                <td tabindex="1">{{ $reponse[$i]->date }}</td>
                                <td tabindex="1">

                                    <a href="#"  id="juge-cd"
                                    data-id="{{ $reponse[$i]->id }}"
                                    data-matricule="{{ $reponse[$i]->matricule }}"
                                    data-motif="{{ $reponse[$i]->motif }}"
                                    data-nom="{{ $reponse[$i]->nom_e.' '.$reponse[$i]->prenom_e }}"
                                     data-toggle="modal" data-target="#juger-cd">
                                        <code class="badge badge-error" >Juger</code>
                                    </a>
                                </td>
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



<!-- discipline d'un etudiant -->
<div id="juger-cd" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- contenu-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Décision d'un conseil de discipline</h4>
            </div>
            <form action="{{ route('juger_conseil_discipline_admin_path') }}" method="post" id="form-juge-cd">

            <div class="modal-body" id="interieur">
                    <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Matricule</label>
                                  <input type="text"  id="matricule" class="form-control" disabled>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Nom et prénom</label>
                                  <input type="text"  id="nom" class="form-control" disabled>
                            </div>

                        </div>
                          <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Motif</label>
                                      <input type="text"  id="motif" class="form-control" disabled>
                                </div>

                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                          <label for="">décision du conseil</label>
                                          <select name="coupable" id="decision" class="form-control" required>
                                                <option value="false">Non coupable</option>
                                                <option value="true">Coupable</option>
                                          </select>
                                    </div>

                                </div>
                             <input type="hidden" name="id" id="id">


            </div>

            <div class="modal-footer">
                <input type="hidden" name="id_etud" id="ident" >
              <input type="submit"  class="btn btn-success left" value="envoyer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </form>
          </div>

        </div>
      </div>
