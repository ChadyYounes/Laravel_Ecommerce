<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FlipCart</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/productCard.css')}}" rel="stylesheet">
    <link href="{{asset('css/storeReport.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

    <style>
        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-canceled {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status-shipped {
            background-color: #cce5ff;
            color: #004085;
        }
        .error ul {
            color: red;
        }
    </style>
</head>
<body>
    @include('storeManagement.sellerNav')
    
    <div class="container">
        <!-- Form to filter by date -->
        <form id="filter-form" action="{{ route('filterOrders') }}" method="POST">
            @csrf
            <div class="dateFields">
                @if ($errors->any())
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        
                <div class="date-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', now()->toDateString()) }}">
        
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', now()->toDateString()) }}">
                </div>
                <button type="submit">Submit</button>
            </div>
        </form>
        

        <!-- Dropdown for status filter -->
        <div class="status-filter">
            <label for="order_status">Filter by Status:</label>
            <select id="order_status">
                <option value="all">All</option>
                <option value="delivered">Delivered</option>
                <option value="pending">Pending</option>
                <option value="canceled">Canceled</option>
                <option value="shipped">Shipped</option>
            </select>
        </div>

        <h1>Filtered Orders</h1>

        <!-- Table container for vertical scroll -->
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Buyer Name</th>
                        <th>Total Amount</th>
                        <th>Delivery Address</th>
                        <th>Order Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody id="order-table-body">
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->getUser->name }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->delivery_address }}</td>
                            <td class="status-{{ $order->order_status }}">
                                {{ ucfirst($order->order_status) }}
                            </td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Handle real-time status filter
        document.getElementById('order_status').addEventListener('change', function() {
            var status = this.value;

            // Perform an AJAX request to filter the orders by status
            fetch("{{ route('filterByStatus') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                // Clear current table rows
                var tableBody = document.getElementById('order-table-body');
                tableBody.innerHTML = '';

                // Populate new rows based on the filtered data
                data.orders.forEach(order => {
                    var row = document.createElement('tr');

                    var orderId = document.createElement('td');
                    orderId.textContent = order.id;
                    row.appendChild(orderId);

                    var buyerName = document.createElement('td');
                    buyerName.textContent = order.buyer_name;
                    row.appendChild(buyerName);

                    var totalAmount = document.createElement('td');
                    totalAmount.textContent = order.total_amount;
                    row.appendChild(totalAmount);

                    var deliveryAddress = document.createElement('td');
                    deliveryAddress.textContent = order.delivery_address;
                    row.appendChild(deliveryAddress);

                    var orderStatus = document.createElement('td');
                    orderStatus.textContent = order.order_status.charAt(0).toUpperCase() + order.order_status.slice(1);
                    orderStatus.className = 'status-' + order.order_status;
                    row.appendChild(orderStatus);

                    var createdAt = document.createElement('td');
                    createdAt.textContent = order.created_at;
                    row.appendChild(createdAt);

                    // Append the row to the table body
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
