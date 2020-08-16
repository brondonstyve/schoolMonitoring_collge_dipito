

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="m-t-0 header-title"><b>Confirmer le paiement</b></h4>


            <div class="table-responsive">
                <form action="<?php echo e(route('valider_paie')); ?>" method="post">
                        <table class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tablePenalite">
                            <?php echo e(csrf_field()); ?>

                                <thead>
                                    <tr>
                                        <hr>
                                        <div class="">
                                            <strong>Matricule:</strong>
                                            <input type="text" name="matricule" class="form-control"
                                                value="<?php echo e($reponse[0]->matricule); ?>" disabled />
                                                <input type="hidden" name="matricule" value="<?php echo e($reponse[0]->id); ?>">
                                                <input type="hidden" name="mat" value="<?php echo e($reponse[0]->matricule); ?>">

                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="">
                                                <strong>Nom:</strong>
                                                <input type="text" name="nom" class="form-control" value="<?php echo e($reponse[0]->nom); ?>"
                                                    disabled />

                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <strong>Prenom:</strong>
                                                <input type="text" name="prenom" class="form-control"
                                                    value="<?php echo e($reponse[0]->prenom); ?>" disabled />
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="">
                                                <strong>Salaire Horaire:</strong>
                                                <input type="text" name="salaire" class="form-control"
                                                    value="<?php echo e($reponse[0]->salaire .' Fcfa'); ?>" disabled />

                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <strong>Nombre d'heure Total</strong>
                                                <input type="text" name="heure" class="form-control" value="<?php echo e($cahier .' H'); ?>"
                                                    disabled />
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="">
                                                <strong>Nombre d'heure non payé</strong>
                                                <input type="text" name="total" class="form-control"
                                                    value="<?php echo e($reponse[0]->horaire*2 .' H'); ?>" disabled />

                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <strong>Nombre à payées:</strong>
                                                <input type="text" name="heure" class="form-control"
                                                    value="<?php echo e($cahier-$reponse[0]->horaire*2 .' H'); ?>" disabled />
                                                    <input type="hidden" name="new_horaire" value="<?php echo e(($cahier-$reponse[0]->horaire*2)/2); ?>">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <div  >
                                                <strong>Montant à payer</strong>
                                                <input type="text" name="heure" class="form-control"
                                                    value="<?php echo e($reponse[0]->salaire*($cahier-$reponse[0]->horaire*2) .' Fcfa'); ?>" disabled />
                                                    <input type="hidden" name="montant" value="<?php echo e($reponse[0]->salaire*($cahier-$reponse[0]->horaire*2) .' Fcfa'); ?>">

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="centre" colspan="2"><button type="submit"
                                                class="btn btn-success">Valider</button></td>
                                    </tr>

                                </thead>
                            </table>
                </form>


            </div>
        </div>



    </div>
</div>












<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title" id="statutclasse"><b>Détail du travail</b></h4>


                <div class="table-responsive">
                    <table class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableMatiere">
                        <thead>
                            <tr >
                                <th>Numéro</th>
                                <th>date</th>
                                <th>matiere</th>
                                <th>classe</th>
                                <th>libelle</th>

                            </tr>
                        </thead>
                        <tbody id="mouf">
                            <?php for($i =0 ; $i <($cahier-$reponse[0]->horaire*2)/2 ; $i++): ?> <tr id="">
                                <td tabindex="1"><?php echo e($i+1); ?></td>
                                <td tabindex="1"><?php echo e($detail[$i]->date); ?></td>
                                <td tabindex="1"><?php echo e($detail[$i]->nom); ?></td>
                                <td tabindex="1"><?php echo e($detail[$i]->classe); ?></td>
                                <td tabindex="1"><?php echo e($detail[$i]->libelle); ?></td>
                                </tr>
                                <?php endfor; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td class="right"><?php echo e($detail->links()); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table table-striped m-b-10 centre" id="into">

                    </table>

                </div>
            </div>
        </div>
    </div>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/administration/layout/corpsPaie.blade.php ENDPATH**/ ?>