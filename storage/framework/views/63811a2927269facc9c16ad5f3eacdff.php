<?php $__env->startSection('title', 'Welkom - De Gouden Draak'); ?>
<?php $__env->startSection('content'); ?>
<div class="paper-card" style="text-align:center">
    <h2>Al jaren een begrip in 's-Hertogenbosch</h2>
    <p>De Gouden Draak serveert authentieke Chinees-Indische specialiteiten uit de Cantonese keuken.</p>
    <div class="offer-highlight">
        <h2><u>Speciale Studentenaanbieding</u></h2>
        <h1>Chinese Rijsttafel voor 2 personen</h1>
        <p>Maak een keuze uit 3 keuzegerechten. Met witte rijst, nasi of bami tegen meerprijs.</p>
        <p><strong>Prijs: €21,00</strong></p>
    </div>
    <p class="actions" style="justify-content:center; margin-top:20px">
        <a class="btn" href="<?php echo e(route('menu.index')); ?>">Bekijk menukaart</a>
        <a class="btn secondary" href="<?php echo e(route('orders.create')); ?>">Afhalen of bezorgen</a>
    </p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/website/home.blade.php ENDPATH**/ ?>