@extends('layouts.app')
@section('title', 'Nieuw gerecht')
@section('content')
<div class="card"><h1>Nieuw gerecht</h1><form method="post" action="{{ route('admin.menu-items.store') }}">@include('admin.menu-items._form', ['menuItem' => new App\Models\MenuItem()])</form></div>
@endsection
