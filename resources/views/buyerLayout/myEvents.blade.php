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
                <td>{{ $event->getEvent->event_name }}</td>
                <td>{{ $event->getEvent->getStore->store_name }}</td>
                <td>{{ \Carbon\Carbon::parse($event->getEvent->event_datetime)->format('l, F j, Y h:i A') }}</td>
                <td>{{ $event->getEvent->product_name }}</td>
                <td><img src="{{ asset($event->getEvent->product_image_url) }}" alt="Product Image" class="img-thumbnail" style="max-width: 100px;"></td>
                <td>{{ $event->getEvent->starting_price }} $</td>
                <td>{{ $event->getEvent->minimum_increase }} $</td>
                <td>
                    <button id="joinBtn{{$event->id}}" type="button" class="btn btn-primary btn-sm" disabled onclick="joinEvent({{$event->getEvent->id}})">
                        Join (<span id="countdown{{$event->id}}" class="countdown-text"></span>)
                    </button>
                    <form id="unsubscribeForm{{$event->id}}" method="POST" action="{{route('unsubscribeFromEvent')}}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <button id="unsubscribeBtn{{$event->id}}" type="submit" class="btn btn-danger btn-sm">Unsubscribe</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Define countdownTimer variable in the global scope
    var countdownTimer = {};

    // Function to update countdown for each event
    function updateCountdown(endTime, countdownElement, buttonElement) {
        var now = new Date().getTime();
        var distance = endTime - now;

        // If the countdown has ended
        if (distance <= 0) {
            clearInterval(countdownTimer); // Stop the countdown timer
            $(countdownElement).text("Event Started"); // Update the countdown display
            $(buttonElement).prop("disabled", false); // Enable the button
        } else {
            // Calculate remaining time
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the remaining time in the countdown element
            $(countdownElement).text(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
        }
    }

    $(document).ready(function () {
        @foreach($events as $event)
        var countdownElement{{$event->id}} = $("#countdown{{$event->id}}");
        var buttonElement{{$event->id}} = $("#joinBtn{{$event->id}}");
        var endTime{{$event->id}} = new Date("{{$event->getEvent->event_datetime}}").getTime();

        // Update countdown every second
        countdownTimer{{$event->id}} = setInterval(function () {
            updateCountdown(endTime{{$event->id}}, countdownElement{{$event->id}}, buttonElement{{$event->id}});
        }, 1000);
        @endforeach
    });
</script>
<script>
    function joinEvent(eventId) {
        // Redirect to the specific route using JavaScript
        window.location.href = "{{route('liveBidding', ':eventId')}}".replace(':eventId', eventId);
    }
</script>
</body>
@include('footer.footer')

</html>
