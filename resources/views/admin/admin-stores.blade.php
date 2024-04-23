
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
            .status-button {
                padding: 8px 16px;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                color: #fff;
                font-size: 14px;
            }
        
            .activate-button {
                background-color: #28a745; 
            }
        
            .deactivate-button {
                background-color: #dc3545;
            }
        
            .status-button:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
            .storeInfo {
                color: gold;
                
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
                    <a href="{{route('admin.users')}}">
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
                    <a href="{{route('admin.orders')}}">
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
                        <div class="numbers">{{ $total_stores }}</div>
                        <div class="cardName">Total Stores</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="storefront-outline"></ion-icon>
                    </div>
                </div>
                <a href="{{route('admin.stores.activated')}}" style="text-decoration: none;">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $active_stores }}</div>
                        <div class="cardName">Activated Stores</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="storefront-outline"></ion-icon>
                    </div>
                </div>
            </a>
            <a href="{{route('admin.stores.deactivated')}}" style="text-decoration: none;">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $deactivated_stores }}</div>
                        <div class="cardName">Deactivated Stores</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="storefront-outline"></ion-icon>
                    </div>
                </div>
            </a>
            </div>

            <!-- ================ Stores Details List ================= -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>All Stores</h2>
                </div>

                <table>
                    @foreach ($all_stores as $store)
                    
                    <tr>
                        
                        <td width="60px">
                            <div class="imgBx">
                                @if ($store->image_url)
                                    <img id="avatar" src="{{ asset($store->image_url) }}" alt="Avatar" class="d-block ui-w-80">
                                @else
                                <i class="bi bi-shop"></i>
                                @endif
                        </div>
                        </td>
                        <td>
                            <h4>{{ $store->store_name}} <br> <span>{{$store->getUser->name}}</span></h4>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('store.updateStatus', $store->id) }}">
                                @csrf
                                @method('PUT')
                                <td>
                                    <button type="submit" name="status" value="activated" class="status-button activate-button" {{ $store->is_active ? 'disabled' : '' }}>Activate</button>
                                    <button type="submit" name="status" value="deactivated" class="status-button deactivate-button" {{ $store->is_active ? '' : 'disabled' }}>Deactivate</button>
                                </td>
                                <td>
                                    <a href="{{route('store.info', ['store_id' => $store->id])}}" class="storeInfo" >
                                    <ion-icon name="information-circle-outline" size="large" class="storeInfoIcon"></ion-icon>
                                </a>
                            </td>
                            </form>
                        </td>
                   
                    </tr>
                
                    @endforeach
                    
                    
                   
                </table>
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
