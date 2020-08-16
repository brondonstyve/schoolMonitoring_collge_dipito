<?php
$reponse = array('a','b','c','d');
?>

<?php if($utilisateur->type==null): ?>

<?php echo $__env->make('compte/sousCompte/eval_etudiant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php else: ?>

<?php echo $__env->make('compte/sousCompte/eval_enseignant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>

<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/compte/corpsEvaluation.blade.php ENDPATH**/ ?>