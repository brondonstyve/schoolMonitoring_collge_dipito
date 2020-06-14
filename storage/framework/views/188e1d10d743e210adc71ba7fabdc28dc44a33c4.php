
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">



<?php if(!$passe): ?>
<?php if(sizeOf($classe)==0): ?>
<h4 class="card-title">Pas encor d'étudiants dans les salles de classes</h4>
<?php else: ?>


            <h4 class="m-t-0 header-title" id="statutclasse"><b>Gerer Les emploi de temps</b></h4>


            <div class="table-responsive">
                <table class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableEDT">
                    <thead>
                        <tr >
                            <th>Numéro</th>
                            <th>Classe</th>
                            <th>Manipulations</th>
                        </tr>
                    </thead>
                    <tbody id="Edt">
                        <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?>
                        <tr id="">
                            <td tabindex="1"><?php echo e($i+1); ?></td>
                            <td tabindex="1"><?php echo e($classe[$i]->classe); ?></td>

                        <td>

                                <a href="#">
                                    <form action="<?php echo e(route('remplir_emploi_path')); ?>" method="post" class="inline">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="classe" value="<?php echo e($classe[$i]->classe); ?>">
                                        <button type="submit" class="badge badge-success">Voir / Modifier</button>
                                    </form>
                                </a>

                                <a href="#" id="sup-edt" data-classe="<?php echo e($classe[$i]->classe); ?>">
                                    <code class="badge badge-danger">supprimer </code>
                                </a>
                            </td>
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


<?php endif; ?>
<?php else: ?>


<?php
$jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
?>
<?php if($passe): ?>
<div class="table-responsive m-t-20" style="margin-top: -20px;">
 <form action="<?php echo e(route('sauvegarder_edt_path')); ?>" method="post">

    <?php echo e(csrf_field()); ?>

    <?php if(sizeOf($matiere)<=0): ?>
      <h3 class="card-title">Aucune Matiere enregistrer pour cette classe</h3>
      <h3 class="card-title centre "><a href='<?php echo e(route('emploi_admin_path')); ?>'> Retour</a></h3>
    <?php else: ?>
<!-- si aucun enseignant dispo-->
    <?php if(sizeOf($disponibilite)==0): ?>

    <h3 class="card-title">Aucun enseignant disponible</h3>
    <?php else: ?>
