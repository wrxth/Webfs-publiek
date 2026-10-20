<?php $__env->startSection('title', 'Bedankt voor je ronde'); ?>
<?php $__env->startSection('content'); ?>
<?php
    $reviewUrl = route('reviews.show', $order);
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' . urlencode($reviewUrl);
?>
<div class="review-hero-card">
    <div class="review-hero-copy">
        <span class="review-kicker">Ronde <?php echo e($order->round_number); ?> is ontvangen</span>
        <h1>Bedankt, tafel <?php echo e($tableSession->table->code); ?>!</h1>
        <p>De keuken is aan de slag met bestelling <strong><?php echo e($order->order_number); ?></strong>. Scan later de QR-code en laat weten hoe het was.</p>
    </div>
    <div class="review-qr-panel">
        <img class="qr-print qr-print-large" alt="QR code naar reviewformulier" src="<?php echo e($qrUrl); ?>">
    </div>
</div>

<div class="grid review-summary-grid">
    <div class="paper-card">
        <h2>Wat staat er in deze ronde?</h2>
        <div class="review-order-list">
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $details = array_filter([
                        $item->menuItem?->number ? 'Nr. ' . $item->menuItem->number : null,
                        $item->note,
                    ]);
                ?>
                <div class="review-order-line">
                    <strong><?php echo e($item->quantity); ?>x <?php echo e($item->menuItem?->name); ?></strong>
                    <?php if($details): ?>
                        <span class="muted"><?php echo e(implode(' | ', $details)); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p class="summary"><strong>Totaal:</strong> &euro; <?php echo e(number_format($order->total, 2, ',', '.')); ?></p>
    </div>

    <div class="paper-card">
        <h2>Review later openen</h2>
        <p>Handig als je de QR-code niet direct wilt scannen.</p>
        <p><a class="btn" href="<?php echo e($reviewUrl); ?>">Open reviewformulier</a></p>
        <p><a class="btn secondary" href="<?php echo e(route('tablet.show', $tableSession)); ?>">Terug naar tablet</a></p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/tablet/orders/thank-you.blade.php ENDPATH**/ ?>