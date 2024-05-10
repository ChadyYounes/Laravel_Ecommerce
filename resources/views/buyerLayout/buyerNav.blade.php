
<!-- navbar.blade.php -->
<nav class="navbar">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li><a href="{{route('home')}}">Home <ion-icon name="home-outline"></ion-icon></a></li>
            <li><a href="{{route('buyerStores')}}">View Stores <ion-icon name="storefront-outline"></ion-icon></a></li>
            <li><a href="{{route('shoppingCart')}}">Shopping cart <ion-icon name="cart-outline"></ion-icon></a></li>
            <li><a href="{{route('viewEvents')}}">View Events <ion-icon name="pricetag-outline"></ion-icon></a></li>
            <li><a href="{{route('myEvents')}}">My Events</a></li>
            <li><a href="#" id="user-icon" class="my-auto">Logout</a></li>
        </ul>
        <h1 class="logo">FlipCart</h1>
    </div>
</nav>
<div id="logout-div" class="logout-div">
    <p class="username">{{$user->name}}</p><hr>
    <a href="{{ route('edit-profile') }}" class="edit-profile-button" style="text-decoration: none; font-size: 14px;">Edit Profile</a>
    <!-- Logout form -->
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