<!-- si non-->
  <div style="max-width: 90%;display: inline-block;margin-left: 8%">

        <h3 class="card-title"> Programmer la <?php echo e($matiere[0]->classe); ?></h3>
        <table class="table m-0 table-colored-full table-full-inverse table-hover">
                <thead class="btn-info">
                    <th>JOUR</th>
                    <?php for($v =1 ; $v <= sizeOf($configedt) ; $v++): ?>
                    <th>
                    Période <?php echo e($v); ?><br>
                    <?php echo e($configedt[$v-1]->hd .' à '.$configedt[$v-1]->hf); ?>


                        </th>

                    <?php endfor; ?>
                </thead>


                    <?php for($i = 0; $i < sizeOf($jour); $i++): ?>
                    <tr>
                         <td>
                           <?php echo e($jour[$i]); ?>

                         </td>
                         <?php
                             $c=0;
                         ?>

                        <?php for($v =1 ; $v <= sizeOf($configedt) ; $v++): ?>
                        <?php if($configedt[$v-1]->libelle=='pause'): ?>
                           <td>
                               <input type="button" value="Pause" class="btn btn-sm btn-info">
                           </td>
                            <?php else: ?>
                            <td>
                                    <select name="<?php echo e($jour[$i]); ?>matiere<?php echo e($c++); ?>" id="" style="width: 200px">
                                        <option value=""></option>
                                         <!--liste des matieres de la classe choisie-->
                                           <?php for($a=0; $a<sizeOf($matiere); $a++): ?>
                                                <?php for($x=0; $x<sizeOf($disponibilite); $x++): ?>
                                                <!--affichage en fonction des disponiblites des enseignants-->
                                                <?php if(($jour[$i]==$disponibilite[$x]->jour) && ($matiere[$a]->compte==$disponibilite[$x]->compte)): ?>
                                                     <?php if(sizeOf($testeurEmpl)<=0): ?>
                                                     <!--disponibilités des tranches-->
                                                       <?php if($v==$disponibilite[$x]->tranche): ?>
                                                       <?php if($matiere[$a]->nombre_heure<=0): ?>
                                                        <option disabled style="color: red" ><?php echo e($matiere[$a]->nom.' Cours terminé '); ?>

                                                           <?php else: ?>
                                                        <option value="<?php echo e($disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom); ?>" ><?php echo e($matiere[$a]->nom.' ( '.$matiere[$a]->nom_prof.' )'); ?>

                                                       <?php endif; ?>
                                                       <?php endif; ?>
                                                     <?php else: ?>
                                                     <?php for($u = 0; $u < sizeOf($testeurEmpl); $u++): ?>
                                                     <?php $test=false;$testeur=''; ?>
                                                     <!--test de disponibilité--jour -->
                                                      <?php if($testeurEmpl[$u]->jour==$disponibilite[$x]->jour): ?>
                                                      <!--test de disponibilité--compte -->
                                                               <?php if($testeurEmpl[$u]->compte==$disponibilite[$x]->compte): ?>
                                                               <!--test de disponibilité--tranche horaire-->
                                                               <?php if($v==$disponibilite[$x]->tranche): ?>

                                                               <?php if($matiere[$a]->nombre_heure<=0): ?>
                                                                  <option disabled style="color: red" value="<?php echo e($disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom); ?>"><?php echo e($matiere[$a]->nom.' ( '.$testeurEmpl[$u]->nom_professeur.' ) Cours terminé '); ?>

                                                                  <?php $test=true; $testeur=$matiere[$a]->compte.'.'.$matiere[$a]->nom; break; ?>
                                                               <?php endif; ?>

                                                                    <?php if($testeurEmpl[$u]->tranche==$v): ?>
                                                                          <option disabled style="color: red" value="<?php echo e($disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom); ?>"><?php echo e($matiere[$a]->nom.' ( '.$testeurEmpl[$u]->nom_professeur.' ) Occupé en '.$testeurEmpl[$u]->classe); ?>

                                                                          <?php $test=true; $testeur=$matiere[$a]->compte.'.'.$matiere[$a]->nom; break; ?>
                                                                      <?php else: ?>
                                                                          <?php $test=false; ?>
                                                                     <?php endif; ?>
                                                               <?php endif; ?>
                                                                 <?php else: ?>
                                                                     <?php $test=false;  ?>

                                                               <?php endif; ?>
                                                      <?php endif; ?>

                                                      <?php endfor; ?>
                                                    <?php if($v==$disponibilite[$x]->tranche): ?>

                                                      <?php if($test==false && $testeur!=$matiere[$a]->compte.'.'.$matiere[$a]->nom ): ?>
                                                      <?php if($matiere[$a]->nombre_heure<=0): ?>
                                                                  <option disabled style="color: red" ><?php echo e($matiere[$a]->nom.' Cours terminé '); ?>

                                                                  <?php else: ?>
                                                                  <option value="<?php echo e($disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom); ?>"><?php echo e($matiere[$a]->nom.' ( '.$matiere[$a]->nom_prof.' )'); ?>

                                                               <?php endif; ?>
                                                         <?php $testeur=''; ?>
                                                      <?php endif; ?>
                                                     <?php endif; ?>

                                                     <?php endif; ?>
                                                <?php endif; ?>
                                                <?php endfor; ?>
                                           <?php endfor; ?>
                                    </select>
                                    <input type="hidden" name="tranche_horaire" value="<?php echo e($c); ?>">
                                 </td>
                        <?php endif; ?>

                        <?php endfor; ?>

                     </tr>
               <?php endfor; ?>
                    <tr>
                        <td colspan="<?php echo e(sizeOf($configedt)+1); ?>">
                                <div class="centre">
                                        <input type="hidden" name="classe" value="<?php echo e($matiere[0]->classe); ?>">
                                        <input type="submit" value="Confirmer" class="btn btn-info" >
                                    </div>
                        </td>
                    </tr>

            </table>
</div>

<h3 class="card-title centre "><a href='<?php echo e(route('emploi_admin_path')); ?>'> Retour</a></h3>
     <?php endif; ?>
    <?php endif; ?>



</form>

</div>
<?php endif; ?>
<h3 class="card-title ">Dernier emploi de temps</a></h3>
<?php echo $__env->make('compte/layout_emploi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>

</div>
</div>
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/administration/layout/corpsEdt.blade.php ENDPATH**/ ?>