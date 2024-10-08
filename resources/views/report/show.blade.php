@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
  <div class="card-body">
  <h1>Trip Report</h1>

<h2>Customer Details</h2>
<p><strong>Name:</strong> {{ $trip->customer->firstname }} {{ $trip->customer->surname }}</p>
<p><strong>Email:</strong> {{ $trip->customer->email }}</p>

<h2>Trip Details</h2>
<p><strong>Ticket Number:</strong> {{ $trip->ticket_number }}</p>
<p><strong>Departure:</strong> {{ $trip->departure_point }}</p>
<p><strong>Destination:</strong> {{ $trip->destination }}</p>

<h3>Luggage Details</h3>
@foreach ($trip->bags as $bag)
    <div class="bag">
        <h4>Bag Description: {{ $bag->bag_description }}</h4>
        <ul>
            @foreach ($bag->items as $item)
                <li>
                    <strong>Item Characteristics:</strong><br>
                    Characteristic 1: {{ $item->characteristic_1 }}<br>
                    Characteristic 2: {{ $item->characteristic_2 }}<br>
                    Characteristic 3: {{ $item->characteristic_3 }}
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

<a href="{{ route('report.pdf', $trip->id) }}" class="btn btn-outline-custom">Download as PDF</a>
  </div>
</div>
</div>
@endsection




