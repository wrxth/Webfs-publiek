@extends('layouts.app')
@section('title', 'Tablet tafel ' . $tableSession->table->code)
@section('content')
<div class="card">
    <h1>Tablet - tafel {{ $tableSession->table->code }}</h1>
    <p>Ronde {{ ($tableSession->orders()->max('round_number') ?? 0) + 1 }} van maximaal 5.</p>
    <form method="post" action="{{ route('tablet.help.store', $tableSession) }}">
        @csrf
        <input type="hidden" name="message" value="Klant vraagt om hulp aan tafel {{ $tableSession->table->code }}">
        <button class="btn secondary">Roep bediening</button>
    </form>
</div>
<div class="card">
    <h2>Bestelling plaatsen</h2>
    <form method="post" action="{{ route('tablet.orders.store', $tableSession) }}">
        @csrf
        <div id="vue-order-builder"
             data-items='@json($items, JSON_HEX_APOS | JSON_HEX_QUOT)'
             data-rice-options='@json($riceOptions, JSON_HEX_APOS | JSON_HEX_QUOT)'
             data-order-history='@json($orderHistory, JSON_HEX_APOS | JSON_HEX_QUOT)'></div>
        <br><button class="btn">Plaats ronde</button>
    </form>
</div>
@endsection
