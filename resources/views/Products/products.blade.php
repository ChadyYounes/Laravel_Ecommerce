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
    <!-- Template Stylesheet -->

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
<!-- hero area -->
<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">{{$store->store_name}}</p>
							<h1>Manage your Store</h1>
							<div class="hero-btns">
								<a href="{{route('addProductView',['store_id'=>$store->id])}}" class="boxed-btn">Add Product</a>
								<a href="" class="bordered-btn">Add Event</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->
<table>
<colgroup>
                    <col class="image-col">
                    <col class="address-col">
                </colgroup>
            <thead>
                <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>    
                </tr>
            </thead>
    @foreach($product as $products)
                <tr>
                <td data-label="Image"><img width="74px" src="{{$products->product_url}}" alt="House"></td>
                <td data-label="name">{{$products->product_name}}</td>
                <td data-label="Category">
                </td>             
                   <td data-label="Quantity"></td>
                <td data-label="Price">{{$products->price}}$</td>

                </tr>               
            
          
    @endforeach
  </table> 
        






</body>
</html>
