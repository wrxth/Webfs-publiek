<?php $__env->startSection('title', 'Menukaart'); ?>
<?php $__env->startSection('content'); ?>
<div class="paper-card">
    <h1>Menukaart</h1>
    <form method="get" action="<?php echo e(route('menu.index')); ?>" style="margin-top:16px">
        <label>Zoeken op gerecht, nummer of omschrijving
            <input name="search" value="<?php echo e(request('search')); ?>" placeholder="Zoek in de menukaart">
        </label>
        <button class="btn">Zoeken</button>
        <a class="btn secondary" href="<?php echo e(route('menu.index')); ?>">Reset</a>
    </form>
</div>

<?php if($activeOffers->isNotEmpty()): ?>
    <section class="paper-card">
        <h2>Actieve aanbiedingen</h2>
        <div class="grid">
            <?php $__currentLoopData = $activeOffers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="offer-highlight">
                    <h3><?php echo e($offer->title); ?></h3>
                    <?php if($offer->description): ?>
                        <p><?php echo e($offer->description); ?></p>
                    <?php endif; ?>
                    <p><strong><?php echo e($offer->discountLabel()); ?></strong></p>
                    <?php if($offer->menuItems->isNotEmpty()): ?>
                        <p>Gerechten: <?php echo e($offer->menuItems->pluck('name')->join(', ')); ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php endif; ?>

<div id="vue-menu-favorites" data-items='<?php echo json_encode($allItems, JSON_HEX_APOS | JSON_HEX_QUOT, 512) ?>'></div>

<?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if($category->items->count()): ?>
        <section class="paper-card">
            <h2 class="menu-category-title"><?php echo e($category->name); ?></h2>
            <table>
                <tbody>
                <?php $__currentLoopData = $category->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="width:90px"><?php echo e($item->number); ?><?php echo e($item->suffix); ?></td>
                        <td><strong><?php echo e(strip_tags($item->name)); ?></strong><?php if($item->description): ?><br><span class="muted"><?php echo e(strip_tags($item->description)); ?></span><?php endif; ?></td>
                        <td class="price">€ <?php echo e(number_format($item->price, 2, ',', '.')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </section>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="paper-card">Nog geen gerechten gevonden.</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/website/menu/index.blade.php ENDPATH**/ ?>