<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidding Events</title>

    <link href="{{asset("css/navbar.css")}}" rel="stylesheet">

    <link href="{{asset("css/logout.css")}}" rel="stylesheet">
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
  
    </style>
</head>

<body>
@include('buyerLayout.buyerNav',['currencies'=>$currencies])
<div class="container mt-5">
    <h3 class="mb-4">Bidding Events</h3>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Event Name</th>
            <th>Store Name</th>
            <th>Date & Time</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Starting Price</th>
            <th>Minimum Increase</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>

                <td>{{ $event->event_name }}</td>
                <td>{{ $event->getStore->store_name }}</td>
                <td>{{ \Carbon\Carbon::parse($event->event_datetime)->format('l, F j, Y h:i A') }}</td>
                <td>{{ $event->product_name }}</td>
                <td><img src="{{ asset($event->product_image_url) }}" alt="Product Image" class="img-thumbnail" style="max-width: 100px;"></td>
                <td>{{ $event->starting_price }} $</td>
                <td>{{ $event->minimum_increase }} $</td>
                <td>
                    <form method="POST" action="{{route('subscribeToEvent')}}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <button type="submit" class="btn btn-primary btn-sm">Subscribe</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
@include('footer.footer')

</html>
