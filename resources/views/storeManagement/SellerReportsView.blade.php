<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FlipCart</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{asset("css/productCard.css")}}" rel="stylesheet">
    <link href="{{asset("css/navbar.css")}}" rel="stylesheet">
    <link href="{{asset("css/logout.css")}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>
    
    <!-- Template Stylesheet -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <!-- Template Stylesheet -->

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

        .logout-button {
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
            transition: background-color 0.3s ease;
            font-weight: bold;
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
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .username {
            color: black;
        }

        .logout-button:hover,
        .edit-profile-button:hover {
            background-color: lightgray;
        }

        .logout-div {
            position: absolute;
            width: 150px; 
        }
        [type="date"] {
  background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
}
[type="date"]::-webkit-inner-spin-button {
  display: none;
}
[type="date"]::-webkit-calendar-picker-indicator {
  opacity: 0;
}


label {
  display: block;
}
input {
  border: 1px solid #c4c4c4;
  border-radius: 5px;
  background-color: #fff;
  padding: 3px 5px;
  box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
  width: 190px;
}
.dateHeaders{
    display: flex;
    justify-content: center;
    align-items: center;
}
.innerHeader{
    display: flex;
    flex-direction: column;
    margin-right: 10%;
    margin-left: 10%;

}
    </style>
</head>
<body>

    <!-- navbar -->
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
        <p class="username">{{$user->name}}</p>
        <hr>
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

<!-- end navbar -->    
<form id="filter-form" action="{{ route('filterOrders') }}" method="POST">
        @csrf
        <div class="dateFields">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">

            <button type="submit">Submit</button>
        </div>
    </form>
    <h1>Filtered Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Buyer ID</th>
                <th>Total Amount</th>
                <th>Delivery Address</th>
                <th>Order Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->buyer_id }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->order_status }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
