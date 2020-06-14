<?php if($paginator->hasPages()): ?>
    <ul class="pagination btn-sm" role="navigation" >
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">
                <span class="page-link" aria-hidden="true">précédent</span>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">précédent</a>
            </li>
        <?php endif; ?>


        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">suivant</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">
                <span class="page-link" aria-hidden="true">suivant</span>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
