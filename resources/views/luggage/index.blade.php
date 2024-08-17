@extends('layouts.app')

@section('title', 'Luggage Index')

@section('content')
<div class="container mt-4">
        <h1 class="mb-4">Luggage Index</h1>

        <!-- Form to add new luggage -->
        <form action="{{ route('luggage.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="ticket_number">Ticket Number:</label>
                <input type="text" id="ticket_number" name="ticket_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" class="form-control" required>
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Add Luggage</button>
        </form>

        <!-- List of luggage items (if applicable) -->
        <div class="card">
            <div class="card-header">
                Luggage Items
            </div>
            <ul class="list-group list-group-flush">
                <!-- Example of a luggage item list -->
                <li class="list-group-item">Ticket Number: ABC123, Surname: Doe</li>
                <li class="list-group-item">Ticket Number: XYZ789, Surname: Smith</li>
                <!-- Loop through luggage items and display them here -->
            </ul>
        </div>
    </div>
@endsection

