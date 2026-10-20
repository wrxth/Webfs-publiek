<?php $__env->startSection('title', 'Review voor bestelling ' . $order->order_number); ?>
<?php $__env->startSection('content'); ?>
<?php
    $review = $order->review;
    $questions = [
        'rating_food' => [
            'title' => 'Hoe smaakte het eten?',
            'hint' => 'Van eerste hap tot laatste bite.',
            'labels' => [1 => 'Kan beter', 2 => 'Matig', 3 => 'Prima', 4 => 'Erg goed', 5 => 'Fantastisch'],
        ],
        'rating_speed' => [
            'title' => 'Hoe vond je de snelheid?',
            'hint' => 'Kwam je bestelling op een fijn tempo door?',
            'labels' => [1 => 'Te traag', 2 => 'Aan de langzame kant', 3 => 'Prima', 4 => 'Vlot', 5 => 'Supersnel'],
        ],
        'rating_service' => [
            'title' => 'Hoe vriendelijk was ons team?',
            'hint' => 'Service, aandacht en gastvrijheid.',
            'labels' => [1 => 'Onpersoonlijk', 2 => 'Kan warmer', 3 => 'Netjes', 4 => 'Heel vriendelijk', 5 => 'Topservice'],
        ],
    ];
?>

<div class="review-hero-card">
    <div class="review-hero-copy">
        <span class="review-kicker">Reviewformulier</span>
        <h1>Hoe was jouw ervaring bij De Gouden Draak?</h1>
        <p>
            Bestelling <strong><?php echo e($order->order_number); ?></strong>
            <?php if($order->type === 'table' && $order->tableSession?->table): ?>
                voor tafel <strong><?php echo e($order->tableSession->table->code); ?></strong>
            <?php endif; ?>
            <?php if($order->ordered_at): ?>
                van <?php echo e($order->ordered_at->format('d-m-Y H:i')); ?>

            <?php endif; ?>
        </p>
    </div>
    <div class="review-hero-stats">
        <div class="review-stat">
            <span class="review-stat-label">Besteltype</span>
            <strong><?php echo e($order->type === 'delivery' ? 'Bezorgen' : ($order->type === 'table' ? 'Restaurant' : 'Afhalen')); ?></strong>
        </div>
        <div class="review-stat">
            <span class="review-stat-label">Items</span>
            <strong><?php echo e($order->items->sum('quantity')); ?></strong>
        </div>
        <div class="review-stat">
            <span class="review-stat-label">Totaal</span>
            <strong>&euro; <?php echo e(number_format($order->total, 2, ',', '.')); ?></strong>
        </div>
    </div>
</div>

<?php if($review): ?>
    <div class="paper-card review-complete-card">
        <h2>Bedankt voor je review!</h2>
        <p>We hebben je feedback goed ontvangen. Hiermee kunnen we onze keuken en service blijven verbeteren.</p>
        <div class="review-score-grid">
            <div class="review-score-pill">
                <span>Eten</span>
                <strong><?php echo e($review->rating_food); ?>/5</strong>
            </div>
            <div class="review-score-pill">
                <span>Snelheid</span>
                <strong><?php echo e($review->rating_speed); ?>/5</strong>
            </div>
            <div class="review-score-pill">
                <span>Vriendelijkheid</span>
                <strong><?php echo e($review->rating_service); ?>/5</strong>
            </div>
        </div>
        <?php if($review->comment): ?>
            <div class="summary">
                <strong>Opmerking:</strong>
                <p><?php echo e($review->comment); ?></p>
            </div>
        <?php endif; ?>
        <p><a class="btn secondary" href="<?php echo e(route('menu.index')); ?>">Terug naar de menukaart</a></p>
    </div>
<?php else: ?>
    <form method="post" action="<?php echo e(route('reviews.store', $order)); ?>" class="review-form-shell">
        <?php echo csrf_field(); ?>
        <div class="paper-card">
            <h2>Vertel het ons in 4 korte stappen</h2>
        </div>

        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <section class="paper-card review-question-card">
                <div class="review-question-head">
                    <div>
                        <h3><?php echo e($question['title']); ?></h3>
                    </div>
                    <span class="review-question-badge"><?php echo e($loop->iteration); ?>/4</span>
                </div>
                <div class="rating-grid">
                    <?php $__currentLoopData = $question['labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="rating-option">
                            <input type="radio" name="<?php echo e($field); ?>" value="<?php echo e($value); ?>" <?php if((int) old($field) === $value): echo 'checked'; endif; ?>>
                            <span class="rating-option-card">
                                <span class="rating-option-number"><?php echo e($value); ?></span>
                                <span class="rating-option-label"><?php echo e($label); ?></span>
                            </span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <section class="paper-card review-question-card">
            <div class="review-question-head">
                <div>
                    <h3>Heb je nog een opmerking?</h3>
                </div>
                <span class="review-question-badge">4/4</span>
            </div>
            <label for="comment">Extra feedback</label>
            <textarea id="comment" name="comment" rows="5" placeholder="Schrijf hier je feedback"><?php echo e(old('comment')); ?></textarea>
        </section>

        <div class="review-submit-bar">
            <button class="btn review-submit-button" type="submit">Verstuur review</button>
        </div>
    </form>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/reviews/show.blade.php ENDPATH**/ ?>