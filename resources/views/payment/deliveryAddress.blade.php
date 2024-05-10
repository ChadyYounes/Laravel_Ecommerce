<!DOCTYPE html>
<html>
<head>
    <title>Delivery Address</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="{{asset("css/deliveryAddress.css")}}" /> 
    
</head>
<body>
    <header>
        <h2>Delivery Address</h2>
    </header>
    <main>
        <div id="map"></div>
        <form action="/session-stripe" method="POST" class="checkout-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type='hidden' name="total" value="{{ $totalPrice }}">
            <input type='hidden' name="productname" value="{{ $shoppingCart ? $shoppingCart->getShoppingCartItem->implode('getProduct.product_name', ', ') : '' }}">
            <div class="form-group">
                <label for="userAddress">Delivery Address:</label>
                <input type="text" id="userAddress" name="userAddress" value="{{$user->getProfile->address}}" placeholder="Enter your address" required>
            </div>
            <div class="form-group">
                <label for="location">Specific address from map:</label>
                <input type="text" id="location" name="specificLocation" placeholder="Pin your location on the map" value="" readonly required>
            </div>
            <div class="button-group">
                <a href="{{ route('shoppingCart') }}" class="btn btn-danger">
                    <i class="fa fa-arrow-left"></i> Back to shopping cart
                </a>
                <button class="btn btn-success" type="submit" id="checkout-live-button">
                    <i class="fa fa-money"></i> Pay with Stripe
                </button>
            </div>
        </form>
    </main>
   <script src="{{asset("js/deliveryAddress.js")}}"></script>
   
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgLQLq-Ll1NHIQ1r3JXRhQOKeJHEVtzjY&callback=initMap&v=weekly
    &libraries=places"
    defer 
  ></script>
 
</body>
</html>
