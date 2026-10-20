<?php $__env->startSection('title', 'Gerechten beheren'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <h1>Gerechten beheren</h1>
    <p><a class="btn" href="<?php echo e(route('admin.menu-items.create')); ?>">Nieuw gerecht</a></p>
    <form method="get" class="grid">
        <label>Zoeken <input name="search" value="<?php echo e(request('search')); ?>"></label>
        <label>Categorie <select name="category"><option value="">Alle</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>" <?php if(request('category') == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
        <label>&nbsp;<button class="btn">Filter</button></label>
    </form>
</div>
<div class="card">
    <table><tr><th>Nr</th><th>Naam</th><th>Categorie</th><th>Prijs</th><th>Actief</th><th>Actie</th></tr>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr><td><?php echo e($item->number); ?><?php echo e($item->suffix); ?></td><td><?php echo e($item->name); ?></td><td><?php echo e($item->category->name ?? '-'); ?></td><td>€ <?php echo e(number_format($item->price, 2, ',', '.')); ?></td><td><?php echo e($item->is_active ? 'Ja' : 'Nee'); ?></td><td class="actions"><a class="btn secondary" href="<?php echo e(route('admin.menu-items.edit', $item)); ?>">Bewerken</a><form method="post" action="<?php echo e(route('admin.menu-items.destroy', $item)); ?>" onsubmit="return confirm('Verwijderen?')"><?php echo csrf_field(); ?> <?php echo method_field('delete'); ?><button class="btn danger">Verwijder</button></form></td></tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo e($items->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/menu-items/index.blade.php ENDPATH**/ ?>