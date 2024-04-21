
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
             .card-goback {
                margin-left: 200px;
                padding: 20px;
                width: 200px;
                color: white;
                border-radius: 20px;
                background-color: lightgreen;
             }
             .card-goback:hover {
                background-color: white;
                color: lightgreen;
             }
             .go_back {
                text-decoration: none;
             }
        </style>
</head>

<body> 
    
        <!-- ========================= Main ==================== -->
        <div class="main">
            

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <a href="#" style="text-decoration: none;">
                    <div class="card">
                        <div>
                            <div class="numbers">{{ $active_stores_nbr }}</div>
                            <div class="cardName">Activated Stores</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="storefront-outline"></ion-icon>
                        </div>
                    </div>
                </a>
                
                    <a href="{{route('admin.stores')}}" class="go_back">
                        <div class="card-goback">
                        <span class="icon">
                            <ion-icon name="storefront-outline"></ion-icon>
                        </span>
                        <span class="title">Go Back to stores</span>
                    </div>
                    </a>
                
            </div>

            <!-- ================ Stores Details List ================= -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>All Activated Stores</h2>
                </div>

                <table>
                    @foreach ($activated_stores as $store)
                    
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
