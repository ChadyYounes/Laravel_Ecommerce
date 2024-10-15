<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fruitables</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{asset("css/productCard.css")}}" rel="stylesheet">
    <link href="{{asset('css/datatables.css')}}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>
   
    <!-- Template Stylesheet -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Data table CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    
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
      .custom-hero-size {
        width: 100%; /* Adjust as needed for width */
        height: 30%; /* Adjust height as needed */
        margin: 0 auto; /* Center it horizontally */
    }
  </style>
</head>
<body>

    @include('storeManagement.sellerNav')
    <!-- hero area -->
    <div class="hero-area hero-bg custom-hero-size">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-2 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <h1>Manage {{$store->store_name}}</h1>
                            <div class="hero-btns">
                                <a href="{{route('addProductView',['store_id'=>$store->id])}}" class="boxed-btn">Add Product</a>
                                <a href="{{route('SellerReports',['user_id'=>$user->id])}}" class="bordered-btn">Reports</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero area -->
    <div class="container mt-5">
        <h4>You have <u style="color:orange;">{{$total_products}}</u> products in you store.</h4>

        <table id="productsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col" style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#productsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('productsData', ['store_id' => $store->id]) }}',
                columns: [
                    { data: 'product_url', name: 'product_url', render: function(data) {
                        return '<img style="border-radius: 10px;" height="64px" width="74px" src="' + data + '" alt="Product Image">';
                    }},
                    { data: 'product_name', name: 'product_name'},
                    { data: 'category_name', name: 'category_name'},
                    { data: 'quantity', name: 'quantity'},
                    { data: 'price', name: 'price'},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: '<img width="24" height="24" src="https://img.icons8.com/ios/50/print--v1.png" alt="print--v1"/> Print',
                        className: 'btn print',
                        exportOptions: {
                            columns: function (idx, data, node) {
                                return idx !== 0 && idx !== 5; 
                            }
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<img width="24" height="24" src="https://img.icons8.com/color/48/csv.png" alt="csv"/> CSV',
                        className: 'btn csv',
                        exportOptions: {
                            columns: function (idx, data, node) {
                                return idx !== 0 && idx !== 5; 
                            }
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<img width="24" height="24" src="https://img.icons8.com/metro/26/pdf.png" alt="pdf"/> PDF',
                        className: 'btn pdf',
                        exportOptions: {
                            columns: function (idx, data, node) {
                                return idx !== 0 && idx !== 5; 
                            }
                        }
                    }
                ],
                scrollY: '800px', // Set scroll height
                scrollCollapse: true, // Allow table to shrink when there are fewer than 20 rows
                paging: true, 
                pageLength: 6, 
                lengthMenu: [ [6, 10, 25, 50, -1], [6, 10, 25, 50, "All"] ], 
                responsive: true,
            });
        });
    </script>
    @include('footer.footer')
</body>
</html>
