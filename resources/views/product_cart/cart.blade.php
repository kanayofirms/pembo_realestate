@extends('product_cart.layout')

@section('content')
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width: 50%">Product</th>
                <th style="width: 10%">Price</th>
                <th style="width: 8%">Quantity</th>
                <th style="width: 22%">Subtotal</th>
                <th style="width: 10%"></th>
            </tr>
        </thead>
        <tbody>
            <tr data-id="">
                <th data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
                            <img src="{{ asset('product/fgk442bW8F8Yc3rvRSQJhgzTcBxkP4.jpg') }}" alt="Product Image"
                                width="100" height="150" class="img-responsive">
                        </div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">Name</h4>
                        </div>
                    </div>
                </th>
                <td data-th="Price">N200</td>
                <td data-th="Quantity">
                    <input type="number" value="1" class="form-control quantity-update-cart">
                </td>
                <td data-th="Subtotal" class="text-center">N20 * 5</td>
                <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    <h3><strong>Total N500</strong></h3>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">
                    <a href="{{ url('product_cart') }}" class="btn btn-warning"><i class="fa fa-angle-left"> </i> Continue
                        Shopping</a>
                    <button class="btn btn-success">Checkout</button>
                </td>
            </tr>
        </tfoot>
    </table>
@endsection


@section('script')
    <script type="text/javascript"></script>
@endsection
