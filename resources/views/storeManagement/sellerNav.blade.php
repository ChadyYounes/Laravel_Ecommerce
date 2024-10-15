<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/storeForm.css') }}">
    <title>Navbar</title>
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
<!-- navbar -->
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
                <li><a href="{{ route('home', ['user_id' => $user->id]) }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('storeView', ['user_id' => $user->id]) }}" class="{{ request()->routeIs('storeView') ? 'active' : '' }}">Your stores</a></li>
                <li><a href="{{ route('storeFormView', ['user_id' => $user->id]) }}" class="{{ request()->routeIs('storeFormView') ? 'active' : '' }}">Create Store</a></li>
               
                <li><a href="{{ route('chats_list', ['user_id' => $user->id])}}" class="{{ request()->routeIs('chats') ? 'active' : '' }}">Chats</a></li>
                
                <li><a href="#" id="user-icon" class="my-auto">Settings</a></li>
            </ul>
            <h1 class="logo"><a href="{{route('home', ['user_id' => $user->id])}}"
                 style="text-decoration:none;">AEZ e-commerce</h1></a>
        </div>
    </nav>
  <!-- Logout div -->

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

    <!-- Include the JavaScript code -->
    <script>
        // JavaScript to toggle the visibility of the logout div when the user clicks on the user icon
        document.getElementById('user-icon').addEventListener('click', function() {
            var logoutDiv = document.getElementById('logout-div');
            if (logoutDiv.style.display === 'none' || logoutDiv.style.display === '') {
                logoutDiv.style.display = 'block';
            } else {
                logoutDiv.style.display = 'none';
            }
        });
    </script>
<!--end navbar-->
</body>
</html>
