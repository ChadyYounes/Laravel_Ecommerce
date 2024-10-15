<!-- <ion-icon name="home-outline"></ion-icon> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--  Stylesheet -->
        <link href="{{asset("css/navbar.css")}}" rel="stylesheet">
        <link href="{{asset("css/logout.css")}}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>
        <link href="{{asset("css/style.css")}}" rel="stylesheet">
         <!-- favicon -->
         <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
         <!-- google font -->
         <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
         <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
         <!-- fontawesome -->
         <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
         <!-- bootstrap -->
         <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">

         <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
         <!-- responsive -->
         <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">   
        
</head>
<body>
<nav class="navbar">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li><a href="{{route('home')}}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home </a></li>
            <li><a href="{{route('buyerStores')}}" class="{{ request()->routeIs('buyerStores') ? 'active' : '' }}">View Stores</a></li>
            <li><a href="{{route('shoppingCart')}}" class="{{ request()->routeIs('shoppingCart') ? 'active' : '' }}">Shopping cart</a></li>
            <li><a href="{{route('viewEvents')}}" class="{{ request()->routeIs('viewEvents') ? 'active' : '' }}">View Events</a></li>
            <li><a href="{{route('myEvents')}}" class="{{ request()->routeIs('myEvents') ? 'active' : '' }}">My Events</a></li>
            <li><a href="{{ route('chats_list', ['user_id' => $user->id])}}" class="{{ request()->routeIs('chats') ? 'active' : '' }}">Chats</a></li>
            <li><a href="#" id="user-icon" class="my-auto">Settings</a></li>
        </ul>
        <h1 class="logo"><a href="{{route('home', ['user_id' => $user->id])}}"
            style="text-decoration:none;">AEZ e-commerce</h1></a>
    </div>
</nav>
<div id="logout-div" class="logout-div">
    <p class="username">{{$user->name}}</p><hr>
    <a href="{{ route('edit-profile') }}" class="edit-profile-button" style="text-decoration: none; font-size: 14px;">Edit Profile</a>
    <!-- Logout form -->
    <select id="baseCurrencySelect">
        @foreach($currencies as $currency)
            <option value="{{$currency->id}}" {{ $user->base_currency == $currency->id ? 'selected' : '' }}>{{$currency->currency_code}}</option>
        @endforeach
    </select>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-button">Logout</button>
    </form>

    <!-- Error display -->
    <div id="logout-error" class="logout-error" style="display: none;"></div>
</div>

<!-- Include CSS -->
<link href="{{ asset("css/navbar.css") }}" rel="stylesheet">
<link href="{{ asset("css/logout.css") }}" rel="stylesheet">
<link href="{{ asset("css/style.css") }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

<!-- Include JavaScript -->
<script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    // JavaScript code for toggling the visibility of the logout div
    document.getElementById('user-icon').addEventListener('click', function() {
        var logoutDiv = document.getElementById('logout-div');
        if (logoutDiv.style.display === 'none' || logoutDiv.style.display === '') {
            logoutDiv.style.display = 'block';
        } else {
            logoutDiv.style.display = 'none';
        }
    });
</script>
<script>
    $(document).ready(function(){
        $('#baseCurrencySelect').change(function(){
            var currencyId = $(this).val();
            $.ajax({
                url: '/update-base-currency', // Laravel route to handle the request
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    currency_id: currencyId
                },
                success: function(response){
                    // Handle success response if needed
                    location.reload();
                },
                error: function(xhr, status, error){
                    // Handle error if needed
                }
            });
        });
    });
</script>
</body>
</html>