@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search Results</h1>
    @if ($results->isEmpty())
        <p>No luggage found.</p>
    @else
        <ul class="list-group">
            @foreach ($results as $luggage)
                <li class="list-group-item">
                    <a href="{{ route('show-luggage', ['id' => $luggage->id]) }}">
                        Luggage ID: {{ $luggage->id }} - Ticket Number: {{ $luggage->bag->ticket_number }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
