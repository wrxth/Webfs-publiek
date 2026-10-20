<?php $__env->startSection('title', 'Tablet tafel ' . $tableSession->table->code); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <h1>Tablet - tafel <?php echo e($tableSession->table->code); ?></h1>
    <p>Ronde <?php echo e(($tableSession->orders()->max('round_number') ?? 0) + 1); ?> van maximaal 5.</p>
    <form method="post" action="<?php echo e(route('tablet.help.store', $tableSession)); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="message" value="Klant vraagt om hulp aan tafel <?php echo e($tableSession->table->code); ?>">
        <button class="btn secondary">Roep bediening</button>
    </form>
</div>
<div class="card">
    <h2>Bestelling plaatsen</h2>
    <form method="post" action="<?php echo e(route('tablet.orders.store', $tableSession)); ?>">
        <?php echo csrf_field(); ?>
        <div id="vue-order-builder"
             data-items='<?php echo json_encode($items, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'
             data-rice-options='<?php echo json_encode($riceOptions, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'
             data-order-history='<?php echo json_encode($orderHistory, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'></div>
        <br><button class="btn">Plaats ronde</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/tablet/show.blade.php ENDPATH**/ ?>