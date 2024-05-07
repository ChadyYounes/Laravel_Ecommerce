<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Seller</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

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
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

        <style>
#logout-div {
    background-color: #ddd;
    padding: 10px;
    display: none;
    border-radius: 5px;
    position: absolute;
    z-index: 999;
    right: 5%;
    width: 150px; /* Adjust width as needed */
}

.logout-button  {
    background-color: white;
    color: darkred;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
    margin: 5px 0;
    display: block;
    width: 100%;
    text-align: left;
    transition: background-color 0.3s ease;font-weight: bold;
}
.edit-profile-button {
    background-color: white;
    color: black;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
    margin: 5px 0;
    display: block;
    width: 100%;
    text-align: left;
    transition: background-color 0.3s ease;font-weight: bold;
}
.username {
    color: black;
}


.logout-button:hover,
.edit-profile-button:hover {
    background-color: lightgray;
}

#user-icon {
    position: relative;
}

.logout-div {
    position: absolute;
    width: 150px; 
}
        </style>
    </head>

    <body>

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
                <li><a href="{{route('home',['user_id' => $user->id])}}">Home</a></li>
                <li><a href="{{route('storeFormView',['user_id' => $user->id])}}">Create Store</a></li>
                <li><a href="{{route('storeView' , ['user_id' => $user->id ])}}">Your stores</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#" id="user-icon" class="my-auto">Logout</a></li>
            </ul>
            <h1 class="logo">FlipCart</h1>
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


       
        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("lib/waypoints/waypoints.min.js")}}"></script>
    <script src="{{asset("lib/lightbox/js/lightbox.min.js")}}"></script>
    <script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset("js/main.js")}}"></script>
    </body>

</html>