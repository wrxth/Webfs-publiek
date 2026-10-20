@extends('layouts.app')
@section('title', 'Review voor bestelling ' . $order->order_number)
@section('content')
@php
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
@endphp

<div class="review-hero-card">
    <div class="review-hero-copy">
        <span class="review-kicker">Reviewformulier</span>
        <h1>Hoe was jouw ervaring bij De Gouden Draak?</h1>
        <p>
            Bestelling <strong>{{ $order->order_number }}</strong>
            @if ($order->type === 'table' && $order->tableSession?->table)
                voor tafel <strong>{{ $order->tableSession->table->code }}</strong>
            @endif
            @if ($order->ordered_at)
                van {{ $order->ordered_at->format('d-m-Y H:i') }}
            @endif
        </p>
    </div>
    <div class="review-hero-stats">
        <div class="review-stat">
            <span class="review-stat-label">Besteltype</span>
            <strong>{{ $order->type === 'delivery' ? 'Bezorgen' : ($order->type === 'table' ? 'Restaurant' : 'Afhalen') }}</strong>
        </div>
        <div class="review-stat">
            <span class="review-stat-label">Items</span>
            <strong>{{ $order->items->sum('quantity') }}</strong>
        </div>
        <div class="review-stat">
            <span class="review-stat-label">Totaal</span>
            <strong>&euro; {{ number_format($order->total, 2, ',', '.') }}</strong>
        </div>
    </div>
</div>

@if ($review)
    <div class="paper-card review-complete-card">
        <h2>Bedankt voor je review!</h2>
        <p>We hebben je feedback goed ontvangen. Hiermee kunnen we onze keuken en service blijven verbeteren.</p>
        <div class="review-score-grid">
            <div class="review-score-pill">
                <span>Eten</span>
                <strong>{{ $review->rating_food }}/5</strong>
            </div>
            <div class="review-score-pill">
                <span>Snelheid</span>
                <strong>{{ $review->rating_speed }}/5</strong>
            </div>
            <div class="review-score-pill">
                <span>Vriendelijkheid</span>
                <strong>{{ $review->rating_service }}/5</strong>
            </div>
        </div>
        @if ($review->comment)
            <div class="summary">
                <strong>Opmerking:</strong>
                <p>{{ $review->comment }}</p>
            </div>
        @endif
        <p><a class="btn secondary" href="{{ route('menu.index') }}">Terug naar de menukaart</a></p>
    </div>
@else
    <form method="post" action="{{ route('reviews.store', $order) }}" class="review-form-shell">
        @csrf
        <div class="paper-card">
            <h2>Vertel het ons in 4 korte stappen</h2>
        </div>

        @foreach ($questions as $field => $question)
            <section class="paper-card review-question-card">
                <div class="review-question-head">
                    <div>
                        <h3>{{ $question['title'] }}</h3>
                    </div>
                    <span class="review-question-badge">{{ $loop->iteration }}/4</span>
                </div>
                <div class="rating-grid">
                    @foreach ($question['labels'] as $value => $label)
                        <label class="rating-option">
                            <input type="radio" name="{{ $field }}" value="{{ $value }}" @checked((int) old($field) === $value)>
                            <span class="rating-option-card">
                                <span class="rating-option-number">{{ $value }}</span>
                                <span class="rating-option-label">{{ $label }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </section>
        @endforeach

        <section class="paper-card review-question-card">
            <div class="review-question-head">
                <div>
                    <h3>Heb je nog een opmerking?</h3>
                </div>
                <span class="review-question-badge">4/4</span>
            </div>
            <label for="comment">Extra feedback</label>
            <textarea id="comment" name="comment" rows="5" placeholder="Schrijf hier je feedback">{{ old('comment') }}</textarea>
        </section>

        <div class="review-submit-bar">
            <button class="btn review-submit-button" type="submit">Verstuur review</button>
        </div>
    </form>
@endif
@endsection
