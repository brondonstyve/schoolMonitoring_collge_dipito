
<div >
    <!-- Column -->


<?php if($utilisateur->type==null): ?>

<?php echo $__env->make('compte/sousCompte/notesEtudiant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php else: ?>


<?php if($utilisateur->type=="enseignant"): ?>
<?php echo $__env->make('compte/sousCompte/notesProfesseur', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php endif; ?>


    <!-- Column -->
</div>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/compte/corpsNote.blade.php ENDPATH**/ ?>