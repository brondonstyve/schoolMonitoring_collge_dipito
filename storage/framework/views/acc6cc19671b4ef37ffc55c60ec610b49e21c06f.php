<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="m-t-0 header-title" id="title"><b id="b">Liste des salles de classes</b></h4>


            <div class="table-responsive">
                <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableetudiants">

                    <thead id="entete">
                        <tr>
                            <th>Numéro</th>
                            <th>Série</th>
                            <th>Niveau</th>
                            <th>Code de la classe</th>
                            <th>nom classe</th>
                            <th>Manipulations</th>
                        </tr>
                    </thead>
                    <tbody id="corps">
                        <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?>
                        <tr id="">
                            <td tabindex="1"><?php echo e($classe[$i]->id); ?></td>
                            <td tabindex="1" ><?php echo e($classe[$i]->nom); ?></td>
                            <td tabindex="1" ><?php echo e($classe[$i]->niveau); ?></td>
                            <td tabindex="1"><?php echo e($classe[$i]->code_classe); ?></td>
                            <td tabindex="1"><?php echo e($classe[$i]->code_f.' '.$classe[$i]->code_classe); ?></td>
                            <td tabindex="1">
                                <a href="#"  id="voir-etu-mora" data-id="<?php echo e($classe[$i]->code_f.' '.$classe[$i]->code_classe); ?>" data-filiere="<?php echo e($classe[$i]->id_fil); ?>" data-id_classe="<?php echo e($classe[$i]->id); ?>" data-toggle="modal" data-target="">
                                        <code class="badge badge-info">liste des étudiants</code>
                                </a>
                            </td>
                        </tr>
                        <tr id="<?php echo e($classe[$i]->code_f.' '.$classe[$i]->code_classe); ?>">

                        </tr>

                        <?php endfor; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <td class="right"><?php echo e($classe->links()); ?></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>






<!-- modifier etudiant -->
<div id="modifier-etudiant" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- contenu-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modifier un étudiant</h4>
        </div>
        <form action="<?php echo e(route('modifier_etudiant_path')); ?>" method="post" id="form-mod-etd">

        <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Nom</label>
                              <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>

                    </div>
                      <div class="col-md-12">
                          <div class="form-group">
                                <label for="">prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control" required>
                          </div>

                      </div>
                      <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">sexe</label>
                                  <select name="sexe" id="sexe" class="form-control">
                                      <option value="masculin">masculin</option>
                                      <option value="feminin">feminin</option>
                                  </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Date de naissance</label>
                                      <input type="date" name="date" id="date" required class="form-control" >
                                </div>

                            </div>
                         <input type="hidden" name="matricule" id="matricule">


        </div>

        <div class="modal-footer">
            <input type="hidden" name="id_etud" id="ident" >
          <input type="submit"  class="btn btn-success left">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
      </form>
      </div>

    </div>
  </div>



  <!-- transfert etudiant -->
<div id="transferer-etudiant" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- contenu-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modifier un étudiant</h4>
        </div>
        <form action="<?php echo e(route('transferer_etudiant_path')); ?>" method="post" id="form-trans-etd">

        <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Classe</label>
                              <input type="text" name="classe" id="classe" class="form-control" disabled>
                        </div>

                    </div>
                      <div class="col-md-12">
                          <div class="form-group">
                                <label for="">Classe du transfert</label>
                                <select name="classetransfert" id="classe-transfert" class="form-control" required>
                                </select>
                          </div>

                      </div>
                         <input type="hidden" name="matricule" id="matricule">


        </div>

        <div class="modal-footer">
            <input type="hidden" name="id_etud" id="ident" >
          <input type="submit"  class="btn btn-success left">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
      </form>
      </div>

    </div>
  </div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsMoratoire.blade.php ENDPATH**/ ?>