
<!DOCTYPE html>
<html lang="en">
<head>
<head>
        <meta charset="utf-8">
        <title>Fruitables </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{asset("lib/lightbox/css/lightbox.min.css")}}" rel="stylesheet">
        <link href="{{asset("lib/owlcarousel/assets/owl.carousel.min.css")}}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset("css/style.css")}}" rel="stylesheet">
        <link href="{{asset("css/logout.css")}}" rel="stylesheet">
        
<style>
   #logout-div {
    background-color: darkred;
    padding: 10px;
    display: none;
    border-radius: 5px;
    position: absolute;
    z-index: 999;
    right: 5%;
    width: 150px; /* Adjust width as needed */
}

.logout-button,
.edit-profile-button {
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

.logout-button:hover,
.edit-profile-button:hover {
    background-color: lightgray;
}

#user-icon {
    position: relative;
}

.logout-div {
    position: absolute;
    width: 150px; /* Adjust width as needed */
}
.storesHeader{
    margin: 0 auto;}
</style>
    </head>
</head>
<body>

 <!-- Navbar start -->
 <div class="container-fluid fixed-top">
            
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                        <a href="{{route('home',['user_id' => $user->id])}}" class="nav-item nav-link active">Home</a>
                            <a href="{{route('storeView',['user_id' => $user->id])}}" class="nav-item nav-link">Stores</a>
                            <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="cart.html" class="dropdown-item">Cart</a>
                                    <a href="chackout.html" class="dropdown-item">Chackout</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    <a href="404.html" class="dropdown-item">404 Page</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="#" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
                            <a href="#" class="my-auto">
                                <i class="fas fa-user fa-2x" id="user-icon"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
         <!-- Logout div -->
    <div id="logout-div" class="logout-div">
    <button class="edit-profile-button">Edit Profile</button>
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
        <!-- Navbar End -->
<!--           -->

<div class="container-fluid service py-5">
<h2 class="storesHeader">Manage Your Stores!</h2>
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Fresh Apples</h5>
                                        <h3 class="mb-0">20% OFF</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Tasty Fruits</h5>
                                        <h3 class="mb-0">Free delivery</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Exotic Vegitable</h5>
                                        <h3 class="mb-0">Discount 30$</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->
</body>
</html>