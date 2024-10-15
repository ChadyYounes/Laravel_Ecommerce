<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores</title>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>

    <!-- Template Stylesheet -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <!-- Include jQuery before Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

    <!-- Custom CSS -->
    <style>
        #store-filter-form {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .single-product-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            transition: transform 0.2s ease;
        }

        .single-product-item:hover {
            transform: scale(1.05);
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .cart-btn {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 50px;
            display: inline-block;
            margin-top: 10px;
        }
        .cart-btn:hover {
            background-color: #0056b3;
        }
        
        .no-results {
            display: none;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: #ff0000;
        }
        .chat-btn {
            border: 2px solid orange; 
            border-radius: 5px;
            background-color: transparent;
            color: orange; 
            padding: 10px 20px; 
            margin-top: 10px; 
            cursor: pointer; 
            transition: background-color 0.3s, color 0.3s; 
        }
        .chat-btn:hover {
            background-color: orange; 
            color: white; 
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    @include('buyerLayout.buyerNav', ['currencies' => $currencies])
    <div class="row" style="margin-top: 55px;">
        <div class="col-lg-8 offset-lg-2 text-center">
            <div class="section-title">
                <h3><span class="orange-text">There are </span>{{$total_stores}} stores</h3>
                <p class="animated-text"> </p>
            </div>
        </div>
    </div>
    <!-- Filter Form -->
    <div class="container mt-3" style="margin-bottom: 30px;">
        <form id="store-filter-form" class="row" style="border: 2px solid orange; padding: 20px 20px;">
            <h4>Filter:</h4>
            <div class="col-md-6">
                <input type="text" name="store_name" class="form-control" placeholder="Search by store name" id="store-search">
            </div>
            <div class="col-md-4">
                <select name="store_category" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
           
        </form>
    </div>

    <div id="store-list-container">
        @include('buyerLayout.storeList', ['stores' => $stores])
    </div>

    <div id="no-results" class="no-results" >
        No results found.
    </div>
    <script>
    $(document).ready(function() {
    $('#store-search, #store-filter-form select').on('keyup change', function() {
        let searchTerm = $('#store-search').val();

        $.ajax({
            url: '{{ route('filterStores') }}',
            method: 'GET',
            data: $('#store-filter-form').serialize(),
            success: function(response) {
                if (response.html.trim() === "") {
                    $('#store-list-container').html(''); 
                    $('#no-results').show(); 
                } else {
                    $('#store-list-container').html(response.html); 
                    $('#no-results').hide(); 
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error); 
            }
        });
    });
});

    </script>
    @include('footer.footer')
</body>
</html>
