@extends('layouts.app')
@section('title', 'Bedankt voor je ronde')
@section('content')
@php
    $reviewUrl = route('reviews.show', $order);
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' . urlencode($reviewUrl);
@endphp
<div class="review-hero-card">
    <div class="review-hero-copy">
        <span class="review-kicker">Ronde {{ $order->round_number }} is ontvangen</span>
        <h1>Bedankt, tafel {{ $tableSession->table->code }}!</h1>
        <p>De keuken is aan de slag met bestelling <strong>{{ $order->order_number }}</strong>. Scan later de QR-code en laat weten hoe het was.</p>
    </div>
    <div class="review-qr-panel">
        <img class="qr-print qr-print-large" alt="QR code naar reviewformulier" src="{{ $qrUrl }}">
    </div>
</div>

<div class="grid review-summary-grid">
    <div class="paper-card">
        <h2>Wat staat er in deze ronde?</h2>
        <div class="review-order-list">
            @foreach ($order->items as $item)
                @php
                    $details = array_filter([
                        $item->menuItem?->number ? 'Nr. ' . $item->menuItem->number : null,
                        $item->note,
                    ]);
                @endphp
                <div class="review-order-line">
                    <strong>{{ $item->quantity }}x {{ $item->menuItem?->name }}</strong>
                    @if ($details)
                        <span class="muted">{{ implode(' | ', $details) }}</span>
                    @endif
                </div>
            @endforeach
        </div>
        <p class="summary"><strong>Totaal:</strong> &euro; {{ number_format($order->total, 2, ',', '.') }}</p>
    </div>

    <div class="paper-card">
        <h2>Review later openen</h2>
        <p>Handig als je de QR-code niet direct wilt scannen.</p>
        <p><a class="btn" href="{{ $reviewUrl }}">Open reviewformulier</a></p>
        <p><a class="btn secondary" href="{{ route('tablet.show', $tableSession) }}">Terug naar tablet</a></p>
    </div>
</div>
@endsection
