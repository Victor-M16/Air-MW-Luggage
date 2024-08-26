@extends('layouts.app')

@section('content')
    <h1>Search Results</h1>

    @if($trips->isEmpty())
        <p>No trips found matching your query.</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Ticket Number</th>
                        <th>Bag Description</th>
                        <th>Item Characteristics</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                        @foreach($trip->bags as $bag)
                            @foreach($bag->items as $item)
                                <tr>
                                    <td>{{ $trip->customer->firstname }} {{ $trip->customer->surname }}</td>
                                    <td>{{ $trip->ticket_number }}</td>
                                    <td>{{ $bag->bag_description }}</td>
                                    <td>{{ $item->characteristic_1 }}, {{ $item->characteristic_2 }}, {{ $item->characteristic_3 }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
