<!DOCTYPE html>
<html>
<head>
    <title>Luggage Details</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Luggage Details</h1>
        <p>Departure Point: {{ $luggage->departure_point }}</p>
        <p>Destination: {{ $luggage->destination }}</p>
        <p>Ticket Number: {{ $luggage->ticket_number }}</p>
        <p>Email: {{ $luggage->email }}</p>
        <p>Phone: {{ $luggage->phone }}</p>

        <!-- Display QR code -->
        <img src="{{ asset($luggage->qr_code_url) }}" alt="QR Code">
    </div>
</body>
</html>
