<?php echo $__env->make('layout.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/imgcours', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/borduredecours', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="main-content" class="col-sm-12 col-md-9 col-sm-12 col-xs-12 pull-right">
        <main id="main" class="site-main layout-course" role="main">

<?php for($i = 1; $i < 2; $i++): ?>

<?php echo $__env->make('layout/listecours',['cours'=>$i], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endfor; ?>

</div>
</main>
</div>
</div>
</section>

<?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layout/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/fin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/index/coursfi.blade.php ENDPATH**/ ?>