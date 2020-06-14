<?php echo $__env->make('compte/entete_menu_bar', ['etat'=>'Bulletin trimestriel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('compte/corps_trimestre', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        @media  print{
          .ne_pas_imprimer{
              display: none;
          }
        }
        </style>
<?php echo $__env->make('compte/script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/index/trimestre.blade.php ENDPATH**/ ?>