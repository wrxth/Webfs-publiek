@extends('layouts.app')
@section('title', 'Aanbiedingen')
@section('content')
<div class="card">
    <h1>Aanbiedingen</h1>
    <a class="btn" href="{{ route('admin.offers.create') }}">Nieuwe aanbieding</a>
</div>
<div class="card">
    <table><tr><th>Titel</th><th>Korting</th><th>Periode</th><th>Gerechten</th><th>Status</th><th>Acties</th></tr>
        @foreach($offers as $offer)
            <tr>
                <td>{{ $offer->title }}<br><span class="muted">{{ $offer->description }}</span></td>
                <td>{{ $offer->discountLabel() }}</td>
                <td>{{ $offer->starts_at?->format('d-m-Y') }} t/m {{ $offer->ends_at?->format('d-m-Y') }}</td>
                <td>{{ $offer->menuItems->pluck('name')->join(', ') }}</td>
                <td>{{ $offer->is_active ? 'Actief' : 'Inactief' }}</td>
                <td class="actions">
                    <a class="btn secondary" href="{{ route('admin.offers.edit', $offer) }}">Bewerken</a>
                    <form method="post" action="{{ route('admin.offers.destroy', $offer) }}">
                        @csrf
                        @method('delete')
                        <button class="btn danger" type="submit">Verwijderen</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $offers->links() }}
</div>
@endsection
