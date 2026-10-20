<?php $__env->startSection('title', 'Aanbiedingen - De Gouden Draak'); ?>
<?php $__env->startSection('content'); ?>
<div class="paper-card">
    <h1>Aanbiedingen van deze week</h1>
    <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="offer-highlight" style="margin-bottom:14px">
            <h2><?php echo e($offer->title); ?></h2>
            <?php if($offer->description): ?>
                <p><?php echo e($offer->description); ?></p>
            <?php endif; ?>
            <p><strong><?php echo e($offer->discountLabel()); ?></strong></p>
            <?php if($offer->menuItems->isNotEmpty()): ?>
                <p>Gerechten in deze actie: <?php echo e($offer->menuItems->pluck('name')->join(', ')); ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>Er zijn momenteel geen actieve aanbiedingen.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/website/offers.blade.php ENDPATH**/ ?>