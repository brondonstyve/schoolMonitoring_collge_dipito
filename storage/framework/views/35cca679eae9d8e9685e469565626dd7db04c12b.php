
<div >
    <!-- Column -->


<?php if($utilisateur->type==null): ?>

<?php if($nombre<=0): ?>
<h2 class="card-title">Aucune note n'est disponible pour le moment</h2>
<?php else: ?>
<?php
        $credit=0;
        $coef_total=0;

?>
<?php for($g = 0; $g < sizeOf($groupe); $g++): ?>
<?php
        $noteg=array();
        $nb=0;
 ?>
<div class="col-md-12">
<h2 class="card-title">Groupe <?php echo e($g+1); ?> :<?php echo e($groupe[$g]->nom); ?></h2>

<?php for($i =0 ; $i <$nombre ; $i++): ?>

<?php if($groupe[$g]->id==$note[$i]->groupe): ?>

<?php
    $coef_total=$coef_total+$note[$i]->coef;
?>

<div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="text-left">
                    <span class="text-muted"><?php echo e($note[$i]->nom); ?></span>
                </div>
                <div class="text-right">
                  Crédit : <span class="text-muted"><?php echo e($note[$i]->coef); ?></span>
                </div>

                <h5 class="">Travaux Pratiques : <span style="color:<?php if($note[$i]->tp<5): ?> red <?php else: ?> <?php if($note[$i]->tp<12): ?> blue <?php else: ?> green <?php endif; ?> <?php endif; ?> ;float: right" ><?php echo e($note[$i]->tp); ?>/20</span> </h5>
                    <h5 class="">Controle continu &nbsp;&nbsp;: <span style="color:<?php if($note[$i]->CC<5): ?> red <?php else: ?> <?php if($note[$i]->CC<12): ?> blue <?php else: ?> green <?php endif; ?> <?php endif; ?>;float: right " ><?php echo e($note[$i]->CC); ?>/20</span> </h5>
                    <h5 class="">Session normale  &nbsp; :<span style="color:<?php if($note[$i]->SN<5): ?> red <?php else: ?> <?php if($note[$i]->SN<12): ?> blue <?php else: ?> green <?php endif; ?> <?php endif; ?>;float: right" ><?php echo e($note[$i]->SN); ?>/20</span></h5>
                         <?php
                             $comptNote=0;
                             $comptCoef=0;
                             $final=($note[$i]->CC*30/100)+($note[$i]->SN*70/100)
                         ?>
                    <h5 class="">Note finale &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="color:<?php if($final<5): ?> red <?php else: ?> <?php if($final<12): ?> blue <?php else: ?> green  <?php endif; ?> <?php endif; ?> ;float: right" ><?php echo e($final); ?>/20</h5>

                <span class="text-success"> <?php echo e(((($note[$i]->CC*30/100)+($note[$i]->SN*70/100))/20)*100); ?>%  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if($final<5): ?> danger <?php else: ?> <?php if($final<10): ?> Mauvais <?php else: ?>  <?php if($final<=12): ?>moyen <?php else: ?> bon <?php endif; ?> <?php endif; ?> <?php endif; ?> </span>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e(((($note[$i]->CC*30/100)+($note[$i]->SN*70/100))/20)*100); ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
        $noteg[$nb][0]=$note[$i]->nom;
        $noteg[$nb][1]=$note[$i]->coef;
        $noteg[$nb][2]=$final;
        $nb ++;
    ?>
<?php endif; ?>
<?php endfor; ?>

<?php for($i = 0; $i < sizeOf($noteg); $i++): ?>
    <?php if($noteg[$i][2]>=10): ?>
        <?php
            $credit=$credit+$noteg[$i][1];
        ?>
    <?php else: ?>
      <?php for($x = 0; $x < sizeOf($noteg); $x++): ?>

       <?php if($noteg[$x][2]>10): ?>
           <!--test d'égalité de coefficient-->
           <?php if($noteg[$x][1]==$noteg[$i][1]): ?>
           <!--test d'égalité de matiere-->
              <?php if($noteg[$x][0]!=$noteg[$i][0]): ?>
               <?php
                   $reste_mod=$noteg[$x][2]-10;
                   $reste=10-$noteg[$i][2];
               ?>
                 <!--modulation-->
                 <?php if($reste_mod >= $reste): ?>
                     <?php
                         $noteg[$x][2]=$noteg[$x][2]-$reste;
                         $noteg[$i][2]=$noteg[$i][2]+$reste;
                         $credit=$credit+$noteg[$i][1];
                       echo  '<code>'.$noteg[$x][0].' Module '. $noteg[$i][0].'</code>';
                     ?>
                 <?php endif; ?>
              <?php endif; ?>

           <?php else: ?>

             <?php if($noteg[$x][0]!=$noteg[$i][0]): ?>
               <?php
                   $reste_mod=($noteg[$x][2]-10)*$noteg[$x][1];
                   $reste=(10-$noteg[$i][2])*$noteg[$i][1];
               ?>
                 <!--modulation-->
                 <?php if($reste_mod >= $reste): ?>
                     <?php
                         $noteg[$x][2]=$noteg[$x][2]-($reste/$noteg[$x][1]);
                         $noteg[$i][2]=$noteg[$i][2]+($reste/$noteg[$i][1]);
                         $credit=$credit+$noteg[$i][1];
                       echo  '<code>'.$noteg[$x][0].' Module '. $noteg[$i][0].'</code>';
                     ?>
                 <?php endif; ?>
              <?php endif; ?>


           <?php endif; ?>
        <?php endif; ?>

      <?php endfor; ?>
    <?php endif; ?>
