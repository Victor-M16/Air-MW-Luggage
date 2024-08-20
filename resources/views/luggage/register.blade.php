@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Register Luggage</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('submit-luggage') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ticket_number">Ticket Number</label>
            <input type="text" class="form-control" id="ticket_number" name="ticket_number" required>
        </div>
        <div class="form-group">
            <label for="departure">Departure</label>
            <input type="text" class="form-control" id="departure" name="departure" required>
        </div>
        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <h3>Luggage Items</h3>
        <div id="luggage-items">
            <div class="form-group">
                <label for="item_1_description">Item 1 Description</label>
                <input type="text" class="form-control" id="item_1_description" name="luggage_items[0][description]" required>
            </div>
            <div class="form-group">
                <label for="item_1_weight">Item 1 Weight</label>
                <input type="text" class="form-control" id="item_1_weight" name="luggage_items[0][weight]" required>
            </div>
            <div class="form-group">
                <label for="item_1_value">Item 1 Value</label>
                <input type="text" class="form-control" id="item_1_value" name="luggage_items[0][value]" required>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-custom">Submit</button>
    </form>
</div>
@endsection
