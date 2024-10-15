<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Home - Seller</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!--  Stylesheet -->
        <script src="https://kit.fontawesome.com/9055df38da.js" crossorigin="anonymous"></script>
        <link href="{{asset("css/style.css")}}" rel="stylesheet">
        <link href="{{asset('css/datatables.css')}}" rel="stylesheet">

        <!-- Data table CDN -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!--CSS for seller dash-->
    <link rel="stylesheet" href="{{asset('css/sellerDash/vertical-layout-light/style.css')}}">
        <!-- Datepicker CSS and JS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <style>
.animated-text {
      overflow: hidden; /* Ensures the text only appears as it animates */
      border-right: .15em solid orange; /* Cursor effect */
      white-space: nowrap; /* Keeps the text on a single line */
      margin: 0 auto; /* Center the text container */
      letter-spacing: .15em; /* Adds spacing between letters */
      animation: typing 3.5s steps(30, end), blink-caret .75s step-end infinite;
    }

    @keyframes typing {
      from { width: 0 }
      to { width: 100% }
    }

    @keyframes blink-caret {
      from, to { border-color: transparent }
      50% { border-color: orange }
    }
    #viewDetailsCard, #viewOrdersDetailsCard {
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  #viewDetailsCard:hover, #viewOrdersDetailsCard:hover {
    background-color: #45a049; /* Darker green for hover effect */
  }
  .card {
  display: block; /* Ensure the card behaves as a block-level element */
  text-decoration: none; /* Remove any default underline */
}

.card-body {
  cursor: pointer; /* Change cursor to pointer to indicate it's clickable */
}


        </style>
    </head>
    <body>
      <!-- navbar -->
      @include('storeManagement.sellerNav')

      <!--end navbar-->
    
  <div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Welcome</span> {{$user->name}}</h3>
						<p class="animated-text">Let's see what's new..</p>
					</div>
				</div>
			</div>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Title -->
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Dashboard</h3>
                    <h6 class="font-weight-normal mb-0">Those data are collected from your stores and products <span class="text-primary"><a href="{{route('SellerReports',['user_id'=>$user->id])}}">Advanced Data</a></span></h6>
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                      <div class="col-12 col-xl-6">
                          <div class="justify-content-end d-flex">
                            <form id="dateForm" method="GET" action="{{ route('home') }}">
                              <input type="date" name="date" id="datePicker" class="form-control" 
                                     style="border:1px solid; border-color:#4CAF50;" 
                                     value="{{ $selectedDate ?? \Carbon\Carbon::now()->format('Y-m-d') }}">
                          </form>
                          </div>
                      </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- General Data (5 cards) -->
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img src="{{asset('img/sellerDashImg/dashboard/stores2.png')}}" alt="people">
                    <div class="weather-info">
                      <div class="d-flex">
                        <div>
                          <h2 class="mb-0 font-weight-normal">{{$stores->count()}} stores</h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  <div class="col-md-12 mb-4 stretch-card transparent">
                    <a href="#" id="viewOrdersDetailsCard" class="card bg-warning text-decoration-none text-white">
                      <div class="card-body">
                        <p class="mb-4">Total Orders</p>
                        <p class="fs-30 mb-2">{{$total_orders}}</p>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- Order Details Modal -->
                <!-- Order Details Modal -->
                <div class="modal fade" id="ordersDetailsModal" tabindex="-1" aria-labelledby="ordersDetailsModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ordersDetailsModalLabel">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <ul id="ordersDetailsList" class="list-group">
                          <!-- Order Details will be populated here -->
                        </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-4 stretch-card transparent">
                    <a href="#" id="viewDetailsCard" class="card bg-success text-decoration-none text-white">
                      <div class="card-body">
                        <p class="mb-4">Total amount gained</p>
                        <p class="fs-30 mb-2">${{ number_format($totalAmountGainedToday, 2) }}</p>
                      </div>
                    </a>
                  </div>
                </div>
                
                
              <!-- Total Amount Gained Modal -->
              <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="detailsModalLabel">Details of Total Amount Gained</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <ul id="salesDetailsList" class="list-group">
                        <!-- Details will be populated here -->
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-12 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Sold product (total)</p>
                       <p class="fs-30 mb-2">{{ $totalProductsSoldToday }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         
          <!-- Advanced Table -->
            <div class="row col-md-12">
              <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <p class="card-title">Advanced Table</p>
                          <div class="row">
                              <div class="col-12">
                                  <div class="table-responsive">
                                    <table id="storesTable" class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th scope="col">Store Name</th>
                                              <th scope="col">Nbr Products</th>
                                              <th scope="col">Nbr Followers</th>
                                              <th scope="col">Nbr Sales</th>
                                              <th scope="col">Total Gain</th>
                                              <th scope="col">Status</th>
                                          </tr>
                                      </thead>
                                      <tbody></tbody>
                                  </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div> 
  </div>
  <!-- End custom js for this page-->
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("lib/waypoints/waypoints.min.js")}}"></script>
    <script src="{{asset("lib/lightbox/js/lightbox.min.js")}}"></script>
    <script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>
    <!-- Datatable cdn-->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript"
        charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript"
        charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js">
    </script>
    <script type="text/javascript"
        charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript"
         charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
    </script>
    <script type="text/javascript"
         charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript"
        charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript"
        charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js">
    </script>
  
