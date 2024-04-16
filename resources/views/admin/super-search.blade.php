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
            .searchContainer {
                position: absolute;
                right: 30%;
                top:50px;

            }
            .searchField {
                margin-bottom: 50px;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 5px;
                border-radius: 25px;
                box-shadow: 5px 5px  black;
                width: 500px;
            }
            .searchButton {
                background-color: lightyellow;
                padding: 5px;
                border-radius: 10px;
                color: black;
                box-shadow: 5px 5px  black;
                margin-left: 15px;
                width: 100px;
            }
            .searchResultLabel {
                margin-bottom: 20px;
                
            }
            .li_result {
                background-color: lightblue;
                padding: 5px;
                margin-top: 7px;
                border: 1px solid black;
                color: black;
                list-style: none;
                border-radius: 20px;
                text-align: center;
            }
            .infoIcon {
                color: yellow;
                font-weight: 600;
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
                    <a href="{{route('admin.stores')}}">
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
                    <a href="#">
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
        <div class="searchContainer">
            
            <form action="{{ route('admin.super_search_view') }}" method="GET">
                @csrf
                <input type="text" class="searchField" name="query" placeholder="search for a user, store, product ">
                <button type="submit" class="searchButton">Search</button>
            </form>
                 <!-- Display search results if available -->
                @if(isset($users) || isset($stores) || isset($products))
                <h3 class="searchResultLabel">Search Results:
                    @if(isset($users)) {{ count($users) }} users, @endif
                    @if(isset($stores)) {{ count($stores) }} stores, @endif
                    @if(isset($products)) {{ count($products) }} orders @endif
                </h3>
                
                @if((isset($users) && count($users) > 0) || (isset($stores) && count($stores) > 0) || (isset($products) && count($products) > 0))
                    @if(isset($users) && count($users) > 0)
                        <h4>Users</h4>
                        <ul>
                            @foreach ($users as $user)
                                <li class="li_result">{{ $user->name }}
                                    <a href="{{route('user.info', ['user_id' => $user->id])}}" class="userInfo" >
                                        <ion-icon name="information-circle-outline" size="small" class="userInfoIcon infoIcon"></ion-icon>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif

                    @if(isset($stores) && count($stores) > 0)
                        <h4>Stores</h4>
                        <ul>
                            @foreach ($stores as $store)
                                <li class="li_result">{{ $store->store_name }}
                                    <a href="{{route('store.info', ['store_id' => $store->id])}}" class="storeInfo" >
                                        <ion-icon name="information-circle-outline" size="small" class="storeInfoIcon infoIcon"></ion-icon>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if(isset($products) && count($products) > 0)
                        <h4>Orders</h4>
                        <ul>
                            @foreach ($products as $product)
                                <li class="li_result">{{ $product->description }}</li>
                            @endforeach
                        </ul>
                    @endif
                @else
                    <p>Not Found</p>
                @endif
            @endif
        </div>
       
       
        <!-- =========== Scripts =========  -->
    <script src="{{asset('js/admin.js')}}"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>