<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>FlipCart - Buyer</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

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

        </style>
    </head>


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
                <li><a href="">Home</a></li>
                <li><a href="{{route('buyerStores')}}">View Stores</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#" id="user-icon" class="my-auto">Logout</a></li>
            </ul>
            <h1 class="logo">FlipCart</h1>
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

    
<!-- home -->


	<!-- features list section -->
	<div class="list-section pt-80 pb-80 ">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
                        <img width="50" height="50" class="mr-2 mb-3" src="https://img.icons8.com/ios/50/cruise-ship.png" alt="cruise-ship"/>
						</div>
						<div class="content">
							<h3>Free Shipping</h3>
							<p>When order over $75</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
                        <img width="50" height="50" class="mr-2 mb-1" src="https://img.icons8.com/ios/50/support.png" alt="support"/>	
    					</div>
						<div class="content">
							<h3>24/7 Support</h3>
							<p>Get support all day</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
                        <img width="50" height="50" class="mr-2 mb-1" src="https://img.icons8.com/wired/64/refund.png" alt="refund"/>	
    </div>
                        <div class="content">
							<h3>Refund</h3>
							<p>Get refund within 3 days!</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Our</span> News</h3>
						<p>Discover the latest deals and trends on Flipcart, your go-to destination for all things eCommerce!</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href=""><div class="latest-news-bg news-bg-1"></div></a>
						<div class="news-text-box">
							<h3><a href="">You will vainly look for the newest technology in 2024.</a></h3>
							<p class="blog-meta">
								<span class="author"> Chady</span>
								<span class="date"> 20 April, 2024</span>
							</p>
							<p class="excerpt">Save the moment, indulge in flavors, embrace life's exciting adventures ahead.</p>
							<a href="" class="read-more-btn">read more <img width="24" height="24" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah.png" alt="external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah"/></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href=""><div class="latest-news-bg news-bg-2"></div></a>
						<div class="news-text-box">
							<h3><a href="">A man's worth has its season, like tomato.</a></h3>
							<p class="blog-meta">
								<span class="author"> Kassem</span>
								<span class="date"> 20 April, 2024</span>
							</p>
							<p class="excerpt">Experience the thrill, taste the excitement, and cherish every flavorful memory.</p>
							<a href="" class="read-more-btn">read more <img width="24" height="24" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah.png" alt="external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah"/></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
					<div class="single-latest-news">
						<a href=""><div class="latest-news-bg news-bg-3"></div></a>
						<div class="news-text-box">
							<h3><a href="">Good thoughts bear good fresh juicy oils.</a></h3>
							<p class="blog-meta">
								<span class="author"> Amine</span>
								<span class="date"> 27 April, 2024</span>
							</p>
							<p class="excerpt">Dive into joyous bites, relish each flavor, and celebrate life's tasty moments.</p>
							<a href="" class="read-more-btn">read more <img width="24" height="24" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah.png" alt="external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah"/></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="" class="boxed-btn">More News</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->

	<!-- cart banner section -->
	<section class="cart-banner pt-100 pb-100">
    	<div class="container">
        	<div class="row clearfix">
            	<!--Image Column-->
            	<div class="image-column col-lg-6">
                	<div class="image">
                    	<div class="price-box">
                        	<div class="inner-price">
                                <span class="price">
                                    <strong>30%</strong> <br> off per kg
                                </span>
                            </div>
                        </div>
                    	<img src="assets/img/a.jpg" alt="">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
					<h3><span class="orange-text">Deal</span> of the month</h3>
                    <h4>Quality Food</h4>
                    <div class="text">Trade in the ordinary for extraordinary savings this month! Dive into a world of sweetness with our exclusive deal on Hikan Strawberry delights. Say goodbye to boring snacks and hello to indulgence without the guilt.