<script type="text/javascript">
 $(document).ready(function () {
    $("#storesTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("seller.stores.data") }}',
        columns: [
            { data: "store_name", name: "store_name" },
            { data: "nbrProducts", name: "nbrProducts" },
            { data: "nbrFollowers", name: "nbrFollowers" },
            { data: "nbrSales", name: "nbrSales" },
            { data: "totalGain", name: "totalGain" },
            { data: "is_active", name: "is_active" },
        ],
        dom: "lBfrtip",
        buttons: [
            {
                extend: "print",
                text: '<img width="24" height="24" src="https://img.icons8.com/ios/50/print--v1.png" alt="print--v1"/> Print',
                className: "btn print",
            },
            {
                extend: "csv",
                text: '<img width="24" height="24" src="https://img.icons8.com/color/48/csv.png" alt="csv"/> CSV',
                className: "btn csv",
            },
            {
                extend: "pdf",
                text: '<img width="24" height="24" src="https://img.icons8.com/metro/26/pdf.png" alt="pdf"/> PDF',
                className: "btn pdf",
            },
        ],
        pageLength: 6,
        lengthMenu: [
            [6, 10, 25, 50, -1],
            [6, 10, 25, 50, "All"],
        ],
        responsive: true,
    });
});
//Date picker for general data cards
$("#datePicker").datepicker({
    dateFormat: "yy-mm-dd",
    showAnim: "slideDown",
    changeMonth: true,
    changeYear: true,
    maxDate: 0,
    onSelect: function () {
        console.log("Date selected:", $(this).val()); // Check if this logs the selected date
        $("#dateForm").submit();
    },
});

$(document).ready(function () {
    $("#viewDetailsCard").on("click", function (event) {
        event.preventDefault(); // Prevent the default anchor behavior

        // Fetch the data for the total amount gained
        $.ajax({
            url: '{{ route("seller.gained.details") }}',
            method: "GET",
            data: { date: $("#datePicker").val() }, // Pass the selected date
            success: function (data) {
                // Populate the modal with data
                var detailsHtml = "";
                $.each(data.sales, function (index, sale) {
                    detailsHtml += '<li class="list-group-item">';
                    detailsHtml +=
                        "<strong>Product:</strong> " +
                        sale.product_name +
                        " <br>";
                    detailsHtml +=
                        "<strong>Store:</strong> " + sale.store_name + " <br>";
                    detailsHtml +=
                        "<strong>Price:</strong> $" + sale.price.toFixed(2);
                    detailsHtml += "</li>";
                });
                $("#salesDetailsList").html(detailsHtml);

                // Show the modal
                $("#detailsModal").modal("show");
            },
        });
    });
});

$(document).ready(function () {
    $("#viewOrdersDetailsCard").on("click", function (event) {
        event.preventDefault(); // Prevent the default anchor behavior

        console.log("Fetching orders details"); // Debug log

        $.ajax({
            url: '{{ route("seller.orders.details") }}',
            method: "GET",
            data: { date: $("#datePicker").val() },
            success: function (data) {
                console.log("Order details data:", data);

                if (data && data.sales) {  // Changed 'orders' to 'sales' based on your data structure
                    var detailsHtml = "";
                    $.each(data.sales, function (index, order) {
                        detailsHtml += '<li class="list-group-item">';
                        detailsHtml += "<strong>Buyer:</strong> " + (order.buyer_name || "N/A") + " <br>";
                        detailsHtml += "<strong>Address:</strong> " + (order.address || "N/A") + " <br>";
                        detailsHtml += "<strong>Product:</strong> " + (order.product.length ? order.product.join(', ') : "N/A") + " <br>";
                        detailsHtml += "<strong>Store:</strong> " + (order.store_name || "N/A") + " <br>";
                        detailsHtml += "<strong>Status:</strong> " + (order.delivery_status || "N/A");
                        detailsHtml += "</li>";
                    });
                    $("#ordersDetailsList").html(detailsHtml);

                    console.log("Showing Orders Details Modal"); // Debug log
                    $("#ordersDetailsModal").modal("show");
                } else {
                    $("#ordersDetailsList").html('<li class="list-group-item">No orders data available</li>');
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            },
        });
    });
});



</script>
 
    </body>

    <script>
        var botmanWidget = {
            aboutText: 'Start the conversation with Hi',
            introMessage: "Welcome back {{$user->name}}",
            bubbleAvatarUrl: "https://avatars.githubusercontent.com/u/39736494?v=4",
        };
    </script>
   
   <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    @include('footer.footer')
</html>
