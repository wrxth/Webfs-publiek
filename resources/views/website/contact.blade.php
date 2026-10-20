@extends('layouts.app')
@section('title', 'Contact - De Gouden Draak')
@section('content')
<div class="paper-card">
    <h1>Contact</h1>
    <div class="grid">
        <div>
            <h2>De Gouden Draak</h2>
            <p>Chinees Indische Specialiteiten</p>
            <p><strong>Adres:</strong><br>Onderwijsboulevard 215<br>5223 DE 's-Hertogenbosch</p>
            <p><strong>Telefoon:</strong><br>073 - 123 45 67</p>
        </div>
        <div>
            <h2>Openingstijden</h2>
            <p>Maandag t/m zondag<br>16:00 - 22:00</p>
            <a class="btn" href="{{ route('orders.create') }}">Bestelling plaatsen</a>
        </div>
    </div>
</div>
@endsection
