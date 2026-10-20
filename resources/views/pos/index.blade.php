@extends('layouts.app')
@section('title', 'Kassa')
@section('content')
<div
    id="vue-pos-search"
    data-search-url="{{ route('pos.search') }}"
    data-categories='@json($categories, JSON_HEX_APOS | JSON_HEX_QUOT)'
    data-rice-options='@json($riceOptions, JSON_HEX_APOS | JSON_HEX_QUOT)'
    data-note-suggestions='@json($noteSuggestions, JSON_HEX_APOS | JSON_HEX_QUOT)'
></div>
@endsection
