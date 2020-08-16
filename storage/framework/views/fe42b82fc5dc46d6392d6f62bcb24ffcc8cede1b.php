<?php $__env->startComponent('mail::message'); ?>
# Monsieur / Madame <br>
<ul>
      <li>  <?php echo e($nom); ?>

      <li>  <?php echo e($email); ?>

</ul>


<?php $__env->startComponent('mail::panel'); ?>
<?php echo e($text); ?>


<?php echo $__env->renderComponent(); ?>

Merci,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/emails/messages/create.blade.php ENDPATH**/ ?>