@extends('layouts.app')
@section('title', 'Aanbieding bewerken')
@section('content')
<div class="card">
    <h1>Aanbieding bewerken</h1>
    <form method="post" action="{{ route('admin.offers.update', $offer) }}">
        @method('patch')
        @include('admin.offers._form', ['submitLabel' => 'Opslaan wijzigingen'])
    </form>
</div>
@endsection
