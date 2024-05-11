<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidding Events</title>


    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/productCardStyle.css")}}">

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
        .storesHeader{
            text-align:center;
            margin-top:5%;
            color:    #1e90ff;
        }

        body{

background-color: #eee;
}
.container{
width: 900px;
}

.card{

background-color: #fff;
border:none;
border-radius: 10px;
width: 190px;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}
.image-container {
    width: 100%; /* Set width to 100% for responsiveness */
    height: 200px; /* Set a fixed height for the container */
    overflow: hidden; /* Hide overflow to prevent stretching */
    border-radius: 10px; /* Apply border radius for rounded corners */
}

.thumbnail-image {
    width: 100%; /* Set width to 100% to fill the container */
    height: auto; /* Allow image height to adjust based on aspect ratio */
    object-fit: cover; /* Ensure image covers its container */
}



.discount{

background-color: red;
padding-top: 1px;
padding-bottom: 1px;
padding-left: 4px;
padding-right: 4px;
font-size: 10px;
border-radius: 6px;
color: #fff;
}

.wishlist{

height: 25px;
width: 25px;
background-color: #eee;
display: flex;
justify-content: center;
align-items: center;
border-radius: 50%;
box-shadow:  0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.first{

position: absolute;
width: 100%;
    padding: 9px;
}


.dress-name{
font-size: 13px;
font-weight: bold;
width: 75%;
}
.dress-description {
    font-size: 11px; /* Adjust the font size as needed */
    color: #555; /* Adjust the color to make it a bit less dark */
}


.new-price{
font-size: 13px;
font-weight: bold;
color: darkred;

}
.old-price{
font-size: 8px;
font-weight: bold;
color: grey;
}


.btn{
width: 14px;
height: 14px;
border-radius: 50%;
padding: 3px;
}

.creme{
background-color: #fff;
border: 2px solid grey;


}
.creme:hover {
border: 3px solid grey;
}

.creme:focus {
background-color: grey;

}


.red{
background-color: #fff;
border: 2px solid red;

}


.red:hover {
border: 3px solid red;
}
.red:focus {
background-color: red;
}



.blue{
background-color: #fff;
border: 2px solid #40C4FF;
}

.blue:hover {
border: 3px solid #40C4FF;
}
.blue:focus {
background-color: #40C4FF;
}
.darkblue{
background-color: #fff;
border: 2px solid #01579B;
}
.darkblue:hover {
border: 3px solid #01579B;
}
.darkblue:focus {
background-color: #01579B;
}
.yellow{
background-color: #fff;
border: 2px solid #FFCA28;
}
.yellow:hover {
border-radius: 3px solid #FFCA28;
}
.yellow:focus {
background-color: #FFCA28;
}


.item-size{
width: 15px;
height: 15px;
border-radius: 50%;
background: #fff;
border: 1px solid grey;
color: grey;
font-size: 10px;
text-align: center;
align-items: center;
display: flex;
justify-content: center;
}


.rating-star{
font-size: 10px !important;
}
.rating-number{
font-size: 10px;
color: grey;

}
.buy{
font-size: 12px;
color: purple;
font-weight: 500;
padding: 8px;
border-radius: 8px;
border-style: none;
}














.voutchers{
background-color: #fff;
border:none;
border-radius: 10px;
width: 190px;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
overflow: hidden;

}
.voutcher-divider{

display: flex;

}
.voutcher-left{
width: 60%
}
.voutcher-name{
color: grey;
font-size: 9px;
font-weight: 500;
}
.voutcher-code{
color: red;
font-size: 11px;
font-weight: bold;
}
.voutcher-right{
width: 40%;
background-color: purple;
color: #fff;
}

.discount-percent{
font-size: 12px;
font-weight: bold;
position: relative;
top: 5px;
}
.off{
font-size: 14px;
position: relative;
bottom: 5px;
}

    </style>
</head>

<body>
@include('buyerLayout.buyerNav',['currencies'=>$currencies])


@php
    $chunks = $product->chunk(3);
@endphp

<div class="pricing4 py-5 bg-light">
  <div class="container">
    <!-- Row  -->
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <h3 class="mb-3"><span class="orange-text">Extraordinary</span> Pricing for your Daily Use</h3>
        <h6 class="subtitle font-weight-normal">You can rely on our amazing features list and also our customer services will be a great experience for you without a doubt</h6>
      </div>
    </div>
    <!-- Row  -->
    @foreach($chunks as $chunk)
    <div class="row mt-4">
        @foreach($chunk as $p)

        <div class="card">

            <div class="image-container">

                <div class="first">

                    <div class="d-flex justify-content-between align-items-center">
                    <span class="discount">-25%</span>
                    <span class="wishlist"><ion-icon name="heart-outline"></ion-icon></span>
                    </div>
                </div>

                <div class="image-container">
    <img src="{{ asset($p->product_url) }}" class="img-fluid rounded thumbnail-image">
</div>



        </div>


        <div class="product-detail-container p-2">
            <div class="d-flex justify-content-between align-items-center">
                    <h5 class="dress-name">{{$p->product_name}}</h5>

                    <div class="d-flex flex-column mb-2">

                        <span class="new-price" id="product-price">
                            {{ number_format($p->price * $apiCurrency['conversion_rates'][auth()->user()->getCurrency->currency_code], 2) }} {{ auth()->user()->getCurrency->currency_code }}
                        </span>


                        <small class="old-price text-right"></small>
                    </div>

            </div>

            <h6 class="dress-description">{{$p->description}}</h6>
        <div class="d-flex justify-content-between align-items-center pt-1">






        </div>

            <!-- Contact and shoppingg cartttttt-->
        <div class="d-flex justify-content-between align-items-center pt-1">
        <div class="d-flex justify-content-center">

                <a href="">
                <button class="buy d-flex align-items-center"><ion-icon name="call"></ion-icon> Contact</button>
                </a>
            </div>
             <div class="d-flex justify-content-center">
                 <a href="{{route('addProductReview',$p->id)}}">
                     <button class="buy d-flex align-items-center"><ion-icon name="chatbox-ellipses-outline"></ion-icon> Add Review</button>
                 </a>
                <form action="{{ route('addToCart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="productId" value="{{ $p->id }}">
                    <button type="submit" class="buy d-flex align-items-center">Add To Cart <ion-icon name="cart"></ion-icon></button>
                </form>
        </div>






        </div>



</div>

</div>

        @endforeach
    </div>
    @endforeach
  </div> <!-- Close container -->
</div> <!-- Close pricing4 -->






<!-- Bootstrap JS -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add this script to your Blade template or external JavaScript file -->
<script>
    $(document).ready(function() {
        // Function to update prices based on currency change
        $('#baseCurrencySelect').change(function() {
            var currencyId = $(this).val();

            // Make AJAX request to fetch updated exchange rates
            $.ajax({
                url: '/update-exchange-rates',
                type: 'POST',
                data: {
                    currency_id: currencyId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update prices on the page based on the new exchange rates
                    updatePrices(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Function to update prices on the page
        function updatePrices(exchangeRates) {
            // Loop through each product and update its price
            $('#product-price').each(function() {
                var price = parseFloat($(this).data('price'));
                var currencyCode = $(this).data('currency-code');
                var convertedPrice = price * exchangeRates[currencyCode];

                // Update the price on the page
                $(this).text(convertedPrice.toFixed(2) + ' ' + currencyCode);
            });
        }
    });
</script>

</body>
</html>
