@extends('layouts.app')
@section('title', 'Bedankt')
@section('content')
@php
    $reviewUrl = route('reviews.show', $order);
    $orderSummary = collect($order->items)->map(function ($item) {
        $number = trim(($item->menuItem?->number ?? '') . ($item->menuItem?->suffix ?? ''));
        $label = trim(($number ? $number . ' ' : '') . ($item->menuItem?->name ?? 'Onbekend gerecht'));

        return $item->quantity . 'x ' . $label;
    })->implode("\n");
    $qrPayload = trim("De Gouden Draak\nBestelnummer: {$order->order_number}\nType: " . ($order->type === 'delivery' ? 'Bezorgen' : 'Afhalen') . "\nItems:\n{$orderSummary}");
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' . urlencode($qrPayload);
@endphp
<div class="paper-card review-thank-you-card" style="text-align:center">
    <h1>Bedankt voor je bestelling!</h1>
    <p>Bestelnummer: <strong>{{ $order->order_number }}</strong></p>
    <p>Type: <strong>{{ $order->type === 'delivery' ? 'Bezorgen' : 'Afhalen' }}</strong></p>
    @if ($order->type === 'delivery')
        <p>{{ $order->customer_address }}, {{ $order->customer_postcode }} {{ $order->customer_city }}</p>
    @endif
    <p>Totaal: <strong>&euro; {{ number_format($order->total, 2, ',', '.') }}</strong></p>
    @if ($order->items->isNotEmpty())
        <div class="review-order-list" style="text-align:left; margin: 1rem auto; max-width: 34rem;">
            @foreach ($order->items as $item)
                <div class="review-order-line">
                    <strong>{{ $item->quantity }}x {{ trim(($item->menuItem?->number ?? '') . ($item->menuItem?->suffix ?? '')) }} {{ $item->menuItem?->name }}</strong>
                    @if ($item->note)
                        <span class="muted">{{ $item->note }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
    <p>Scan of print de QR-code als compacte orderbon met bestelnummer en gekozen gerechten.</p>
    <img class="qr-print qr-print-large" alt="QR code met orderoverzicht" src="{{ $qrUrl }}">
    <p><a class="btn" href="{{ $reviewUrl }}">Open reviewformulier</a></p>
    <p class="actions" style="justify-content:center">
        <a class="btn" href="{{ route('menu.index') }}">Terug naar menukaart</a>
        <button class="btn secondary" onclick="window.print()">Print bestelling</button>
    </p>
</div>
@endsection
