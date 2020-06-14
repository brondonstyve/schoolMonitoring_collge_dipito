<?php if(sizeOf($note)<=0): ?>
<h2 class="card-title">Aucune note n'est disponible pour le moment</h2>
<?php else: ?>


<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Liste des séquences</h4>
            <ul class="nav nav-pills m-t-30 m-b-30" style="margin-top: -10px">
                <?php for($i = 0; $i < $sekuence[0]->nbsequence; $i++): ?>
                <?php
                $cc=0;
                $sequence=0;
                $parcoureur=0;
                $trimestre=0;
            ?>
            <?php for($i = 0; $i < $sekuence[0]->nbsequence; $i++): ?>
            <li class="nav-item">

                    <?php if($parcoureur<2): ?>
                    <a class="nav-link  <?php if($i+1==$sek): ?> active <?php endif; ?> " href=" <?php echo e(route('mesNotes_path')); ?>?sek=<?php echo e($i+1); ?>" role="tab" title="">
                         CC <?php echo e(++$cc); ?>

                      </a>
                    <?php
                            $parcoureur=$parcoureur+1;
                        ?>

                     <?php else: ?>
                    <a class="nav-link  <?php if($i+1==$sek): ?> active <?php endif; ?> " href=" <?php echo e(route('mesNotes_path')); ?>?sek=<?php echo e($i+1); ?>" role="tab" title="">
                        Séquence <?php echo e(++$sequence); ?>

                      </a>
                      <?php
                         $parcoureur=$parcoureur+1;
                     ?>

                     <?php if($parcoureur==4): ?>
                     <li class="nav-item">
                      <a class="nav-link btn btn-default" href="" title="" >
                        Trimestre <?php echo e(++ $trimestre); ?>

                      </a>
                    </li>
                      <?php
                      $parcoureur=0;
                     ?>

                     <?php endif; ?>



                    <?php endif; ?>

            </li>
            <?php endfor; ?>
                <?php endfor; ?>
            </ul>







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

<?php for($i =0 ; $i <sizeOf($note) ; $i++): ?>

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
                  Coéficient : <span class="text-muted"><?php echo e($note[$i]->coef); ?></span>
                </div>

                <h5 class="">Note : <span style="color:<?php if($note[$i]->note<5): ?> red <?php else: ?> <?php if($note[$i]->note<12): ?> blue <?php else: ?> green <?php endif; ?> <?php endif; ?> ;float: right" ><?php echo e($note[$i]->note); ?>/20</span> </h5>
                         <?php
                             $comptNote=0;
                             $comptCoef=0;
                             $final=($note[$i]->note*$note[$i]->coef)
                         ?>
                    <h5 class="">Note finale : <span style="color:<?php if($final<5): ?> red <?php else: ?> <?php if($final<12): ?> blue <?php else: ?> green  <?php endif; ?> <?php endif; ?> ;float: right" ><?php echo e($final); ?>/<?php echo e(20*$note[$i]->coef); ?></h5>

                <span class="text-success"> <?php echo e((( $note[$i]->note )/20)*100); ?>%  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if($note[$i]->note<5): ?> danger <?php else: ?> <?php if($note[$i]->note<10): ?> Mauvais <?php else: ?>  <?php if($note[$i]->note<=12): ?>moyen <?php else: ?> bon <?php endif; ?> <?php endif; ?> <?php endif; ?> </span>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e((($note[$i]->note)/20)*100); ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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





</div>
<?php endfor; ?>

</div>
</div>
</div>





<?php
    $tot=0;
