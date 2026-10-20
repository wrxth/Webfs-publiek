@extends('layouts.app')
@section('title', 'Bestelling plaatsen')
@section('content')
<div class="paper-card">
    <h1>Afhalen of bezorgen</h1>
    <form method="post" action="{{ route('orders.store') }}">
        @csrf
        <div class="grid">
            <label>Naam <input name="customer_name" value="{{ old('customer_name') }}" required></label>
            <label>Telefoon <input name="customer_phone" value="{{ old('customer_phone') }}"></label>
        </div>
        <label>Bestelwijze
            <select name="type" id="order-type" required>
                <option value="takeaway" @selected(old('type') === 'takeaway')>Afhalen</option>
                <option value="delivery" @selected(old('type') === 'delivery')>Bezorgen (+ €2,50)</option>
            </select>
        </label>
        <div class="grid">
            <label>Adres voor bezorging <input name="customer_address" value="{{ old('customer_address') }}" placeholder="Alleen nodig bij bezorgen"></label>
            <label>Postcode <input name="customer_postcode" value="{{ old('customer_postcode') }}" placeholder="Postcode"></label>
            <label>Plaats <input name="customer_city" value="{{ old('customer_city', "'s-Hertogenbosch") }}"></label>
        </div>
        <label>Opmerking <textarea name="notes" placeholder="Opmerking voor je bestelling">{{ old('notes') }}</textarea></label>

        <div id="vue-order-builder"
             data-items='@json($items, JSON_HEX_APOS | JSON_HEX_QUOT)'
             data-rice-options='@json($riceOptions, JSON_HEX_APOS | JSON_HEX_QUOT)'></div>

        <br><button class="btn">Bestelling plaatsen</button>
    </form>
</div>
@endsection
