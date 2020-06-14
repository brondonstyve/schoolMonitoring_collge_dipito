<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title" id="statutFiliere"><b>Gerer toutes les filières</b></h4>
                <a href="#" data-toggle="modal" class="btn btn-success right ">
                        <code  data-toggle="modal" data-target="#Ajout-filiere">Ajouter</code>
                    </a>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableFiliere">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Libellé</th>
                                <th>Code</th>
                                <th>Nombre de niveau</th>
                                <th>Manipulations</th>
                            </tr>
                        </thead>
                        <tbody id="nouveau">
                            <!--Nouvelle insertion-->
                        </tbody>
                        <tbody>
                            <?php for($i =0 ; $i <sizeOf($filiere) ; $i++): ?>
                            <tr id="<?php echo e($filiere[$i]->id); ?>">
                                <td tabindex="1"><?php echo e($filiere[$i]->id); ?></td>
                                <td tabindex="1"><?php echo e($filiere[$i]->nom); ?></td>
                                <td tabindex="1"><?php echo e($filiere[$i]->code); ?></td>
                                <td tabindex="1"><?php echo e($filiere[$i]->niveau); ?></td>
                                <td tabindex="1">

                                    <a href="#"  id="mod" data-id="<?php echo e($filiere[$i]->id); ?>" data-toggle="modal" data-target="#modifier-filiere">
                                        <code class="badge badge-error" >Modifier  </code>
                                    </a>
                                    <a href="#"  id="supp" data-id="<?php echo e($filiere[$i]->id); ?>">
                                        <code class="badge badge-danger">Supprimer  </code>
                                    </a>
                                    <a href="#"  id="voir" data-id="<?php echo e($filiere[$i]->id); ?>" data-toggle="modal" data-target="#voir-filiere">
                                            <code class="badge badge-info">Voir  </code>
                                    </a>
                                </td>
                            </tr>
                            <?php endfor; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th><strong>TOTAL</strong></th>
                                <th><input type="button" id="nbreFiliere" value="<?php echo e($filiereNbre); ?>" size="3"> Filières</th>
                                <th></th>
                                <td class="right"><?php echo e($filiere->links()); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- ajouteur de filliere -->
    <div id="Ajout-filiere" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ajouter une Filière</h4>
          </div>
          <form action="<?php echo e(route('enregistrer_filiere_path')); ?>" method="post" id="filiere">

          <div class="modal-body">
                      <div class="col-md-12">
                          <div class="form-group">
                                <label for="">Nom</label>
                                <input type="text" name="nom" class="form-control" required>
                                <?php echo $errors->first('nom',' <p style="color: red;font-family: italic"> :message
                                    </p> '); ?>

                      </div>
                      </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Code</label>
                                  <input type="text" name="code" class="form-control" required>
                                  <?php echo $errors->first('code',' <p style="color: red;font-family: italic"> :message
                                    </p> '); ?>

                            </div>
                        </div>

                        <input type="hidden" name="niveau" value="0">


          </div>

          <div class="modal-footer">
            <input type="submit"  class="btn btn-success left">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          </div>
        </form>
        </div>

      </div>
    </div>


<!-- modifier filliere -->
    <div id="modifier-filiere" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- contenu-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modifier une Filière</h4>
                </div>
                <form action="<?php echo e(route('modifier_filiere_path')); ?>" method="post" id="form-mod-fil">

                <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Nom</label>
                                      <input type="text" name="nom" id="nom" class="form-control" required>
                                </div>

                            </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                        <label for="">Code</label>
                                        <input type="text" name="code" id="code" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-12">
                                    <div class="form-group">
                                          <label for="">Nombre de niveau</label>
                                          <select name="niveau" class="form-control" id="niveau">
                                              <?php for($i =1 ; $i <6 ; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                              <?php endfor; ?>
                                          </select>
                                    </div>
                                </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id_fil" id="ident" >
                  <input type="submit"  class="btn btn-success left">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
              </form>
              </div>

            </div>
          </div>



          <!-- voir une filière -->
    <div id="voir-filiere" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- contenu-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Détail d'une Filière</h4>
                </div>
                <div class="modal-body" id="voir-fil">
                            <div class="col-md-12">
                                <div class="form-group">
                                      <input type="text" name="" id="num" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                      <input type="text" name="" id="nom" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                        <input type="text" name="" id="code" class="form-control" disabled>
                                  </div>
                                  <div class="form-group">
                                        <input type="text" name="" id="nbre" class="form-control" disabled>
                                  </div>
                                  <div class="form-group">
                                      <textarea id="clas" class="form-control" disabled cols="30" rows="10"></textarea>
                                  </div>

                            </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
              </div>

            </div>
          </div>









<?php /**PATH C:\laragon\www\StandPlace\resources\views/administration/layout/corpsFiliere.blade.php ENDPATH**/ ?>