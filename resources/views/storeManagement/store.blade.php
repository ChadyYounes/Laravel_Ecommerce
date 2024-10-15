
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Stores - Seller </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>

           <!-- Template Stylesheet -->
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
.storesHeader{
    text-align:center;
    margin-top:5%;
    color:    #1e90ff;
}
</style>
    </head>

<!-- navbar -->
<body>
@include('storeManagement.sellerNav')
<!--end navbar-->

<!-- product section -->
<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Manage</span> Your Stores</h3>
						<p>Create your store, unleash your creativity, and watch your dreams come to life..</p>
					</div>
				</div>
			</div>

@php $storesChunks = $stores->chunk(3); @endphp
@foreach($storesChunks as $chunk)

<div class="row">
    @foreach($chunk as $store)
    <div class="col-lg-4 col-md-6 text-center" style="background-color: white;" >
    <div class="single-product-item" style="background-color: #e7e7e7;border:2px solid orange;">
        <div class="product-image">
            <a href="{{route('updateView',['store_id'=>$store->id,'user_id'=>$user->id])}}">
                <img src="{{ asset('storage/' . $store->image_url) }}" alt="">
            </a>
        </div>
        <h3>{{ $store->store_name }}</h3>
        <p class="product-price"><span>{{ $store->store_category }}</span></p>
        <a href="{{ route('productsView',['store_id'=>$store->id]) }}" class="cart-btn">Manage</a>
        <form action="{{ route('deleteStore', ['store_id' => $store->id]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
          <a class="cart-btn delete-btn"><button type="submit" class="cart-btn delete-btn" style="border: none; background: none; cursor: pointer; color: #fff; text-decoration: none;">Delete</button></a>
        </form>
    </div>
</div>


    @endforeach
</div>
@endforeach
<br>
<div class="custom-pagination">
    {{ $stores->links() }}
</div>
<br><br>
</div>
	<!-- end product section -->




@if(session('updateSuccess'))
<div id="popup">
    <div id="popup-content">
        <p>{{ session('updateSuccess') }}</p>
        <button id="proceed-btn" style="margin-top:3%;">Proceed</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("lib/waypoints/waypoints.min.js")}}"></script>
    <script src="{{asset("lib/lightbox/js/lightbox.min.js")}}"></script>
    <script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>


    <!-- Template Javascript -->
    <script src="{{asset("js/main.js")}}"></script>

</body>
@include('footer.footer')
</html>
