@extends('layouts.app')
@section('title', 'Nieuwe aanbieding')
@section('content')
<div class="card">
    <h1>Nieuwe aanbieding</h1>
    <form method="post" action="{{ route('admin.offers.store') }}">
        @include('admin.offers._form', ['submitLabel' => 'Opslaan'])
    </form>
</div>
@endsection
