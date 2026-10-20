@extends('layouts.app')
@section('title', 'Admin dashboard')
@section('content')
<div class="card">
    <h1>Admin dashboard</h1>
    <p class="actions">
        <a class="btn" href="{{ route('admin.menu-items.index') }}">Gerechten beheren</a>
        <a class="btn" href="{{ route('admin.offers.index') }}">Aanbiedingen beheren</a>
    </p>
</div>
<div class="grid">
    <div class="card">
        <h2>Tafel registreren</h2>
        <form method="post" action="{{ route('admin.table-sessions.store') }}">
            @csrf
            <label>Tafel
                <select name="restaurant_table_id" required>
                    @foreach($tables as $table)<option value="{{ $table->id }}">{{ $table->code }} ({{ $table->seats }} plaatsen)</option>@endforeach
                </select>
            </label>
            <label>Aantal gasten <input type="number" name="guest_count" min="1" max="8" value="2" required></label>
            <label>Leeftijden gasten <input name="guest_ages[]" placeholder="Gast 1 leeftijd"></label>
            <label><input name="guest_ages[]" placeholder="Gast 2 leeftijd"></label>
            <label><input name="guest_ages[]" placeholder="Gast 3 leeftijd (optioneel)"></label>
            <label><input name="guest_ages[]" placeholder="Gast 4 leeftijd (optioneel)"></label>
            <label><input style="width:auto" type="checkbox" name="deluxe_menu" value="1"> Luxe menu</label>
            <button class="btn">Open tafel</button>
        </form>
    </div>
    <div class="card">
        <h2>Open tafels</h2>
        <table><tr><th>Tafel</th><th>Gasten</th><th>Actie</th></tr>
            @foreach($sessions as $session)
                <tr><td>{{ $session->table->code }}</td><td>{{ $session->guest_count }}<br><span class="muted">Leeftijden: {{ collect($session->guest_ages)->filter()->join(", ") ?: "-" }}<br>Luxe: {{ $session->deluxe_menu ? "ja" : "nee" }}</span></td><td class="actions"><a class="btn secondary" href="{{ route('tablet.show', $session) }}">Tablet</a><form method="post" action="{{ route('admin.table-sessions.close', $session) }}">@csrf @method('patch')<button class="btn danger">Sluiten</button></form></td></tr>
            @endforeach
        </table>
    </div>
</div>
<div class="card">
    <h2>Hulpvragen</h2>
    <table><tr><th>Tafel</th><th>Bericht</th><th>Status</th><th>Actie</th></tr>
        @foreach($helpRequests as $help)
            <tr><td>{{ $help->tableSession->table->code ?? '-' }}</td><td>{{ $help->message ?: 'Geen bericht' }}</td><td>{{ $help->status }}</td><td>@if($help->status !== 'handled')<form method="post" action="{{ route('help-requests.update', $help) }}">@csrf @method('patch')<button class="btn">Afhandelen</button></form>@endif</td></tr>
        @endforeach
    </table>
</div>
@endsection
