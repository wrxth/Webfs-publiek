<?php $__env->startSection('title', 'Bestelling plaatsen'); ?>
<?php $__env->startSection('content'); ?>
<div class="paper-card">
    <h1>Afhalen of bezorgen</h1>
    <p class="muted">Stel je bestelling samen met Vue: zoeken, rijst-/bami-opties, opmerkingen per gerecht en een live totaaloverzicht.</p>
    <form method="post" action="<?php echo e(route('orders.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="grid">
            <label>Naam <input name="customer_name" value="<?php echo e(old('customer_name')); ?>" required></label>
            <label>Telefoon <input name="customer_phone" value="<?php echo e(old('customer_phone')); ?>"></label>
        </div>
        <label>Bestelwijze
            <select name="type" id="order-type" required>
                <option value="takeaway" <?php if(old('type') === 'takeaway'): echo 'selected'; endif; ?>>Afhalen</option>
                <option value="delivery" <?php if(old('type') === 'delivery'): echo 'selected'; endif; ?>>Bezorgen (+ €2,50)</option>
            </select>
        </label>
        <div class="grid">
            <label>Adres voor bezorging <input name="customer_address" value="<?php echo e(old('customer_address')); ?>" placeholder="Alleen nodig bij bezorgen"></label>
            <label>Postcode <input name="customer_postcode" value="<?php echo e(old('customer_postcode')); ?>" placeholder="Bijv. 5223 DE"></label>
            <label>Plaats <input name="customer_city" value="<?php echo e(old('customer_city', "'s-Hertogenbosch")); ?>"></label>
        </div>
        <label>Opmerking <textarea name="notes" placeholder="Bijv. graag bellen bij aankomst"><?php echo e(old('notes')); ?></textarea></label>

        <div id="vue-order-builder"
             data-items='<?php echo json_encode($items, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'
             data-rice-options='<?php echo json_encode($riceOptions, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'></div>

        <br><button class="btn">Bestelling plaatsen</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/website/orders/create.blade.php ENDPATH**/ ?>