<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title"><b>Cliquer sur voir pour consulter les differentes listes de pénalités</b></h4>


                <div class="table-responsive">
                    <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tablePenalite">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Filière</th>
                                <th>Niveau</th>
                                <th>Code de la classe</th>
                                <th>nom classe</th>
                                <th>Manipulations</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?>
                            <tr id="">
                                <td tabindex="1"><?php echo e($classe[$i]->id); ?></td>
                                <td tabindex="1" ><?php echo e($classe[$i]->nom); ?></td>
                                <td tabindex="1" ><?php echo e($classe[$i]->niveau); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->code_classe); ?></td>
                                <td tabindex="1"><?php echo e($classe[$i]->code_f.$classe[$i]->niveau.$classe[$i]->code_classe); ?></td>
                                <td tabindex="1">
                                    <a href="<?php echo e(route('liste_penalite_path')); ?>?path=<?php echo e(encrypt($classe[$i]->code_f.$classe[$i]->niveau.$classe[$i]->code_classe)); ?>"  id="voir-Pen" >
                                            <code class="badge badge-info">Penalités</code>
                                    </a>
                                </td>
                            </tr>
                            <tr id="<?php echo e($classe[$i]->code_f.$classe[$i]->niveau.$classe[$i]->code_classe); ?>">

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
