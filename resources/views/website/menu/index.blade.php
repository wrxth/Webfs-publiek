@extends('layouts.app')
@section('title', 'Menukaart')
@section('content')
<div class="paper-card">
    <h1>Menukaart</h1>
    <form method="get" action="{{ route('menu.index') }}" style="margin-top:16px">
        <label>Zoeken op gerecht, nummer of omschrijving
            <input name="search" value="{{ request('search') }}" placeholder="Zoek in de menukaart">
        </label>
        <button class="btn">Zoeken</button>
        <a class="btn secondary" href="{{ route('menu.index') }}">Reset</a>
    </form>
</div>

@if ($activeOffers->isNotEmpty())
    <section class="paper-card">
        <h2>Actieve aanbiedingen</h2>
        <div class="grid">
            @foreach ($activeOffers as $offer)
                <article class="offer-highlight">
                    <h3>{{ $offer->title }}</h3>
                    @if ($offer->description)
                        <p>{{ $offer->description }}</p>
                    @endif
                    <p><strong>{{ $offer->discountLabel() }}</strong></p>
                    @if ($offer->menuItems->isNotEmpty())
                        <p>Gerechten: {{ $offer->menuItems->pluck('name')->join(', ') }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
@endif

<div id="vue-menu-favorites" data-items='@json($allItems, JSON_HEX_APOS | JSON_HEX_QUOT)'></div>

@forelse ($categories as $category)
    @if ($category->items->count())
        <section class="paper-card">
            <h2 class="menu-category-title">{{ $category->name }}</h2>
            <table>
                <tbody>
                @foreach ($category->items as $item)
                    <tr>
                        <td style="width:90px">{{ $item->number }}{{ $item->suffix }}</td>
                        <td><strong>{{ strip_tags($item->name) }}</strong>@if($item->description)<br><span class="muted">{{ strip_tags($item->description) }}</span>@endif</td>
                        <td class="price">€ {{ number_format($item->price, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    @endif
@empty
    <div class="paper-card">Nog geen gerechten gevonden.</div>
@endforelse
@endsection
