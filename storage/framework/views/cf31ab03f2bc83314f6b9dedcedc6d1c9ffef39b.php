<?php echo $__env->make('administration/layout/entete_menu_bar' , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
$fil=$reponse[0]->nom;
?>
<?php echo $__env->make('administration/layout/dash',['stat'=>"Liste des paiements des $fil.s"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('administration/layout/corpsListeTranche', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="//code.jquery.com/jquery.min.js"></script>
   <?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('administration/layout/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('administration/layout/script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/administration/liste_tranche.blade.php ENDPATH**/ ?>