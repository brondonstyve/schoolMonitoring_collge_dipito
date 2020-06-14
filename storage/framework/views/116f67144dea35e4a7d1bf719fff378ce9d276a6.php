<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title" id="statutclasse"><b>Gerer toutes les Classes</b></h4>
                <a href="#" data-toggle="modal" class="btn btn-success right ">
                        <code  data-toggle="modal" data-target="#Ajout-evenement">Ajouter</code>
                    </a>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableclasse">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Titre</th>
                                <th>date</th>
                                <th>Horaire</th>
                                <th>lieu</th>
                                <th>description</th>
                            </tr>
                        </thead>
                        <tbody id="nouveau">
                            <!--Nouvelle insertion-->
                        </tbody>
                        <tbody id="tbody">
                            <?php for($i =0 ; $i <sizeOf($evenement) ; $i++): ?>
                            <tr id="<?php echo e($evenement[$i]->id); ?>" title="<?php echo e($evenement[$i]->description); ?>">
                                <td tabindex="1"><?php echo e($evenement[$i]->id); ?></td>
                                <td tabindex="1"><?php echo e($evenement[$i]->titre); ?></td>
                                <td tabindex="1"><?php echo e($evenement[$i]->date); ?></td>
                                <td tabindex="1"><?php echo e($evenement[$i]->debut." à ".$evenement[$i]->fin); ?></td>
                                <td tabindex="1"><?php echo e($evenement[$i]->lieu); ?></td>
                                <td tabindex="1">
                                    <a href="<?php echo e(route('supp_evenement_path')); ?>?id=<?php echo e($evenement[$i]->id); ?>"  id="supp-ev">
                                        <code class="badge badge-danger">Supprimer  </code>
                                    </a>
                                    <a href="#"  id="voir-ev"
                                    data-id="<?php echo e($evenement[$i]->id); ?>"
                                    data-titre="<?php echo e($evenement[$i]->titre); ?>"
                                    data-date="<?php echo e($evenement[$i]->date); ?>"
                                    data-debut="<?php echo e($evenement[$i]->debut); ?>"
                                    data-fin="<?php echo e($evenement[$i]->fin); ?>"
                                    data-lieu="<?php echo e($evenement[$i]->lieu); ?>"
                                    data-description="<?php echo e($evenement[$i]->description); ?>">
                                            <code class="badge badge-info"  data-toggle="modal" data-target="#mod-ev">voir / modifier  </code>
                                    </a>
                                </td>
                            </tr>
                            <?php endfor; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th><strong>TOTAL</strong></th>
                                <th><input type="button" id="nbreclasse" value="<?php echo e(sizeOf($evenement)); ?>" size="3"> Evenement(s)</th>
                                <th></th>
                                <td class="right"><?php echo e($evenement->links()); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- ajouteur de classe -->
    <div id="Ajout-evenement" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- contenu-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ajouter un évènement</h4>
          </div>
          <form action="<?php echo e(route('ajout_evenement_path')); ?>" method="post" id="evenements">
          <?php echo e(csrf_field()); ?>

          <div class="modal-body">
                <table class="">
                      <div class="col-md-12">
                          <div class="form-group">
                                <label for="">Titre</label>
                                <input type="text" name="titre" id="" class="form-control" required>
                          </div>

                      </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">description</label>
                                  <textarea name="description" id="" cols="30" rows="6" class="form-control"></textarea>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                                <div class="form-group">
                                      <label for="">Lieu</label>
                                      <input type="text" name="lieu" id="" class="form-control" required>
                                </div>

                            </div>
                        <?php
                          $date=date('Y-m-d')
                        ?>

                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">date</label>
                                  <input type="date" name="date" id="" date-format="YYYY-MM-DD" class="form-control" min="<?php echo e($date); ?>" required>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Heure de début</label>
                                  <input type="time" name="debut" id=""  class="form-control"  required>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                  <label for="">Heure de fin</label>
                                  <input type="time" name="fin" id=""  class="form-control"  required>
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
    <div id="mod-ev" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- contenu-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modifier un évènement</h4>
                </div>
                <form action="<?php echo e(route('modifier_ev_path')); ?>" method="post" id="form-mod-ev">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                              <div class="col-md-12">
                                  <div class="form-group">
                                        <label for="">titre</label>
                                        <input type="text" name="titre" id="titre" class="form-control" required>
                                  </div>

                              </div>

                              <div class="col-md-12">
                                    <div class="form-group">
                                          <label for="">date</label>
                                          <input type="date" name="date" id="date" date-format="YYYY-MM-DD" class="form-control" min="<?php echo e($date); ?>" required>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                              <label for="">Lieu</label>
                                              <input type="text" name="lieu" id="lieu" class="form-control" required>
                                        </div>

                                    </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                              <label for="">Heure de début</label>
                                              <input type="time" name="debut" id="debut"  class="form-control"  required>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                              <label for="">Heure de fin</label>
                                              <input type="time" name="fin" id="fin"  class="form-control"  required>
                                        </div>

                                    </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                          <label for="">Description</label>
                                          <textarea name="description" id="desc" cols="30" rows="10" class="form-control"></textarea>
                                    </div>

                                </div>

                  </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" >
                  <input type="submit"  class="btn btn-success left">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
              </form>
              </div>

            </div>
          </div>









<?php /**PATH C:\laragon\www\StandPlace\resources\views/administration/layout/corpsEvenement.blade.php ENDPATH**/ ?>