<?php $__env->startSection('title', 'Kassa'); ?>
<?php $__env->startSection('content'); ?>
<div
    id="vue-pos-search"
    data-search-url="<?php echo e(route('pos.search')); ?>"
    data-categories='<?php echo json_encode($categories, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'
    data-rice-options='<?php echo json_encode($riceOptions, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'
    data-note-suggestions='<?php echo json_encode($noteSuggestions, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'
></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/pos/index.blade.php ENDPATH**/ ?>