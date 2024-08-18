<!-- resources/views/luggage/search_form.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Search Luggage</h1>

    <form action="{{ route('luggage.search') }}" method="GET">
        <input type="text" name="query" placeholder="Enter surname or ticket number" required>
        <button type="submit">Search</button>
    </form>
@endsection
