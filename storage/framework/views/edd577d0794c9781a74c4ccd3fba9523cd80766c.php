<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title" id="statutclasse"><b id="b">Gerer la discipline</b></h4>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tablediscipline">
                        <thead id="corps">
                            <tr>
                                <th>Numéro</th>
                                <th>Série</th>
                                <th>Niveau</th>
                                <th>Code de la classe</th>
                                <th>nom classe</th>
                                <th>Manipulations</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?>
                            <tr id="<?php echo e($classe[$i]->id); ?>">
                                <td tabindex="1"><?php echo e($classe[$i]->id); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->nom); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->niveau); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->code_classe); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->code_f.' '.$classe[$i]->code_classe); ?></td>
                                <td tabindex="1">

                                    <a href="#"  id="voir-disc" data-id="<?php echo e($classe[$i]->code_f.' '.$classe[$i]->code_classe); ?>">
                                            <code class="badge badge-info">Liste des etudiants  </code>
                                    </a>
                                </td>
                            </tr>
                            <?php endfor; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="right"><?php echo e($classe->links()); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>












<!-- discipline d'un etudiant -->
<div id="discipline-etudiant" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- contenu-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Conseil de discipline</h4>
        </div>
        <form action="<?php echo e(route('ajouter_discipline_admin_path')); ?>" method="post" id="form-add-disc">

        <div class="modal-body">
                <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Matricule</label>
                              <input type="text" name="matricule" id="matricule" class="form-control" disabled>
                              <input type="hidden" name="matricul" id="matricule" class="form-control">
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Nom</label>
                              <input type="text" name="nom" id="nom" class="form-control" disabled>
                        </div>

                    </div>
                      <div class="col-md-12">
                          <div class="form-group">
                                <label for="">prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control" disabled>
                          </div>

                      </div>
                      <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">classe</label>
                                  <input type="text" name="classe" id="classe" class="form-control" disabled>
                            </div>

                        </div>
                      <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Motif</label>
                                  <input type="text" name="motif" id="motif" class="form-control" required>
                            </div>

                        </div>
                        <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">date du conseil</label>
                                      <input type="date" name="date" id="date" class="form-control" min="<?php echo e(date('Y-m-d')); ?>" required>
                                </div>

                            </div>
                         <input type="hidden" name="matri" id="matri">


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













<!-- discipline d'un etudiant -->
<div id="casier-judiciare" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- contenu-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Casier Judiciaire</h4>
        </div>
        <form id="form-add-casier">

        <div class="modal-body">
                <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Matricule</label>
                              <input type="text" name="matricule" id="matricule" class="form-control" disabled>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Nom</label>
                              <input type="text" name="nom" id="nom" class="form-control" disabled>
                        </div>

                          <div class="form-group">
                                <label for="">prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control" disabled>
                          </div>

                      </div>
                      <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">classe</label>
                                  <input type="text" name="classe" id="classe" class="form-control" disabled>
                            </div>

                        </div>
                      <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Nombre de conseil de discipline</label>
                                  <input type="text" name="motif" id="nombreconseil" class="form-control" disabled>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Nombre de jugements coupables</label>
                                  <input type="" name="text" id="nombrejugement" class="form-control" disabled>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Nombre d'heures d'absences</label>
                                  <input type="" name="date" id="absence" class="form-control" disabled>
                            </div>

                        </div>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Imprimer</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
      </form>
      </div>

    </div>
  </div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsDiscipline.blade.php ENDPATH**/ ?>