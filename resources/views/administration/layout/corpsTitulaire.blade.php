<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="m-t-0 header-title" id="statutclasse"><b>Gerer toutes les titulaires de classe</b></h4>



            <div class="table-responsive">
                <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableclasse">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Série</th>
                            <th>Code de la classe</th>
                            <th>nom classe</th>
                            <th>Manipulations</th>
                        </tr>
                    </thead>
                    <tbody id="nouveau">
                        <!--Nouvelle insertion-->
                    </tbody>
                    <tbody id="tbody">
                        @for ($i =0 ; $i <sizeOf($classe) ; $i++)
                        <tr id="{{ $classe[$i]->id }}">
                            <td tabindex="1">{{ $classe[$i]->id }}</td>
                            <td tabindex="1">{{ $classe[$i]->nom }}</td>
                            <td tabindex="1">{{ $classe[$i]->code_classe }}</td>
                            <td tabindex="1">{{ $classe[$i]->code_f.' '.$classe[$i]->code_classe }}</td>
                            <td tabindex="1">

                                <a href="#"  id="ajouter_titu" data-id="{{ $classe[$i]->id }}" data-classe="{{ $classe[$i]->code_f.' '.$classe[$i]->code_classe }}" data-toggle="modal" data-target="#modifier-classe">
                                    <code class="badge badge-error" >Ajouter</code>
                                </a>
                                <a href="#"  id="voir_ti" data-id="{{ $classe[$i]->id }}" data-toggle="modal" data-target="#voir-titulaire" data-classe="{{ $classe[$i]->code_f.' '.$classe[$i]->code_classe }}">
                                    <code class="badge badge-danger">voir</code>
                                </a>
                                <a href="#"  id="supp_ti" data-id="{{ $classe[$i]->id }}" data-toggle="modal" data-target="#supp-titulaire" data-classe="{{ $classe[$i]->code_f.' '.$classe[$i]->code_classe }}">
                                    <code class="badge badge-danger">retirer</code>
                                </a>
                            </td>
                        </tr>
                        @endfor

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>


<!-- modifier classe -->
<div id="modifier-classe" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- contenu-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Ajouter un titulaire</h4>
            </div>
            <form action="{{ route('ajouter_titulaire_path') }}" method="post" id="form_titulaire">

                <div class="modal-body">
                          <div class="col-md-12">
                              <div class="form-group">
                                    <label for="">Classe</label>
                                    <input type="text" name="filiere" id="classe_rechargeable" class="form-control" disabled>
                              </div>

                          </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Choisir le titulaire</label>
                                      <select name="matricule" class="form-control">
                                          @for ($i = 0; $i < sizeOf($prof); $i++)
                                            <option value="{{ $prof[$i]->id }}">
                                              @if ($prof[$i]->sexe=='Masculin')
                                                  M. {{ $prof[$i]->nom.' '.$prof[$i]->prenom }}
                                              @else
                                              Mde. {{ $prof[$i]->nom.' '.$prof[$i]->prenom }}
                                              @endif
                                            </option>
                                          @endfor
                                     </select>
                                </div>

                            </div>

              </div>

            <div class="modal-footer">
                <input type="hidden" name="classe" id="ident" value="" >
              <input type="submit"  class="btn btn-success left">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </form>
          </div>

        </div>
      </div>







<!-- voir -->
<div id="voir-titulaire" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- contenu-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> titulaire</h4>
        </div>
        <form id="form_titulaire">

            <div class="modal-body">
                      <div class="col-md-12">
                          <div class="form-group">
                                <label for="">Classe</label>
                                <input type="text"  id="classe_titu" class="form-control" disabled>
                          </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Nom du titulaire</label>
                              <input type="text"  id="voir_tit" class="form-control" disabled>
                        </div>

                    </div>

          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
      </form>
      </div>

    </div>
  </div>


