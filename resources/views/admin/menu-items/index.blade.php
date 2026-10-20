@extends('layouts.app')
@section('title', 'Gerechten beheren')
@section('content')
<div class="card">
    <h1>Gerechten beheren</h1>
    <p><a class="btn" href="{{ route('admin.menu-items.create') }}">Nieuw gerecht</a></p>
    <form method="get" class="grid">
        <label>Zoeken <input name="search" value="{{ request('search') }}"></label>
        <label>Categorie <select name="category"><option value="">Alle</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>@endforeach</select></label>
        <label>&nbsp;<button class="btn">Filter</button></label>
    </form>
</div>
<div class="card">
    <table><tr><th>Nr</th><th>Naam</th><th>Categorie</th><th>Prijs</th><th>Actief</th><th>Actie</th></tr>
        @foreach($items as $item)
            <tr><td>{{ $item->number }}{{ $item->suffix }}</td><td>{{ $item->name }}</td><td>{{ $item->category->name ?? '-' }}</td><td>€ {{ number_format($item->price, 2, ',', '.') }}</td><td>{{ $item->is_active ? 'Ja' : 'Nee' }}</td><td class="actions"><a class="btn secondary" href="{{ route('admin.menu-items.edit', $item) }}">Bewerken</a><form method="post" action="{{ route('admin.menu-items.destroy', $item) }}" onsubmit="return confirm('Verwijderen?')">@csrf @method('delete')<button class="btn danger">Verwijder</button></form></td></tr>
        @endforeach
    </table>
    {{ $items->links() }}
</div>
@endsection
