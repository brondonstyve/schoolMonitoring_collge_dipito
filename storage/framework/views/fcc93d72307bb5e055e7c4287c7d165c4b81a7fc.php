<!-- detail d'évaluations-->

<?php if($test): ?>
<div class="card">
        <div class="card-body bg-info">
            <h4 class="text-white card-title uppercase">Détails de l'évaluation de <?php echo e($modif_evaluation[0]->nom); ?> de la <?php echo e($modif_evaluation[0]->classe); ?></h4>
            <h6 class="card-subtitle text-white m-b-0 op-5">Détails</h6>
        </div>
        <div class="card-body">
            <div class="message-box contact-box">
                <h2 class="add-ct-btn">
                    <a href="<?php echo e(route('evaluation_path')); ?>">
                    <button type="" class="btn btn-circle btn-lg btn-danger waves-effect waves-dark">
                        X
                    </button>
                </a>
                </h2>


                <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Fiche d'évaluation  </b></h4>
                            <p class="text-muted font-14 m-b-20">
                               éditer par M.<code><?php echo e($modif_evaluation[0]->editeur); ?></code>
                            </p>

                            <div class="table-responsive">
                                                <table class=" table m-0 table-colored-bordered table-bordered-primary " style="font-size: 15px">
                                                    <form action="<?php echo e(route('modifier_evaluation_dure_path')); ?>" method="post">
                                                        <?php echo e(csrf_field()); ?>

                                                    <thead>
                                                        <tr>
                                                            <th>Matière (classe)</th>
                                                            <th>Libellé</th>
                                                            <th>durée</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="btn-sm">
                                                        <tr>

                                                            <td style="width: 40%" >
                                                             <?php echo e($modif_evaluation[0]->nom); ?>( <?php echo e($modif_evaluation[0]->classe); ?>)
                                                            </td>

                                                            <td style="width: 30%">
                                                              <?php echo e($modif_evaluation[0]->libelle); ?>

                                                            </td>

                                                            <td style="width: 30%">
                                                             <?php echo e($modif_evaluation[0]->dure); ?> (Minutes)
                                                             <select name="dure">
                                                                    <option value="2">2</option>
                                                                    <option value="5">5</option>
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="30">30</option>
                                                                    <option value="45">45</option>
                                                                    <option value="60">60</option>
                                                                </select>
                                                                <input type="submit" value="modifier?" class="btn btn-success">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <input type="hidden" name="di" value="<?php echo e(encrypt($modif_evaluation[0]->id)); ?>">
                                                </form>
                                                    <thead>
                                                            <tr>
                                                                <th colspan="2" class="centre uppercas">Réponses</th>
                                                                <th class="centre uppercas">épreuve/Fichier</th>
                                                            </tr>
                                                        </thead>
                                                        <tr class="centre">
                                                                <td colspan="2">
                                                                        <?php echo e($modif_evaluation[0]->reponse); ?>

                                                                </td>
                                                                <td colspan="" class="btn-sm">
                                                                        cliquez<a href="storage\epreuve\<?php echo e($modif_evaluation[0]->epreuve); ?>"  style="color: brown"> ici  </a>pour voir l'épreuve
                                                                </td>

                                                        </tr>
                                                    <thead>
                                                        <tr>
                                                            <td colspan="3" align="center" class="btn-sm">
                                                                <input type="button" class=" btn btn-success btn-sm" value="Imprimer">
                                                            </td>
                                                        </tr>
                                                    </thead>

                                                </table>
                            </div>
                        </div>

                    </div>


            </div>
        </div>
    </div>


    <!--evaluer une salle de classe-->
<?php else: ?>
<div class="card">
        <div class="card-body bg-info">
            <h4 class="text-white card-title uppercase">évaluer une salle de classe</h4>
            <h6 class="card-subtitle text-white m-b-0 op-5">évaluation</h6>
        </div>
        <div class="card-body">
            <div class="message-box contact-box">
                <h2 class="add-ct-btn">
                    <a href="<?php echo e(route('evaluation_path')); ?>">
                    <button type="" class="btn btn-circle btn-lg btn-danger waves-effect waves-dark">
                        X
                    </button>
                </a>
                </h2>

                <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Valider les informations</b></h4>
                            <p class="text-muted font-14 m-b-20">
                               éditer par M.<code><?php echo e($evaluation[0]->editeur); ?></code>
                            </p>

                            <div class="table-responsive">
                                        <form action="<?php echo e(route('enregistrer_evaluation_path')); ?>" method="post">
                                                <?php echo e(csrf_field()); ?>

                                                <table class=" table m-0 table-colored-bordered table-bordered-primary " style="font-size: 15px">
                                                    <thead>
                                                        <tr>
                                                            <th>Matière</th>
                                                            <th>Libellé</th>
                                                            <th>durée(Minutes)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="btn-sm">
                                                        <tr>

                                                            <td style="width: 80%" >
                                                                    <?php for($i =0 ; $i <sizeOf($classe_mat) ; $i++): ?>
                                                                    <input type="checkbox" name='classe<?php echo e($i); ?>' value="<?php echo e($classe_mat[$i]->id.'.'.$classe_mat[$i]->nom.'->'.$classe_mat[$i]->classe); ?>">
                                                                        <?php echo e($classe_mat[$i]->nom.'->'.$classe_mat[$i]->classe); ?>

                                                                        <br>
                                                                        <?php endfor; ?>
                                                            </td>

                                                            <td style="width: 10%">
                                                                <select name="libelle" id=""
                                                                    style="min-width: 100%;text-transform: uppercase">
                                                                    <option value="CC">CC</option>
                                                                    <option value="SN">SN</option>
                                                                    <option value="tp">tp</option>
                                                                </select>
                                                            </td>

                                                            <td style="width: 10%">
                                                                <select name="dure" id="" style="min-width: 80%">
                                                                    <option value="2">2</option>
                                                                    <option value="5">5</option>
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="30">30</option>
                                                                    <option value="45">45</option>
                                                                    <option value="60">60</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <thead>
                                                            <tr>
                                                                <th colspan="3" class="centre uppercas">Réponses</th>
                                                            </tr>
                                                        </thead>
                                                        <tr class="centre">
                                                                <td colspan="3">
                                                                        <?php echo e($evaluation[0]->reponse); ?>

                                                                </td>

                                                        </tr>

                                                    <thead>
                                                            <tr>
                                                                <th colspan="3" class="centre uppercas">épreuve</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td colspan="3" class="btn-sm">
                                                                    cliquez<a href="storage\epreuve\<?php echo e($evaluation[0]->epreuve); ?>"  style="color: brown"> ici  </a>pour voir l'épreuve
                                                            </td>
                                                        </tr>
                                                        <input type="hidden" name="idEpreuve" value="<?php echo e($evaluation[0]->id); ?>">
                                                        <input type="hidden" name="compteur" value="<?php echo e(sizeOf($classe_mat)); ?>">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="3" align="center" class="btn-sm">
                                                                <input type="submit" class=" btn btn-success btn-sm" value="Valider">
                                                            </td>
                                                        </tr>
                                                    </thead>

                                                </table>

                                            </form>
                            </div>
                        </div>

                    </div>


            </div>
        </div>
    </div>

<?php endif; ?>
