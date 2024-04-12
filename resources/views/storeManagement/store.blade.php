
<!DOCTYPE html>
<html lang="en">
<head>
<head>
        <meta charset="utf-8">
        <title>Fruitables </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <link href="{{asset("css/navbar.css")}}" rel="stylesheet">
        <link href="{{asset("css/logout.css")}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset("css/style.css")}}" rel="stylesheet">
       
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
.storesHeader{
    text-align:center;
    margin-top:5%;
    color:    #1e90ff;
}
</style>
    </head>
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
            <h1 class="logo">Navbar</h1>
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


<!--           -->
<h2 class="storesHeader">Manage your Stores!</h2><br/>

@foreach ($stores as $userStores)
<div class="card rounded-pill text-center overflow-hidden border-0 shadow m-5" style="max-width: 18rem;">
  <img src="https://codingyaar.com/wp-content/uploads/cactus.jpg" class="card-img-top" alt="...">
  <div class="card-body bg-dark text-white">
    <h5 class="card-title fw-bold">Product Title</h5>
    <p class="card-text">Something about the product.</p>
    <a href="#" class="btn btn-light px-3 rounded-pill">Buy Now</a>
    <p class="mt-3">$129.00</p>
  </div>
</div>

<p class="mt-5 text-center">Get a step-by-step written explanation here: <a href="https://codingyaar.com/product-card-oval-design-bootstrap-5-html/" target="_blank">Bootstrap 5 Product Card Oval Shape</a> </p>
<p class="mt-5 text-center">Get a step-by-step video explanation here: <a href="https://youtu.be/5yOx3KApWkY" target="_blank">Bootstrap 5 Product Card</a> </p>
@endforeach




















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