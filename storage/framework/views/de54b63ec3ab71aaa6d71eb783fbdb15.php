<?php $__env->startSection('title', 'Admin dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <h1>Admin dashboard</h1>
    <p class="actions">
        <a class="btn" href="<?php echo e(route('admin.menu-items.index')); ?>">Gerechten beheren</a>
        <a class="btn" href="<?php echo e(route('admin.offers.index')); ?>">Aanbiedingen beheren</a>
    </p>
</div>
<div class="grid">
    <div class="card">
        <h2>Tafel registreren</h2>
        <form method="post" action="<?php echo e(route('admin.table-sessions.store')); ?>">
            <?php echo csrf_field(); ?>
            <label>Tafel
                <select name="restaurant_table_id" required>
                    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($table->id); ?>"><?php echo e($table->code); ?> (<?php echo e($table->seats); ?> plaatsen)</option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>
            <label>Aantal gasten <input type="number" name="guest_count" min="1" max="8" value="2" required></label>
            <label>Leeftijden gasten <input name="guest_ages[]" placeholder="Gast 1 leeftijd"></label>
            <label><input name="guest_ages[]" placeholder="Gast 2 leeftijd"></label>
            <label><input name="guest_ages[]" placeholder="Gast 3 leeftijd (optioneel)"></label>
            <label><input name="guest_ages[]" placeholder="Gast 4 leeftijd (optioneel)"></label>
            <label><input style="width:auto" type="checkbox" name="deluxe_menu" value="1"> Luxe menu</label>
            <button class="btn">Open tafel</button>
        </form>
    </div>
    <div class="card">
        <h2>Open tafels</h2>
        <table><tr><th>Tafel</th><th>Gasten</th><th>Actie</th></tr>
            <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr><td><?php echo e($session->table->code); ?></td><td><?php echo e($session->guest_count); ?><br><span class="muted">Leeftijden: <?php echo e(collect($session->guest_ages)->filter()->join(", ") ?: "-"); ?><br>Luxe: <?php echo e($session->deluxe_menu ? "ja" : "nee"); ?></span></td><td class="actions"><a class="btn secondary" href="<?php echo e(route('tablet.show', $session)); ?>">Tablet</a><form method="post" action="<?php echo e(route('admin.table-sessions.close', $session)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('patch'); ?><button class="btn danger">Sluiten</button></form></td></tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
</div>
<div class="card">
    <h2>Hulpvragen</h2>
    <table><tr><th>Tafel</th><th>Bericht</th><th>Status</th><th>Actie</th></tr>
        <?php $__currentLoopData = $helpRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $help): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr><td><?php echo e($help->tableSession->table->code ?? '-'); ?></td><td><?php echo e($help->message ?: 'Geen bericht'); ?></td><td><?php echo e($help->status); ?></td><td><?php if($help->status !== 'handled'): ?><form method="post" action="<?php echo e(route('help-requests.update', $help)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('patch'); ?><button class="btn">Afhandelen</button></form><?php endif; ?></td></tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>