<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/storeForm.css') }}">
    <title>Add Store</title>
       <!-- Google Web Fonts -->
       
        <!-- Icon Font Stylesheet -->
       
        <!-- Template Stylesheet -->
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
        <option value="Cars & Vehicles">Cars & Vehicles</option>
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
            <button id="proceed-btn" style="margin-top:3%;">Proceed</button>
        </div>
    </div>
@elseif($errors->any())
    <div id="popup" >
        <div id="popup-content">
            <h3 style="color:darkred;">Store not created</h3>
            
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            
            <button id="proceed-btn" style="margin-top:3%;">OK</button>
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
</script>

    

 <script>
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