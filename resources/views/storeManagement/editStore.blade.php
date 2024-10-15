<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/storeForm.css') }}">
    <title>Add Store</title>
       <!-- Google Web Fonts -->
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
.button-container {
    text-align: center;
}

.update-button,
.cancel-button {
    padding: 10px 20px;
    margin: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.update-button {
    background-color: #4CAF50;
    color: white;
}

.cancel-button {
    background-color: #f44336;
    color: white;
}

.update-button:hover,
.cancel-button:hover {
    opacity: 0.8;
}

</style>
</head>
<body>




<form method="POST" action="{{route('updateStore' , ['store_id' => $store->id , 'user_id' => $user->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <ul class="form-style-1">

    <li>
        <label>Store Name <span class="required">*</span></label>
        <input type="text" name="store_name" class="field-long" value="{{$store->store_name}}" />
    </li>
    <li>
    <label>Mainly Selling </label>
    <select name="store_category" class="field-select">
        <option value="Cars & Vehicles" {{$store->store_category == 'Cars' ? 'selected' : ''}}>Cars & Vehicles</option>
        <option value="Accessories" {{$store->store_category == 'Accessories' ? 'selected' : ''}}>Accessories</option>
        <option value="Phones" {{$store->store_category == 'Phones' ? 'selected' : ''}}>Phones</option>
        <option value="General" {{$store->store_category == 'General' ? 'selected' : ''}}>General</option>
    </select>
</li>

    <li>
        <label>Store Description<span class="required">*</span></label>
        <textarea name="store_description" id="field5" class="field-long field-textarea">{{$store->store_description}}</textarea>
    </li>
    <li>
    <label>Store Logo or image</label>
    <div class="image-input-container">
        <input type="file" name="image_url" id="image_url" class="field-long" onchange="previewImage(event)" />
        <img id="image_preview" src="{{asset($store->image_url)}}" alt="Preview" style="max-width: 100px; max-height: 100px; margin-left: 10px; display: block;" />
    </div>
</li>


<li>
    <div class="button-container">
        <button type="submit" class="update-button">Update</button>
       
    </div>
</li>
</ul>
</form>
<a href="{{route('storeView',['user_id' => $user->id])}}"><button class="cancel-button">Cancel</button></a>

@if($errors->any())
    <div id="popup" >
        <div id="popup-content">
            <h3 style="color:darkred;">Store not Updated</h3>
            
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

        // Check if an image is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function() {
                preview.style.display = 'block';
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            // If no image is selected, hide the preview
            preview.style.display = 'none';
        }
    }
</script>


 


</body>
@include('footer.footer')
</html>