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
        <link href="{{asset("css/navbar.css")}}" rel="stylesheet">
        <link href="{{asset("css/logout.css")}}" rel="stylesheet">
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

.image-input-container {
    display: flex;
    align-items: center;
}

.field-long {
    flex: 1;
}

#image_preview {
    margin-left: 10px;
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
                        <a href="{{route('home',['user_id' => $user->id])}}" class="nav-item nav-link active">Home</a>
                        <a href="{{route('storeView' , ['user_id' => $user->id ])}}" class="nav-item nav-link">Your stores</a>
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

<form method="POST" action="{{route('createStore' , ['user_id' => $user->id])}}" enctype="multipart/form-data">
        @csrf
    <ul class="form-style-1">

    <li>
        <label>Store Name <span class="required">*</span></label>
        <input type="text" name="store_name" class="field-long" />
    </li>
    <li>
        <label>Mainly Selling </label>
        <select name="store_category" class="field-select">
        <option value="Cars">Cars & Vehicles</option>
        <option value="Accessories">Accessories</option>
        <option value="Phones">Phones</option>
        <option value="General">General</option>

        </select>
    </li>
    <li>
        <label>Store Description<span class="required">*</span></label>
        <textarea name="store_description" id="field5" class="field-long field-textarea"></textarea>
    </li>
    <li>
    <label>Store Logo or image</label>
    <div class="image-input-container">
        <input type="file" name="image_url" id="image_url" class="field-long" onchange="previewImage(event)" />
        <img id="image_preview" src="#" alt="Preview" style="max-width: 100px; max-height: 100px; margin-left: 10px; display: none;" />
    </div>
</li>

    <li>
        <input type="submit" value="Submit" />
    </li>
</ul>
</form>
@if(session('success'))
<div id="popup">
        <div id="popup-content">
            <p>{{ session('success') }}</p>
            <button id="proceed-btn">Proceed</button>
        </div>
    </div>
@endif
<script>
document.addEventListener("DOMContentLoaded", function() {
    var popup = document.getElementById("popup");
    var proceedBtn = document.getElementById("proceed-btn");

    if (popup) {
        console.log("Popup element found.");
        proceedBtn.addEventListener("click", function() {
            console.log("Proceed button clicked.");
            popup.style.display = "none";
        });
    }
});

    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('image_preview');
        preview.style.display = 'block';
        var reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>

 


</body>
</html>