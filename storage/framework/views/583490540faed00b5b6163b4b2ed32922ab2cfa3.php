<?php $__env->startSection('title','StudentPlace ne fonctionne pas'); ?>


<?php $__env->startSection('message','Désolé la base de données est momentanément indisponible!'); ?>


<?php echo $__env->make('errors::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>