Don't wait! Treat yourself to the taste of luxury without breaking the bank. Grab your share of Hikan Strawberry goodness before it's all gone!</div>
                    <!--Countdown Timer-->
                    <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2020/2/01"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div>
                	<a href="cart.html" class="cart-btn mt-3"><img width="16" height="16" src="https://img.icons8.com/office/16/shopping-cart.png" alt="shopping-cart"/> Add to Cart</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart banner section -->

	
	<!-- advertisement section -->
	<div class="abt-section mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Since Year 1999</p>
						<h2>We are <span class="orange-text">FlipCart</span></h2>
						<p>At Flipcart, we're dedicated to providing you with an unparalleled shopping experience. With a commitment to quality, convenience, and customer satisfaction, we strive to be your trusted destination for all your shopping needs.</p>
                         <p>Explore our vast selection of products and discover the difference with Flipcart.</p>
                        <a href="" class="boxed-btn mt-4">know more</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->
	
	<!-- shop banner -->
	<section class="shop-banner">
    	<div class="container">
        	<h3>May sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
	<!-- end shop banner -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Our</span> Products</h3>
						<p>Discover the latest deals and trends on Flipcart, your go-to destination for all things eCommerce!</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="single-news.html"><div class="latest-news-bg news-bg-1"></div></a>
						<div class="news-text-box">
							<h3><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></h3>
							<p class="blog-meta">
								<span class="author"> Chady</span>
								<span class="date"> 20 April, 2024</span>
							</p>
							<p class="excerpt">Savor the moment, indulge in flavors, embrace life's delicious adventures ahead.</p>
							<a href="" class="read-more-btn">read more <img width="24" height="24" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah.png" alt="external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah"/></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="single-news.html"><div class="latest-news-bg news-bg-2"></div></a>
						<div class="news-text-box">
							<h3><a href="single-news.html">A man's worth has its season, like tomato.</a></h3>
							<p class="blog-meta">
								<span class="author"> Kassem</span>
								<span class="date"> 20 April, 2024</span>
							</p>
							<p class="excerpt">Experience the thrill, taste the excitement, and cherish every flavorful memory.</p>
							<a href="" class="read-more-btn">read more <img width="24" height="24" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah.png" alt="external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah"/></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
					<div class="single-latest-news">
						<a href="single-news.html"><div class="latest-news-bg news-bg-3"></div></a>
						<div class="news-text-box">
							<h3><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></h3>
							<p class="blog-meta">
								<span class="author"> Amine</span>
								<span class="date"> 27 April, 2024</span>
							</p>
							<p class="excerpt">Dive into joyous bites, relish each flavor, and celebrate life's tasty moments.</p>
							<a href="" class="read-more-btn">read more <img width="24" height="24" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah.png" alt="external-add-video-and-movie-tanah-basah-basic-outline-tanah-basah"/></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="" class="boxed-btn">More News</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->


	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>t Flipcart, we're dedicated to providing you with an unparalleled shopping experience. With a commitment to quality, convenience, and customer satisfaction, we strive to be your trusted destination for all your shopping needs</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>Lebanon, Beirut.</li>
							<li>support@fruitkha.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="services.html">Shop</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.html">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->
	
	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Web II</a>,  All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->
	
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


<!-- end home -->

        





      
        </div>
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("lib/waypoints/waypoints.min.js")}}"></script>
    <script src="{{asset("lib/lightbox/js/lightbox.min.js")}}"></script>
    <script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset("js/main.js")}}"></script>
    <script>
        $(document).ready(function() {
            $('#base-currency').on('change', function() {
                var selectedCurrency = $(this).val();
                var token = "{{ csrf_token() }}";

                // Send AJAX request to update base currency
                $.ajax({
                    url: "{{ route('update-base-currency') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': token
                    },
                    data: {
                        currency: selectedCurrency
                    },
                    success: function(response) {
                        // Handle success
                        console.log('Base currency updated successfully');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error updating base currency');
                    }
                });
            });
        });
    </script>
    </body>

</html>