?>


            <div class="col-md-10">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Bulletin instantané de pour

                            <?php switch($sek):
                                                        case (1): ?>
                                                          le CC 1
                                                            <?php break; ?>
                                                        <?php case (2): ?>
                                                           le CC 2
                                                            <?php break; ?>
                                                            <?php case (3): ?>
                                                            la Séquence 1
                                                            <?php break; ?>
                                                        <?php case (4): ?>
                                                        la Séquence 2
                                                            <?php break; ?>
                                                            <?php case (5): ?>
                                                            le CC 3
                                                            <?php break; ?>
                                                        <?php case (6): ?>
                                                        le CC 4
                                                            <?php break; ?>
                                                            <?php case (7): ?>
                                                            la  Séquence 3
                                                            <?php break; ?>
                                                        <?php case (8): ?>
                                                          la  Séquence 4
                                                            <?php break; ?>
                                                            <?php case (9): ?>
                                                            le CC 5
                                                            <?php break; ?>
                                                        <?php case (10): ?>
                                                        le CC 6
                                                            <?php break; ?>
                                                            <?php case (11): ?>
                                                          Séquence 5
                                                            <?php break; ?>
                                                        <?php case (12): ?>
                                                            Séquence 6
                                                            <?php break; ?>
                                                        <?php default: ?>

                                                    <?php endswitch; ?>

                        </b></h4>

                        <div class="table-responsive">
                            <table class="table m-0 table-colored-full table-full-inverse table-hover btn-sm" style="color: white">
                                <thead>
                                <tr>
                                        <th>matière</th>
                                        <th>Note(/20)</th>
                                        <th>Coeficient</th>
                                        <th>total</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <?php for($i =0 ; $i <sizeOf($classeE) ; $i++): ?>
                                          <tr>
                                                <td><?php echo e($classeE[$i]->nom); ?></td>
                                                <td><?php for($n = 0; $n < sizeOf($note); $n++): ?>
                                                    <?php
                                                        $bare=false;
                                                    ?>
                                                      <?php if($note[$n]->id==$classeE[$i]->id && $note[$n]->sequence==$sek): ?>
                                                         <?php echo e($note[$n]->note); ?>

                                                         <?php break; ?>
                                                         <?php else: ?>
                                                         <?php
                                                             $bare=true;
                                                         ?>
                                                      <?php endif; ?>
                                                    <?php endfor; ?>
                                                    <?php if($bare): ?>
                                                      /
                                                    <?php endif; ?>
                                                </td>

                                                <td><?php echo e($classeE[$i]->coef); ?></td>
                                                <td>
                                                    <?php if($n>=sizeOf($note)): ?>
                                                        /
                                                    <?php else: ?>
                                                       <?php echo e($note[$n]->note*$classeE[$i]->coef); ?>

                                                    <?php endif; ?>

                                                </td>
                                          </tr>
                                          <?php
                                          if ($n>=sizeOf($note)) {
                                            $comptNote= $comptNote + 0;
                                          } else {
                                            $comptNote= $comptNote + $note[$n]->note*$classeE[$i]->coef;
                                          }

                                           $comptCoef=$comptCoef+$classeE[$i]->coef;
                                          ?>
                                        <?php endfor; ?>

                                        <tr>
                                                <td class="text-right"></td>
                                                <td class="text-right">total coéficient</td>
                                                <td > <span><?php echo e($comptCoef); ?></span> <span style="float: right">Total de points</span></td>
                                                <td><?php echo e($comptNote); ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" style="text-align: right;">Moyenne</td>
                                            <td style="background-color: white"> <span style="color:<?php if($comptNote/$comptCoef<10): ?> red <?php else: ?> green <?php endif; ?> " ><?php echo e(number_format($comptNote/$comptCoef,2,',','')); ?></span> </td>

                                        </tr>

                                        <tr>
                                            <td colspan="3" style="text-align: right;">décision du conseil</td>
                                            <td style="background-color: white;text-transform: uppercase"> <span style="color:<?php if($comptNote/$comptCoef<10): ?> red <?php else: ?> green <?php endif; ?> " ><?php if($comptNote/$comptCoef<10): ?> échec <?php else: ?> admis <?php endif; ?> </span> </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

<?php endif; ?>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/compte/sousCompte/notesEtudiant.blade.php ENDPATH**/ ?>