<?php endfor; ?>
</div>
<?php endfor; ?>





            <div class="col-md-10">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Bulletin instantané</b></h4>
                        <p class="text-muted font-14 m-b-20">
                            <code><?php echo e($credit); ?> crédit(s) cumulé(s) au total</code>

                        </p>

                        <div class="table-responsive">
                            <table class="table m-0 table-colored-full table-full-inverse table-hover btn-sm" style="color: white">
                                <thead>
                                <tr>
                                        <th>matière</th>
                                        <th>note CC(/20)</th>
                                        <th>note SN(/20)</th>
                                        <th>Note(/20)</th>
                                        <th>Coeficient</th>
                                        <th>total</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <?php for($i =0 ; $i <$nombre ; $i++): ?>
                                        <tr>
                                                <td><?php echo e($note[$i]->nom); ?></td>
                                                <td><?php echo e($note[$i]->CC); ?></td>
                                                <td><?php echo e($note[$i]->SN); ?></td>
                                                <td><?php echo e($total=($note[$i]->CC*30/100)+($note[$i]->SN*70/100)); ?></td>
                                                <td><?php echo e($note[$i]->coef); ?></td>
                                                <td><?php echo e($total*$note[$i]->coef); ?></td>
                                        </tr>
                                        <?php
                                         $comptNote=$comptNote+$total*$note[$i]->coef;
                                         $comptCoef=$comptCoef+$note[$i]->coef;
                                        ?>
                                        <?php endfor; ?>

                                        <tr>
                                                <td colspan="5" style="text-align: right;">moyenne</td>
                                                <td style="background-color: white"> <span style="color:<?php if($comptNote/$comptCoef<10): ?> red <?php else: ?> green <?php endif; ?> " ><?php echo e(number_format($comptNote/$comptCoef,2,',','')); ?></span> </td>

                                        </tr>

                                        <tr>
                                            <td colspan="5" style="text-align: right;">Coéficient</td>
                                            <td style="background-color: white"> <span style="color:<?php if($credit<$coef_total): ?> red <?php else: ?> green <?php endif; ?> " ><?php echo e($credit); ?></span> </td>

                                    </tr>

                                        <tr>
                                                <td colspan="5" style="text-align: right;">décision du conseil</td>
                                                <td style="background-color: white"> <span style="color:<?php if($comptNote/$comptCoef<10): ?> red <?php else: ?> green <?php endif; ?> " ><?php if($comptNote/$comptCoef<10 || $credit<$coef_total): ?> Echec <?php else: ?> admis <?php endif; ?> </span> </td>
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

<?php endif; ?>

<?php else: ?>


<?php if($utilisateur->type=="enseignant"): ?>

<div class="card-body">

        <h4 class="card-title">Mes salles de classes</h4>

                <?php for($i =0 ; $i <sizeOf($classe) ; $i++): ?>
                <div class="col-lg-3 col-md-6" style="color: black">
                        <div class="card" style="background-color: aliceblue">
                            <div class="card-body" >
                                <div class="row p-t-10 p-b-10">
                <a class="nav-link  active btn-sm">
                     Fiche <?php echo e($i+1); ?> : <?php echo e($classe[$i]->classe); ?>

                     <hr>
                     <span><?php echo e($classe[$i]->nom); ?></span>
                     <form action="<?php echo e(route('remplir_note_path')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                         <input type="hidden" name="classe" value="<?php echo e($classe[$i]->classe); ?>">
                         <input type="hidden" name="id" value="<?php echo e($classe[$i]->id); ?>">
                            <input type="submit" value="Liste des étudiants" class="btn-sm">
                    </form>
                </a>
        </div></div></div></div>
                <?php endfor; ?>

<?php if(!$ouverture): ?>
  <h4 class="card-title">...</h4>

