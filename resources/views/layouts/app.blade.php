<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="icon" href="{{ asset('img/malawian-logo-min.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/malawian-logo-min.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("https://static1.simpleflyingimages.com/wordpress/wp-content/uploads/2023/03/shutterstock_1702271536.jpg");
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .btn-outline-custom {
            color: #3da540;
            border-color: #3da540;
        }

        .btn-outline-custom:hover {
            background-color: #3da540;
            color: white;
        }

        .navbar-nav .nav-link {
            color: white;
        }
        .navbar-nav .nav-link.active {
            color: #3da540;
        }
        .nav-link:hover {
            color: #3da540;
        }
        .navbar-brand {
            color: #3da540;
        }
        .navbar .navbar-expand-lg {
            background-color: transparent;
        }
        .form-control {
            background-color: transparent;
            color: white;
        }
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='white' class='bi bi-list' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.5 12.5a.5.5 0 0 1 .5.5h12a.5.5h0 0 1 0 1H2a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5.5h12a.5.5h0 0 1 0 1H2a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5.5h12a.5.5 0 0 1 0 1H2a.5.5 0 0 1-.5-.5z'/%3E%3C/svg%3E");
        }
        .navbar-collapse.collapse.show {
            background-color: white;
            
        }

        .navbar-collapse.collapse.show .nav-link{
            color: black;       
        }

        .navbar-collapse.collapse.show .nav-link.active{
            color: #3da540;       
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('luggage.index') }}"><img src="{{ asset('img/malawian-logo-min.png') }}"  alt="MW Airlines" width="100" height="auto"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('luggage.index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customer.create') }}">Buy a Ticket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('luggage.create') }}">Register Luggage</a>
        </li>
      </ul>
      <form class="d-flex" action="{{ route('luggage.search') }}" method="GET" role="search">
        <input class="form-control me-2" type="text" name="query" placeholder="Enter surname or ticket number" required>
        <button class="btn btn-outline-custom" id="searchButton" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
