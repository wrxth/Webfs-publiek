@extends('layouts.app')
@section('title', 'Welkom - De Gouden Draak')
@section('content')
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
        <a class="btn" href="{{ route('menu.index') }}">Bekijk menukaart</a>
        <a class="btn secondary" href="{{ route('orders.create') }}">Afhalen of bezorgen</a>
    </p>
</div>
@endsection
