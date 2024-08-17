@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search Luggage</h1>

    <form action="{{ route('do-search-luggage') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="search_term">Search by Surname or Ticket Number</label>
            <input type="text" class="form-control" id="search_term" name="search_term" required>
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
@endsection
