@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register Customer</h2>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
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


    <form action="{{ route('customer.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="surname">Firstname</label>
            <input type="text" name="firstname" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" name="surname" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ticket_number">Ticket Number</label>
            <input type="text" name="ticket_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="departure_point">Departure Point</label>
            <input type="text" name="departure_point" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" name="destination" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
