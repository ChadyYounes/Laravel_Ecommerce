<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fruitables</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{asset("css/productCard.css")}}" rel="stylesheet">
    <link href="{{asset("css/navbar.css")}}" rel="stylesheet">
    <link href="{{asset("css/logout.css")}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>
    
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

        .logout-button {
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
            transition: background-color 0.3s ease;
            font-weight: bold;
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
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .username {
            color: black;
        }

        .logout-button:hover,
        .edit-profile-button:hover {
            background-color: lightgray;
        }

        .logout-div {
            position: absolute;
            width: 150px; 
        }
    </style>
</head>
<body>

    <!-- navbar -->
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
        <p class="username">{{$user->name}}</p>
        <hr>
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
    <a>
    <button class="add_a_product">Add a Product</button>
    </a>
    @foreach($product as $products)
        <div class="row">
            <div class="col l4 m8 s12 offset-m2 offset-l4">
                <div class="product-card">
                    <div class="card  z-depth-4">
                        <div class="card-image">
                            <a href="#" class="btn-floating btn-large price waves-effect waves-light brown darken-3">5 €</a>
                            <img src="https://images.pexels.com/photos/853006/pexels-photo-853006.jpeg?crop=entropy&cs=srgb&dl=pexels-jess-bailey-designs-853006.jpg&fit=crop&fm=jpg&h=480&w=640" alt="product-img">
                            <span class="card-title"><span>Silver Cupcake</span></span>
                        </div>
                        <ul class="card-action-buttons">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=https://codepen.io/lybete/full/jBMNzM/" target="_blank" class="btn-floating waves-effect waves-light white"><i class="material-icons grey-text text-darken-3">share</i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="material-icons like">favorite_border</i></a>
                            </li>
                            <li><a id="buy" class="btn-floating waves-effect waves-light blue"><i class="material-icons buy">add_shopping_cart</i></a>
                            </li>
                        </ul>
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12">
                                    <p>
                                        <strong>Description:</strong> <br />
                                    </p>
                                </div>
                                
                            </div>
                            <div class="row">
                                    <div style="width: 95%; margin: auto;">
                                        <div class="chip">Dessert</div>
                                        <div class="chip">French</div>
                                        <div class="chip">Sweet</div>
                                        <div class="chip">Chocolate</div>
                                        <div class="see-more chip"><a href="#">More details</a></div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

        






</body>
</html>
