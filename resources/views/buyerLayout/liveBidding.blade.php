<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Auction</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .auction-container {
            max-width: 800px;
            width: 100%;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .auction-header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .auction-header h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .product-details {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .product-details img {
            max-width: 200px;
            margin-right: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-details h4 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .current-bid-info {
            margin-bottom: 20px;
        }

        .current-bid-info h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .bid-input-area {
            display: flex;
            align-items: center;
        }

        .bid-input-area input[type="number"] {
            width: 150px;
            margin-right: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .bid-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .bid-history {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .bid-history h2 {
            margin-top: 0;
            font-size: 20px;
            color: #333;
        }

        .bid-item {
            margin-bottom: 5px;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="auction-container">
    <header class="auction-header">
        <h2><i class="fas fa-gavel"></i> Live Auction: {{ $event->event_name }}</h2>
    </header>

    <div class="product-details">
        <img src="{{ asset($event->product_image_url) }}" alt="Product Image">
        <div>
            <h4>{{ $event->product_name }}</h4>
            <p><strong>Starting Price:</strong> ${{ $event->starting_price }}</p>
            <p><strong>Minimum Increase:</strong> ${{ $event->minimum_increase }}</p>
        </div>
    </div>

    <div class="current-bid-info">
        @if($currentBid)
            <h3>Current Highest Bid: $<span id="currentBid">{{ $currentBid->amount }}</span></h3>
        @endif
        <div class="bid-input-area">
            <form method="post" action="{{route('placeBid')}}">
                @csrf
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <input type="number" step="0.01" min="{{ $event->starting_price }}" name="bidAmount" id="bidAmount" class="form-control" placeholder="Enter your bid...">
                <button type="button" id="placeBid" class="btn btn-primary bid-btn">Place Bid</button>
            </form>
        </div>
    </div>

    <div class="bid-history">
        <h2>Bid History</h2>
        <ul id="bidHistory">
            @foreach($eventBids as $bid)
                <li class="bid-item">Bidder {{ $bid->getUser->name }} placed a bid of ${{ $bid->amount }}</li>
            @endforeach
        </ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('#placeBid').click(function (e) {
            e.preventDefault(); // Prevent default form submission

            // Serialize form data
            var formData = $('form').serialize();

            // Send AJAX request
            $.ajax({
                url: "{{ route('placeBid') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    // alert('Bid placed successfully');
                },
                error: function (xhr, status, error) {
                    // alert('Error: ' + xhr.responseText);
                }
            });
        });
        Pusher.logToConsole = true;
        // Pusher code remains unchanged
        const pusher = new Pusher('8cfdd2443899a0acb693', {
            cluster: 'ap2'
        });
        const channel = pusher.subscribe('auction');

        channel.bind('bid-event', function (data) {
            // alert(data);
            const amount = parseFloat(data.amount); // Convert the bid amount to a floating-point number

            // const user_id = data.user_id;
            const name = data.name;

            const bidWindow = document.getElementById('bidHistory');
            const listItem = document.createElement('li');
            listItem.classList.add('bid-item');
            listItem.textContent = `Bidder ${name} placed a bid of $${amount }`;
            bidWindow.appendChild(listItem);
            const currentBid=document.getElementById('currentBid');
            currentBid.innerHTML=amount;
        });
    });
</script>

</body>
</html>
