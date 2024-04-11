
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
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

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">{{$all_users->count()}}</div>
                        <div class="cardName">Total Users</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>


            </div>

          

                <!-- ================= All Users ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>All users</h2>
                    </div>

                    <table>
                        @foreach ($all_users as $user)
                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    @if ($user->getProfile && $user->getProfile->image_url)
                                        <img id="avatar" src="{{ asset('storage/profile-images/' . $user->getProfile->image_url) }}" alt="Avatar" class="d-block ui-w-80">
                                    @else
                                       <img id="avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Default Avatar" class="d-block ui-w-80">
                                    @endif
                            </div>
                            </td>
                            <td>
                                <h4>{{ $user->name}} <br> <span>{{$user->getRole->name}}</span></h4>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.updateStatus', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <td>
                                        <button type="submit" name="status" value="activated" class="status-button activate-button" {{ $user->is_active ? 'disabled' : '' }}>Activate</button>
                                        <button type="submit" name="status" value="deactivated" class="status-button deactivate-button" {{ $user->is_active ? '' : 'disabled' }}>Deactivate</button>
                                    </td>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                        
                       
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/turnOnOffBtn.js')}}"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
