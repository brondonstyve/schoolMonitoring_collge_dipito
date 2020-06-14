<?php

$jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );

if ($nombre<1){ } else { $date=new DateTime($resultat[0]->periode);
    $passeur=new DateTime($resultat[0]->periode);

    $jourChiffre=$date->format('w');
    switch ($jourChiffre) {
    case 0:
    $date->modify('+ 1 day');
    break;
    case 1:
    $date->modify('+ 7 day');
    break;
    case 2:
    $date->modify('+ 6 day');
    break;
    case 3:
    $date->modify('+ 5 day');
    break;
    case 4:
    $date->modify('+ 4 day');
    break;
    case 5:
    $date->modify('+ 3 day');
    break;
    case 6:
    $date->modify('+ 2 day');
    break;
    }
    switch ($jourChiffre) {
    case 0:
    break;
    case 1:
    $passeur->modify('+ 6 day');
    break;
    case 2:
    $passeur->modify('+ 5 day');
    break;
    case 3:
    $passeur->modify('+ 4 day');
    break;
    case 4:
    $passeur->modify('+ 3 day');
    break;
    case 5:
    $passeur->modify('+ 2 day');
    break;
    case 6:
    $passeur->modify('+ 1 day');
    break;
    }
    }




    ?>
<div class="" >
        <div id="add-con" class="modal fade in" role="dialog" style="">
            <div class="modal-dialog">
                <div class="modal-content col-xs-5">
                    <div class="modal-body ">
                            <ul class="nav nav-tabs profile-tab" >
                                <?php for($c = $init; $c < 22; $c++): ?> <li class="nav-item"> <a
                                        class="nav-link <?php if($c==$init): ?> active <?php endif; ?>" data-toggle="tab"
                                        href="<?php echo e('#semaine'.$c); ?>" role="tab" title=""> <?php if($c<10): ?> semaine
                                            <?php echo e('0'.$c); ?> <?php else: ?> semaine <?php echo e($c); ?> <?php endif; ?></a> </li> <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </div>



<div class="tab-content">
        <?php for($k = $init; $k < 22; $k++): ?>
        <div class="tab-pane <?php if($k==$init): ?> active <?php endif; ?>"
            id="semaine<?php echo e($k); ?>" role="tabpanel">
            <?php echo $__env->make('compte/layout_emploi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php endfor; ?>



</div>
