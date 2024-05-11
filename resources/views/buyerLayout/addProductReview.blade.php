<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Single News</title>

    <!-- favicon -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/productCardStyle.css")}}">
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href={{asset("assets/bootstrap/css/bootstrap.min.css")}}>
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
    <link rel="stylesheet" href={{asset("assets/css/responsive.css")}}>

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
            /*border-radius: 3px solid #FFCA28;*/
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

<!--PreLoader-->
{{--<div class="loader">--}}
{{--    <div class="loader-inner">--}}
{{--        <div class="circle"></div>--}}
{{--    </div>--}}
{{--</div>--}}
<!--PreLoader Ends-->

<!-- header -->
@include('buyerLayout.buyerNav',['currencies'=>$currencies])


<!-- single article section -->
@if($product)
    <div class="mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-article-section">
                        <div class="single-article-text">
                            @if($product->product_url)
                                <img src="{{asset($product->product_url)}}" alt="">
                            @endif
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Admin</span>
                                <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                            </p>
                            <h2>{{$product->product_name}}</h2>
                            <p>{{$product->description}}</p>
                        </div>

                        <div class="comments-list-wrap">
                            <h3 class="comment-count-title">{{$count}} Comments</h3>
                            <div class="comment-list">
                                @foreach($reviews as $review)
                                    <div class="single-comment-body">
                                        <div class="comment-user-avater">
                                            <img src={{asset("assets/img/avaters/149071.png")}} alt="">
                                        </div>
                                        <div class="comment-text-body">
                                            <h4>{{$review->getUser->name}}<span class="comment-date">{{ $review->created_at->format('F d, Y h:m') }}</span> <a href="#">reply</a></h4>
                                            <p>{{$review->review}}.</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="comment-template">
                            <h4>Leave a comment</h4>
                            <p>If you have a comment dont feel hesitate to send us your opinion.</p>
                            <form action="{{route('addProductReviewStore')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <p><textarea name="review" id="comment" cols="30" rows="10" placeholder="Your Message"></textarea></p>
                                <p><input type="submit" value="Submit"></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-section">
                        <div class="recent-posts">
                            <h4>Recent Posts</h4>
                            <ul>
                                <li><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></li>
                                <li><a href="single-news.html">A man's worth has its season, like tomato.</a></li>
                                <li><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></li>
                                <li><a href="single-news.html">Fall in love with the fresh orange</a></li>
                                <li><a href="single-news.html">Why the berries always look delecious</a></li>
                            </ul>
                        </div>
                        <div class="archive-posts">
                            <h4>Archive Posts</h4>
                            <ul>
                                <li><a href="single-news.html">JAN 2019 (5)</a></li>
                                <li><a href="single-news.html">FEB 2019 (3)</a></li>
                                <li><a href="single-news.html">MAY 2019 (4)</a></li>
                                <li><a href="single-news.html">SEP 2019 (4)</a></li>
                                <li><a href="single-news.html">DEC 2019 (3)</a></li>
                            </ul>
                        </div>
                        <div class="tag-section">
                            <h4>Tags</h4>
                            <ul>
                                <li><a href="single-news.html">Apple</a></li>
                                <li><a href="single-news.html">Strawberry</a></li>
                                <li><a href="single-news.html">BErry</a></li>
                                <li><a href="single-news.html">Orange</a></li>
                                <li><a href="single-news.html">Lemon</a></li>
                                <li><a href="single-news.html">Banana</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- end single article section -->


<!-- jquery -->
<script src="assets/js/jquery-1.11.3.min.js"></script>
<!-- bootstrap -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- count down -->
<script src="assets/js/jquery.countdown.js"></script>
<!-- isotope -->
<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
<!-- waypoints -->
<script src="assets/js/waypoints.js"></script>
<!-- owl carousel -->
<script src="assets/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- mean menu -->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!-- sticker js -->
<script src="assets/js/sticker.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>

</body>
</html>
