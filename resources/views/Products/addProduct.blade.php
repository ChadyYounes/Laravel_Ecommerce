<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/storeForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productForm.css') }}">

    <title>Add Store</title>
       <!-- Google Web Fonts -->

        <!-- Icon Font Stylesheet -->

        <!-- Template Stylesheet -->
        <link href="{{asset("css/navbar.css")}}" rel="stylesheet">
        <link href="{{asset("css/logout.css")}}" rel="stylesheet">
    <style>
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

        <div class="form-container sign-up-container">
            <div class="back-button">
            <a href="{{route('productsView',['store_id'=>$store->id])}}"><button>Back</button></a>
            </div>
            <!-- Event Form -->
            <form action="{{route('storeEvent')}}" method="post" enctype="multipart/form-data">
            @csrf
                <h1>Add Event</h1>
                <input type="hidden" name="store_id" value="{{$store->id}}">
                <input type="text" placeholder="Event Name"  name="event_name"/>
                <input type="datetime-local" name="event_datetime" id="event_datetime" placeholder="Event Date&Time">
                <input type="text" name="product_name" id="" placeholder="Product Name">
                <input type="file" name="product_image_url" id="product_image_url">
                <input type="number" placeholder="Starting Price" name="starting_price" />
                <input type="number" placeholder="Minimum Increase" name="minimum_increase" />

                <button>Proceed</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <div class="back-button">
                <a href="{{route('productsView',['store_id'=>$store->id])}}"><button>Back</button></a>
            </div>
            <!-- product adding -->
            <form method="POST" action="{{route('addProduct',['store_id'=>$store->id])}}"  enctype="multipart/form-data">
            @csrf
                <h1>Add Product</h1>
                <input type="text" placeholder="Name" name="product_name" />
                <input type="number" placeholder="Price" name="price" id="price" />
<input type="number" placeholder="Quantity" name="quantity" id="quantity" />
                <input type="text" placeholder="Description" name="description"></input>
                <select name="category_id" class="category-select">
                    <option value="" selected disabled>Select a category</option>
                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
                <div class="image-input-container">
                    <input type="file" name="product_url" id="image_url" class="field-long" onchange="previewImage(event)" />
                    <img id="image_preview" src="#" alt="Preview" style="max-width: 100px; max-height: 100px; margin-left: 10px; display: none;" />
                </div>

                <button type="submit">Store</button>
            </form>

        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back! Mr. {{$user->name}}</h1>
                    <p>Streamline your sales journey! Add your product, set the price - watch it fly off the shelves!</p>
                    <button class="ghost" id="signIn">Add Product</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Mr. {{$user->name}}!</h1>
                    <p>Unveil the excitement, ignite the bidding war - let the auction frenzy begin!</p>
                    <button class="ghost" id="signUp">Add Event</button>
                </div>
            </div>
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
