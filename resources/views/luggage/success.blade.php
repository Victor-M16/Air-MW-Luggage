@extends('layouts.app')

@section('title', 'Luggage Registration Successful')

@section('content')
<div class="container mt-4">
    <h1>Luggage Registered Successfully</h1>
    <p>Your luggage has been registered successfully.</p>
    <a href="{{ route('luggage.create') }}" class="btn btn-primary">Register Another Luggage</a>
</div>
@endsection
