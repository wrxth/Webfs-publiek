@extends('layouts.app')
@section('title', 'Aanbiedingen - De Gouden Draak')
@section('content')
<div class="paper-card">
    <h1>Aanbiedingen van deze week</h1>
    @forelse ($offers as $offer)
        <div class="offer-highlight" style="margin-bottom:14px">
            <h2>{{ $offer->title }}</h2>
            @if ($offer->description)
                <p>{{ $offer->description }}</p>
            @endif
            <p><strong>{{ $offer->discountLabel() }}</strong></p>
            @if ($offer->menuItems->isNotEmpty())
                <p>Gerechten in deze actie: {{ $offer->menuItems->pluck('name')->join(', ') }}</p>
            @endif
        </div>
    @empty
        <p>Er zijn momenteel geen actieve aanbiedingen.</p>
    @endforelse
</div>
@endsection
