
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
            .userInfo {
                color: gold;
                
            }
             
        </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    @include('admin.adminNav')
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
                                        <img id="avatar" src="{{ asset('storage/' . $user->getProfile->image_url) }}" alt="Avatar" class="d-block ui-w-80">
                                    @else
                                       <img id="avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Default Avatar" class="d-block ui-w-80">
                                    @endif
                            </div>
                            </td>
                            <td>
                                <h4>{{ $user->name }} <br> <span>{{ $user->getRole ? $user->getRole->name : 'No Role' }}</span></h4>

                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.updateStatus', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <td>
                                        <button type="submit" name="status" value="activated" class="status-button activate-button" {{ $user->is_active ? 'disabled' : '' }}>Activate</button>
                                        <button type="submit" name="status" value="deactivated" class="status-button deactivate-button" {{ $user->is_active ? '' : 'disabled' }}>Deactivate</button>
                                    </td>
                                    <td><a href="{{route('user.info', ['user_id' => $user->id])}}" class="userInfo" >
                                        <ion-icon name="information-circle-outline" size="large" class="userInfoIcon"></ion-icon></a></td>
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
    

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
