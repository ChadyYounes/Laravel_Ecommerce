<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/storeForm.css') }}">
    <title>Add Store</title>
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
   .storesHeader {
    margin-top: 7%;
    margin-left: auto;
    margin-right: auto;
    width: fit-content; 
    color: black;
}

    .mini-window {
        position: absolute;
        top: 45px;
        right: 0;
        
        background-color: lightgray;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 5px;
        display: none;
    }

    .show-mini-window {
        display: block;
    }
    .logout-button{
        background-color : darkred;
        color:white;
        padding : 5px;
        font-weight : bold;
        border-radius : 8px;
        border-color:darkred ;
    }
</style>
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
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="shop.html" class="nav-item nav-link">Shop</a>
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
                    <div class="position-relative">
                        <i class="fas fa-user fa-2x" id="user-icon"></i>
                        <div class="mini-window" id="logout-div">
                            <!-- Logout form -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-button">Logout</button>
                            </form>
                            
                            <!-- Error display -->
                            <div id="logout-error" class="logout-error" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<br><br><br><br>
<!-- Include the JavaScript code -->
<script>
    // JavaScript to toggle the visibility of the logout div when the user clicks on the user icon
    document.getElementById('user-icon').addEventListener('click', function() {
        var logoutDiv = document.getElementById('logout-div');
        logoutDiv.classList.toggle('show-mini-window');
    });
</script>

        <!-- Navbar End -->

<form>
<ul class="form-style-1">

    <li>
        <label>Store Name <span class="required">*</span></label>
        <input type="text" name="field3" class="field-long" />
    </li>
    <li>
        <label>Mainly Selling </label>
        <select name="field4" class="field-select">
        <option value="Cars">Cars & Vehicles</option>
        <option value="Accessories">Accessories</option>
        <option value="Phones">Phones</option>
        <option value="General">General</option>

        </select>
    </li>
    <li>
        <label>Store Description<span class="required">*</span></label>
        <textarea name="field5" id="field5" class="field-long field-textarea"></textarea>
    </li>
    <li>
        <label>Store Logo or image</label>
        <input type="file" name="field3" class="field-long" />
    </li>
    <li>
        <input type="submit" value="Submit" />
    </li>
</ul>
</form>


</body>
</html>