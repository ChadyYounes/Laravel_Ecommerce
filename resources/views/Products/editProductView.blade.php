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
        <link href="{{asset("css/navbar.css")}}" rel="stylesheet">
        <link href="{{asset("css/logout.css")}}" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Proxima Nova:400,800");

* {
  box-sizing: border-box;
}

body {
  background: #f6f5f7;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  font-family: "Montserrat", sans-serif;
  height: 100vh;
  margin: -20px 0 50px;
}

h1 {
  font-weight: bold;
  margin: 0;
}

h2 {
  text-align: center;
}

p {
  font-size: 16px;
  font-weight: 100;
  line-height: 20px;
  letter-spacing: 0.5px;
  margin: 20px 0 30px;
}

span {
  font-size: 12px;
}

a {
  color: #333;
  font-size: 14px;
  text-decoration: none;
  margin: 15px 0;
}

button {
  border-radius: 20px;
  border: 1px solid #f28123;
  background-color: #f28123;
  color: #ffffff;
  font-size: 12px;
  font-weight: bold;
  padding: 12px 45px;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: background-color 0.3s ease;}

button:active {
  transform: scale(0.95);
}

button:focus {
  outline: none;
}
button:hover {
  background-color: #180f46;

}

button.ghost {
  background-color: transparent;
  border-color: #ffffff;
}

form {
  background-color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0 50px;
  height: 100%;
  text-align: center;
}

input {
  background-color: #eee;
  border: none;
  padding: 12px 15px;
  margin: 8px 0;
  width: 100%;
}

.container {
  border-radius: 10px;
  position: relative;
  overflow: hidden;
  width: 768px;
  margin-left: 35%;
  max-width: 100%;
  min-height: 480px;
}

.form-container {
  position: absolute;
  top: 0;
  height: 100%;
  transition: all 0.6s ease-in-out;
}

.sign-in-container {
  left: 0;
  width: 50%;
  z-index: 2;
}

.container.right-panel-active .sign-in-container {
  transform: translateX(100%);
}

.sign-up-container {
  left: 0;
  width: 50%;
  opacity: 0;
  z-index: 1;
}

.container.right-panel-active .sign-up-container {
  transform: translateX(100%);
  opacity: 1;
  z-index: 5;
  animation: show 0.6s;
}

@keyframes show {
  0%,
  49.99% {
    opacity: 0;
    z-index: 1;
  }

  50%,
  100% {
    opacity: 1;
    z-index: 5;
  }
}

.overlay-container {
  position: absolute;
  top: 0;
  left: 50%;
  width: 50%;
  height: 100%;
  overflow: hidden;
  transition: transform 0.6s ease-in-out;
  z-index: 100;
}

.container.right-panel-active .overlay-container {
  transform: translateX(-100%);
}

.overlay {
  background: #ff416c;
  background: -webkit-linear-gradient(to right, #ff4b2b, #f28123);
  background: linear-gradient(to right, #ff4b2b, #f28123);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: 0 0;
  color: #ffffff;
  position: relative;
  left: -100%;
  height: 100%;
  width: 200%;
  transform: translateX(0);
  transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  transform: translateX(50%);
}

.overlay-panel {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0 40px;
  text-align: center;
  top: 0;
  height: 100%;
  width: 50%;
  transform: translateX(0);
  transition: transform 0.6s ease-in-out;
}

.overlay-left {
  transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
  transform: translateX(0);
}

.overlay-right {
  right: 0;
  transform: translateX(0);
}

.container.right-panel-active .overlay-right {
  transform: translateX(20%);
}

.social-container {
  margin: 20px 0;
}

.social-container a {
  border: 1px solid #dddddd;
  border-radius: 50%;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  margin: 0 5px;
  height: 40px;
  width: 40px;
}

footer {
  background-color: #222;
  color: #fff;
  font-size: 14px;
  bottom: 0;
  position: fixed;
  left: 0;
  right: 0;
  text-align: center;
  z-index: 999;
}

footer p {
  margin: 10px 0;
}

footer i {
  color: #f28123;
}

footer a {
  color: #3c97bf;
  text-decoration: none;
}

  .back-button {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }
        .container {
            margin-top: 50px; /* Adjust this margin to prevent overlap with the back button */
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
.category-select {
    width: 100%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: none;
    color: black; /* Set text color to black */
}


.category-select:focus {
    outline: none;
    border-color: #007bff;
}

.category-select option {
    color: black;


}
#popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
        }

        #popup-content {
            text-align: center;
            font-weight: bold; /* Make text bold */
        }

        #popup button {
            margin-top: 10px;
        }
</style>
</head>
<body>

<div class="container" id="container">
        <div class="form-container sign-in-container" style="text-align:center">
            <div class="back-button">
                <a href="{{route('productsView',['store_id'=>$store->id])}}"><button>Back</button></a>
            </div>
            <!-- product adding -->
            <form method="POST" action="{{ route('editProduct', ['product_id' => $product->id]) }}" enctype="multipart/form-data">
                @csrf
                <h1>Edit Product</h1>
                <input type="text" placeholder="Name" name="product_name" value="{{ $product->product_name }}" />
                <input type="number" placeholder="Price" name="price" id="price" value="{{ $product->price }}" />
                <input type="number" placeholder="Quantity" name="quantity" id="quantity" value="{{ $product->quantity }}" />
                <input type="text" placeholder="Description" name="description" value="{{ $product->description }}"></input>
                <select name="category_id" class="category-select">
                    <option value="" selected disabled>Select a category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
               
                <div class="image-input-container">
                    <input type="file" name="product_url" id="image_url" class="field-long" onchange="previewImage(event)" />
                    <img id="image_preview" src="{{ asset($product->product_url) }}" alt="Preview" style="max-width: 100px; max-height: 100px; margin-left: 10px; display: block;" />
                </div>

                <button type="submit">Update Product</button>
            </form>


        </div>
        
        
    </div>

    @if(session('success') || $errors->any())
    <div id="popup">
        <div id="popup-content">
            @if(session('success'))
                <p>{{ session('success') }}</p>
            @elseif($errors->any())
                <h3 style="color:darkred;">Store not created</h3>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
            <button id="proceed-btn">Proceed</button>
        </div>
    </div>
@endif
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const popup = document.getElementById('popup');
        const proceedBtn = document.getElementById('proceed-btn');

        // Show the popup if there's a success or error message
        @if(session('success') || $errors->any())
            popup.style.display = 'block';
        @endif

        // Close the popup when the "Proceed" button is clicked
        proceedBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    });
</script>

<script>
  const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");

signUpButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

</script>
<script>
    function goBack() {
        window.history.back();
    }
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
