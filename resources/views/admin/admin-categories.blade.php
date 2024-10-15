
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
                background-color: red;
                
            }
            .addCategoryCard {
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                width: 500px;
                display: flex;
                align-items: center;
            }

            .formContainer {
                flex: 1;
            }

            .addCategoryForm {
                display: flex;
                align-items: center;
            }

            .categoryInput {
                width: 70%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-right: 10px;
            }

            .addCategoryButton {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .addCategoryButton:hover {
                background-color: #0056b3;
            }

            .iconBx {
                font-size: 32px;
                color: #007bff;
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
                        <div class="numbers">{{$total_categories}}</div>
                        <div class="cardName">Total Categories</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="list-outline"></ion-icon>
                    </div>
                </div>
                <div class="cardBox">
                    <div class="card addCategoryCard">
                        <div class="formContainer">
                            <form method="POST" action="{{route("category.addCategory")}}" class="addCategoryForm">
                                @csrf
                                <input type="text" name="category_name" placeholder="Enter new category name" required class="categoryInput">
                                <button type="submit" class="addCategoryButton">Add Category</button>
                            </form>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Display error message -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- ================= All Users ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>All Categories</h2>
                    </div>

                    <table>
                        @foreach ($all_categories as $category)
                                   
                        <tbody>
                        <tr>
                            <td >
                                {{$category->category_name}}
                            </div>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('category.deleteCategory', $category->id) }}">
                                    @csrf
                                    <td>
                                        <button type="submit" name="status" class="status-button" >Delete</button>
                                    </td>
                                </form>
                            </td>
                        </tr>
                    </tbody>
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
