<?php $__env->startSection('title', 'Bedankt'); ?>
<?php $__env->startSection('content'); ?>
<?php
    $reviewUrl = route('reviews.show', $order);
    $orderSummary = collect($order->items)->map(function ($item) {
        $number = trim(($item->menuItem?->number ?? '') . ($item->menuItem?->suffix ?? ''));
        $label = trim(($number ? $number . ' ' : '') . ($item->menuItem?->name ?? 'Onbekend gerecht'));

        return $item->quantity . 'x ' . $label;
    })->implode("\n");
    $qrPayload = trim("De Gouden Draak\nBestelnummer: {$order->order_number}\nType: " . ($order->type === 'delivery' ? 'Bezorgen' : 'Afhalen') . "\nItems:\n{$orderSummary}");
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' . urlencode($qrPayload);
?>
<div class="paper-card review-thank-you-card" style="text-align:center">
    <h1>Bedankt voor je bestelling!</h1>
    <p>Bestelnummer: <strong><?php echo e($order->order_number); ?></strong></p>
    <p>Type: <strong><?php echo e($order->type === 'delivery' ? 'Bezorgen' : 'Afhalen'); ?></strong></p>
    <?php if($order->type === 'delivery'): ?>
        <p><?php echo e($order->customer_address); ?>, <?php echo e($order->customer_postcode); ?> <?php echo e($order->customer_city); ?></p>
    <?php endif; ?>
    <p>Totaal: <strong>&euro; <?php echo e(number_format($order->total, 2, ',', '.')); ?></strong></p>
    <?php if($order->items->isNotEmpty()): ?>
        <div class="review-order-list" style="text-align:left; margin: 1rem auto; max-width: 34rem;">
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="review-order-line">
                    <strong><?php echo e($item->quantity); ?>x <?php echo e(trim(($item->menuItem?->number ?? '') . ($item->menuItem?->suffix ?? ''))); ?> <?php echo e($item->menuItem?->name); ?></strong>
                    <?php if($item->note): ?>
                        <span class="muted"><?php echo e($item->note); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <p>Scan of print de QR-code als compacte orderbon met bestelnummer en gekozen gerechten.</p>
    <img class="qr-print qr-print-large" alt="QR code met orderoverzicht" src="<?php echo e($qrUrl); ?>">
    <p><a class="btn" href="<?php echo e($reviewUrl); ?>">Open reviewformulier</a></p>
    <p class="actions" style="justify-content:center">
        <a class="btn" href="<?php echo e(route('menu.index')); ?>">Terug naar menukaart</a>
        <button class="btn secondary" onclick="window.print()">Print bestelling</button>
    </p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/website/orders/thank-you.blade.php ENDPATH**/ ?>