<?php $__env->startSection('title','StandPlace ne fonctionne pas'); ?>
 

<?php $__env->startSection('message','Désolé la page ne fonctionne pas!'); ?>
    

<?php echo $__env->make('errors::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>