<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/storeForm.css') }}">
    <title>Add Store</title>
        <!--  Stylesheet -->
        <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>
        <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    {{-- <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}"> --}}
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
 <!-- owl carousel -->
 <link rel="stylesheet" href={{asset("assets/css/owl.carousel.css")}}>
 <!-- magnific popup -->
 <link rel="stylesheet" href={{asset("assets/css/magnific-popup.css")}}>
 <!-- animate css -->
 <link rel="stylesheet" href={{asset("assets/css/animate.css")}}>
 <!-- mean menu css -->
 <link rel="stylesheet" href={{asset("assets/css/meanmenu.min.css")}}>
 <!-- main style -->
 <link rel="stylesheet" href={{asset("assets/css/main.css")}}>
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
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

.animated-text {
      overflow: hidden; /* Ensures the text only appears as it animates */
      border-right: .15em solid orange; /* Cursor effect */
      white-space: nowrap; /* Keeps the text on a single line */
      margin: 0 auto; /* Center the text container */
      letter-spacing: .15em; /* Adds spacing between letters */
      animation: typing 3.5s steps(30, end), blink-caret .75s step-end infinite;
    }

    @keyframes typing {
      from { width: 0 }
      to { width: 100% }
    }

    @keyframes blink-caret {
      from, to { border-color: transparent }
      50% { border-color: orange }
    }
</style>
</head>
<body>


<!-- navbar -->
<body>
  
@include('storeManagement.sellerNav')
<!--end navbar-->
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Add a Store</h3>
                    <p class="animated-text">You can create any store that you want..</p>
                </div>
            </div>
        </div>
        <div class="sectionForm">
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
        <input style="background-color :#f28123; color: white" type="submit" value="Submit" />
    </li>
</ul>
</form>
</div>
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
@include('footer.footer')
</html>
