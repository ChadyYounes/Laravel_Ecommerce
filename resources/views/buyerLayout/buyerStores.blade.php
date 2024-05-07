<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlipCart -BuyerStores</title>
    <link href="{{asset("css/navbar.css")}}" rel="stylesheet">

        <link href="{{asset("css/logout.css")}}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>

        <!-- Template Stylesheet -->
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
#popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

#popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    text-align: center; /* Center text */
}

#proceed-btn {
    background-color: #4CAF50;
    color: white;
    padding: 8px 16px; /* Smaller padding */
    border: none;
    border-radius: 4px;
    cursor: pointer;
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
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('buyerStores')}}">View Stores</a></li>
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
   <!-- Iterate through stores and organize them into rows with three cards each -->
@php $storesChunks = $stores->chunk(3); @endphp
@foreach($storesChunks as $chunk)
<div class="row">
    @foreach($chunk as $store)
    <div class="col-lg-4 col-md-6 text-center">
    <div class="single-product-item">
        <div class="product-image">
            <a href="">
                <img src="{{ asset($store->image_url) }}" alt="">
            </a>
        </div>
        <h3>{{ $store->store_name }}</h3>
        <p class="product-price"><span>{{ $store->store_category }}</span></p>
        <a href="" class="cart-btn">Shop</a>
        <a class="cart-btn delete-btn"><button type="submit" class="cart-btn delete-btn" style="border: none; background: none; cursor: pointer; color: #fff; text-decoration: none;">Follow</button></a>
        


    </div>
</div>


    @endforeach
</div>
@endforeach
<br>
<br>
<div class="custom-pagination">
    {{ $stores->links() }}
</div>
<br><br>
<!-- -->
<br><br>
</body>
</html>