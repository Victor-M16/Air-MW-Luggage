@extends('layouts.app')

@section('title', 'Home Page')

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
<div class="card" style="width: 18rem; margin: 1rem;">
    <img src="{{ asset('storage/qrcodes/VM-01.png') }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">VM-01</h5>
        <p class="card-text">Scan the QR Code to view Trip details</p>
        <a href="#" class="btn btn-outline-custom">View Luggage</a>
    </div>
</div>

<div class="card" style="width: 18rem; margin: 1rem;">
    <img src="{{ asset('storage/qrcodes/VM-01.png') }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">VM-01</h5>
        <p class="card-text">Scan the QR Code to view Trip details</p>
        <a href="#" class="btn btn-outline-custom">View Luggage</a>
    </div>
</div>

<div class="card" style="width: 18rem; margin: 1rem;">
    <img src="{{ asset('storage/qrcodes/VM-01.png') }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">VM-01</h5>
        <p class="card-text">Scan the QR Code to view Trip details</p>
        <a href="#" class="btn btn-outline-custom">View Luggage</a>
    </div>
</div>

<div class="card" style="width: 18rem; margin: 1rem;">
    <img src="{{ asset('storage/qrcodes/VM-01.png') }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">VM-01</h5>
        <p class="card-text">Scan the QR Code to view Trip details</p>
        <a href="#" class="btn btn-outline-custom">View Luggage</a>
    </div>
</div>
</div>



@endsection
