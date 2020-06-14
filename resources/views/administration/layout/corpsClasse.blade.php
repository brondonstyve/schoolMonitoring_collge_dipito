<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="m-t-0 header-title" id="statutclasse"><b>Gerer toutes les Classes</b></h4>
            <a href="#" data-toggle="modal" class="btn btn-success right ">
                    <code  data-toggle="modal" data-target="#Ajout-classe">Ajouter</code>
                </a>


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

                                <a href="#"  id="mod-classe" data-id="{{ $classe[$i]->id }}" data-toggle="modal" data-target="#modifier-classe">
                                    <code class="badge badge-error" >Fusionner</code>
                                </a>
                                <a href="#"  id="supp-classe" data-id="{{ $classe[$i]->id }}">
                                    <code class="badge badge-danger">Supprimer  </code>
                                </a>
                                <a href="#"  id="voir-classe" data-id="{{ $classe[$i]->id }}">
                                        <code class="badge badge-info">Voir  </code>
                                </a>
                            </td>
                        </tr>
                        @endfor

                    </tbody>
                    <tfoot>
                        <tr>
                            <th><strong>TOTAL</strong></th>
                            <th><input type="button" id="nbreclasse" value="{{ sizeOf($classe) }}" size="3"> classes</th>
                            <th></th>
                            <td class="right">{{ $classe->links() }}</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
</div>

<!-- ajouteur de classe -->
<div id="Ajout-classe" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- contenu-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter une classe</h4>
      </div>
      <form action="{{ route('enregistrer_classe_path') }}" method="post" id="classe">

      <div class="modal-body">
            <table class="">
                  <div class="col-md-12">
                      <div class="form-group">
                            <label for="">Série</label>
                            <select name="filiere" class="form-control" id="classe-filiere" required>
                            <option></option>
                               @foreach ($filiere as$key=>$item)
                                   <option value="{{ $key }}" id="fil-change">{{ $item }}</option>
                               @endforeach
                            </select>
                      </div>

                  </div>
                    <div class="col-md-12">
                        <div class="form-group">
                              <label for="">code de la classe</label>
                              <select name="code_classe" class="form-control" id="">
                                @for ($i = 'a'; $i < 'e'; $i++)
                                   <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                             </select>
                        </div>

                    </div>
              </table>
      </div>

      <div class="modal-footer">
        <input type="submit"  class="btn btn-success left">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </form>
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
              <h4 class="modal-title">Modifier une classe</h4>
            </div>
            <form action="{{ route('modifier_classe_path') }}" method="post" id="form-mod-classe">

                <div class="modal-body">
                          <div class="col-md-12">
                              <div class="form-group">
                                    <label for="">Classe</label>
                                    <input type="text" name="filiere" id="lib" class="form-control" placeholder="Série" required>
                              </div>

                          </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Code de la classe</label>
                                      <select name="code" class="form-control" id="code">
                                         @for ($i = 1; $i < 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                         @endfor
                                      </select>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Nombre de place</label>
                                      <select name="nbPlace" class="form-control" id="nb">
                                        @for ($i = 40; $i <= 70; $i=$i+5)
                                           <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                     </select>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Description</label>
                                      <textarea name="description" id="desc" cols="30" rows="10" class="form-control" placeholder="description"></textarea>
                                </div>

                            </div>

              </div>

            <div class="modal-footer">
                <input type="" name="id_classe" id="ident" >
              <input type="submit"  class="btn btn-success left">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </form>
          </div>

        </div>
      </div>









