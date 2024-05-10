
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
   <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <style>
             .btn-deliver {
                background-color: red;
                color: white;
                padding: 4px;
                border-radius: 15px;
                border: transparent;
                box-shadow: 5px 3px black;
                
            }
        </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="globe-outline"></ion-icon>
                        </span>
                        <span class="title">CRACK E-Commerce</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('home')}}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>


                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="storefront-outline"></ion-icon>
                        </span>
                        <span class="title">Stores</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.categories')}}">
                        <span class="icon">
                            <ion-icon name="list-outline"></ion-icon>
                        </span>
                        <span class="title">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.super_search_view')}}">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                        <span class="title">Super Search</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('edit-profile') }}">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Edit Profile</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                       
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-button">
                                <span class="title">Sign Out</span>
                            </button>
                        </form>
                    </a>
                </li>
               
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

              

                
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
               
                <div class="card">
                    <div>
                        <div class="numbers">{{$all_orders->count()}}</div>
                        <div class="cardName">Total Orders</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>

               

            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>All Orders</h2>
                        
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Buyer Name</th>
                                <th>Store(s)</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            @foreach ($all_orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->getUser->name }}</td>
                                <td>
                                    <select >
                                        @foreach ($order->getOrderItem as $orderItem)
                                            <option>{{ $orderItem->getProduct->getStore->store_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>${{ $order->total_amount }}</td>
                                <td>
                                    @if ($order->order_status === 'pending')
                                        <span class="status pending">Pending</span>
                                    @elseif ($order->order_status === 'paid')
                                        <span class="status paid">Paid</span>
                                    @elseif ($order->order_status === 'delivered')
                                        <span class="status delivered">Delivered</span>
                                    @endif
                                </td>
                                @if ($order->order_status !== 'delivered')
                                <td>
                    <form action="{{ route('changeOrderStatus', ['order_id' => $order->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-deliver">Mark as Delivered</button>
                    </form>
                </td>
                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

               
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{asset('js/admin.js')}}"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
{{-- 
    <td><span class="status delivered">Delivered</span></td> 
    <td><span class="status inProgress">In Progress</span></td>
    <td><span class="status return">Return</span></td>
    <td><span class="status pending">Pending</span></td>
    --}}