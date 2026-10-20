@extends('layouts.app')
@section('title', 'Gerecht bewerken')
@section('content')
<div class="card"><h1>Gerecht bewerken</h1><form method="post" action="{{ route('admin.menu-items.update', $menuItem) }}">@method('put') @include('admin.menu-items._form')</form></div>
@endsection
