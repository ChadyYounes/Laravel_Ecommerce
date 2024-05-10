<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping cart</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div class="container">
        <div class='row'>
            <h1>Shopping cart</h1>
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        Check your products and proceed to payment
                    </div>
                    <div class="card-body">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:50%">Product</th>
                                    <th style="width:10%">Price</th>
                                    <th style="width:8%">Quantity</th>
                                    <th style="width:22%" class="text-center">Subtotal</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($shoppingCart)
                                @foreach ($shoppingCart->getShoppingCartItem as $item)
                                    <tr>
                                        <td data-th="Product">
                                            <div class="row">
                                                <div class="col-sm-3 hidden-xs"><img src="{{ asset($item->getProduct->product_url) }}" width="100" height="100" class="img-responsive"/></div>
                                                <div class="col-sm-9">
                                                    <h4 class="nomargin">{{ $item->getProduct->product_name }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">${{ $item->getProduct->price }}</td>
                                        <td data-th="Quantity">
                                            <input type="number" class="form-control quantity cart_update" value="{{ $item->quantity }}" name="quantity" min="1" max="{{ $item->getProduct->quantity }}" data-product-id="{{ $item->id }}" data-product-price="{{ $item->getProduct->price }}" />
                                        </td>
                                        <td data-th="Subtotal" class="text-center subtotal">${{ $item->getProduct->price * $item->quantity }}</td>
                                        <td class="actions" data-th="">
                                            <form action="{{ route('deleteCartItem') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="itemId" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                @if ($shoppingCart)
                                <tr>
                                    <td colspan="5" style="text-align:right;">
                                        <h3><strong>Total: <span id="total-price">${{ $totalPrice }}</span></strong></h3>
                                    </td>
                                </tr>
                            @endif
                                <tr>
                                    <td colspan="5" style="text-align:right;">
                                        <form action="{{ route('deliveryAddress') }}" method="get">
                                            <a href="{{ route('home') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type='hidden' name="total" value="{{ $totalPrice }}">
                                            <input type='hidden' name="productname" value="{{ $shoppingCart ? $shoppingCart->getShoppingCartItem->implode('getProduct.product_name', ', ') : '' }}">
                                            @if ($shoppingCart->getShoppingCartItem->isNotEmpty())
                                            <button class="btn btn-success" type="submit" id="checkout-live-button"><i class="fa fa-money"></i>Continue</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('.quantity').change(function() {
            var $input = $(this);
            var productId = $input.data('product-id');
            var price = $input.data('product-price');
            var quantity = parseInt($input.val());

            updateQuantity(productId, quantity);
        });
        function updateSubtotalAndTotal() {
        var total = 0;
        $('#cart tbody tr').each(function() {
            var price = parseFloat($(this).find('td[data-th="Price"]').text().replace('$', ''));
            var quantity = parseInt($(this).find('.quantity').val());
            var subtotal = price * quantity;
            $(this).find('td[data-th="Subtotal"]').text('$' + subtotal.toFixed(2));
            total += subtotal;
        });
        $('#total-price').text('$' + total.toFixed(2));
    }
        function updateQuantity(productId, quantity) {
            $.ajax({
                url: '{{ route("updateCartItem") }}',
                type: 'PATCH',
                data: {
                    productId: productId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    updateSubtotalAndTotal();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
</html>
