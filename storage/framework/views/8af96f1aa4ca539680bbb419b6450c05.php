<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'De Gouden Draak'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
<div class="dragon-page">
    <header class="legacy-header">
        <a class="brand-block" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('legacy-assets/pictures/dragon-small.png')); ?>" alt="Golden Dragon">
            <span>De Gouden Draak</span>
            <img src="<?php echo e(asset('legacy-assets/pictures/dragon-small-flipped.png')); ?>" alt="Golden Dragon">
        </a>
        <a class="legacy-marquee" href="<?php echo e(route('offers.public')); ?>"><span>Welkom bij De Gouden Draak. Klik hier om de aanbiedingen van deze week te zien!</span></a>
        <a class="brand-block" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('legacy-assets/pictures/dragon-small.png')); ?>" alt="Golden Dragon">
            <span>De Gouden Draak</span>
            <img src="<?php echo e(asset('legacy-assets/pictures/dragon-small-flipped.png')); ?>" alt="Golden Dragon">
        </a>
    </header>
    <div class="legacy-frame">
        <div class="frame-content">
            <section class="hero">
                <div class="hero-dragons">
                    <img src="<?php echo e(asset('legacy-assets/pictures/dragon-small.png')); ?>" alt="Golden Dragon">
                    <div class="hero-title">
                        <span class="subtitle">Chinees Indische Specialiteiten</span>
                        <span class="name">De Gouden Draak</span>
                    </div>
                    <img src="<?php echo e(asset('legacy-assets/pictures/dragon-small-flipped.png')); ?>" alt="Golden Dragon">
                </div>
                <nav class="legacy-nav" aria-label="Hoofdnavigatie">
                    <a href="<?php echo e(route('menu.index')); ?>">Menukaart</a>
                    <a href="<?php echo e(route('news')); ?>">Nieuws</a>
                    <a href="<?php echo e(route('contact')); ?>">Contact</a>
                    <a href="<?php echo e(route('offers.public')); ?>">Aanbiedingen</a>
                    <a href="<?php echo e(route('orders.create')); ?>">Bestellen</a>
                    <a href="<?php echo e(route('pos.index')); ?>">Kassa</a>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Admin</a>
                </nav>
            </section>

            <?php if(session('success')): ?> <div class="alert"><?php echo e(session('success')); ?></div> <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="alert error"><strong>Controleer je invoer:</strong><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>