<?php else: ?>

       <?php if(sizeOf($liste)==0): ?>
          <h3 class="card-title">erreur </h3>
       <?php else: ?>
       <div class="card-body" >
            <div style="color: black">
            <div id="visitor" >

                    <div class="table-responsive m-t-20">
                        <form action="<?php echo e(route('inserer_note_path')); ?>" method="post" style="padding: 5%">
                            <?php echo e(csrf_field()); ?>

                                <h3 class="card-title">liste des étudiants de la <?php echo e($liste[0]->classe); ?> </h3>
                            <table class="table stylish-table" >
                                <thead>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>TD</th>
                                            <th>CC</th>
                                            <th>SN</th>
                                            <th>final</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php
                                        $space="";
                                    ?>
                        <?php for($i = 0; $i < $listec; $i++): ?>
                             <tr class="">

                                    <td><?php echo e($i+1); ?></td>
                                    <td><?php echo e($liste[$i]->nom); ?></td>
                                    <td><?php echo e($liste[$i]->prenom); ?></td>
                                    <?php
                                    $vide=false;
                                  ?>
                                    <?php for($a = 0; $a < sizeOf($remplisseur); $a++): ?>
                                    <?php
                                     $vide=false;
                                     $ver=false;
                                      ?>
                                    <?php if($remplisseur[$a]->compte==$liste[$i]->id): ?>
                                    <td><input type="text" size="7" value='<?php if(sizeOf($remplisseur)==0): ?><?php echo e(0); ?><?php else: ?> <?php if(sizeOf($remplisseur)>$a): ?><?php echo e($remplisseur[$a]->tp); ?><?php else: ?><?php echo e(0); ?><?php endif; ?><?php echo e($space); ?><?php endif; ?>' disabled></td>
                                    <td><input type="number" name="cc<?php echo e($i); ?>" size="7" value="<?php if(sizeOf($remplisseur)==0): ?><?php echo e(0); ?><?php else: ?><?php echo e($space); ?><?php if(sizeOf($remplisseur)>$a): ?><?php echo e($remplisseur[$a]->CC); ?><?php else: ?><?php echo e(0); ?><?php endif; ?><?php echo e($space); ?><?php endif; ?>" required min="0" max="20" step="0.01"></td>
                                    <td><input type="number" name="sn<?php echo e($i); ?>" size="7" value="<?php if(sizeOf($remplisseur)==0): ?><?php echo e(0); ?><?php else: ?><?php echo e($space); ?><?php if(sizeOf($remplisseur)>$a): ?><?php echo e($remplisseur[$a]->SN); ?><?php else: ?><?php echo e(0); ?><?php endif; ?><?php echo e($space); ?><?php endif; ?>" required min="0" max="20" step="0.01"></td>
                                    <td><input type="text" size="7" value="<?php if(sizeOf($remplisseur)==0): ?><?php echo e(0); ?><?php else: ?> <?php if(sizeOf($remplisseur)>$a): ?><?php echo e($total=($remplisseur[$a]->CC*30/100)+($remplisseur[$a]->SN*70/100)); ?><?php else: ?><?php echo e(0); ?><?php endif; ?><?php echo e($space); ?><?php endif; ?>" disabled></td>

                                    <?php break; ?>
                                        <?php else: ?>
                                    <?php if($a < sizeOf($remplisseur)): ?>
                                      <?php
                                        $ver=true;
                                        $vide=true;

                                      ?>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                     <?php endfor; ?>

                                     <?php if(sizeOf($remplisseur)>0): ?>
                                     <?php if($a == sizeOf($remplisseur) && $ver): ?>

                                     <td><input type="text" size="7" value='0' disabled></td>
                                     <td><input type="number" name="cc<?php echo e($i); ?>" size="7" value='0' required min="0" max="20" step="0.01"></td>
                                     <td><input type="number" name="sn<?php echo e($i); ?>" size="7" value="0" required min="0" max="20" step="0.01"></td>
                                     <td><input type="text" size="7" value="0" disabled></td>

                                     <?php endif; ?>
                                     <?php endif; ?>


                                    <?php if($a == sizeOf($remplisseur) && !$vide): ?>

                                    <td><input type="text" size="7" value='0' disabled></td>
                                    <td><input type="number" name="cc<?php echo e($i); ?>" size="7" value='0' required min="0" max="20" step="0.01"></td>
                                    <td><input type="number" name="sn<?php echo e($i); ?>" size="7" value="0" required min="0" max="20" step="0.01"></td>
                                    <td><input type="text" size="7" value="0" disabled></td>

                                    <?php endif; ?>

                                    <input type="hidden" size="4" name="id_matiere<?php echo e($i); ?>" value="<?php echo e($id); ?>">
                                    <input type="hidden" size="4" name="id_compte<?php echo e($i); ?>" value="<?php echo e($liste[$i]->id); ?>">

                                </tr>

                        <?php endfor; ?>


                    </tbody>
                </table>
                <input type="hidden" name="compteur" value="<?php echo e($listec); ?>">
                <input type="submit" value="Soumettre">
            </form>
            </div>
        </div>
        </div>
       <?php endif; ?>

<?php endif; ?>




<?php else: ?>

<?php endif; ?>
<?php endif; ?>


    <!-- Column -->
</div>
<?php /**PATH C:\laragon\www\StandPlace primaire\resources\views/compte/corpsNote.blade.php ENDPATH**/ ?>