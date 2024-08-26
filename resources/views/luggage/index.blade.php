@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row" style="margin: 1rem">

<div class="card">
  <div class="card-body">
  <h1>Takulandirani pa Malawi Airlines Luggage Manager</h1>
  <p>Buy ticket or if you already have a ticket, you can register some luggage. Yendani Bwino! </p>
  </div>
</div>

</div>

<div class="row mt-2">

    @foreach($trips as $trip)
        <div class="card" style="width: 18rem; margin: 1rem;">
            <img src="{{ asset('storage/' . $trip->qr_code) }}" class="card-img-top" alt="QR Code">
            <div class="card-body">
                <h5 class="card-title">{{ $trip->ticket_number }}</h5>
                <p class="card-text">Departure: {{ $trip->departure_point }}<br>Destination: {{ $trip->destination }}</p>
                <a href="{{ route('report.show', ['tripId' => $trip->id]) }}" class="btn btn-outline-custom">View Report</a>
            </div>
        </div>
    @endforeach

</div>



@endsection
