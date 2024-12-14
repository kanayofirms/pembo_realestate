@extends('product_cart.layout')

@section('content')
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width: 50%">Product</th>
                <th style="width: 10%">Price</th>
                <th style="width: 6%">Quantity</th>
                <th style="width: 4%">Subtotal</th>
                <th style="width: 8%">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                    @php
                        $total += $details['price'] * $details['quantity'];
                    @endphp
                    <tr data-id="{{ $id }}"> {{-- dynamic id --}}
                        <th data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs">
                                    <img src="{{ asset('product/' . $details['image']) }}" alt="Product Image"
                                        width="100" height="100" class="img-responsive">
                                </div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </th>
                        <td data-th="Price">₦{{ $details['price'] }}</td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $details['quantity'] }}"
                                class="form-control quantity update-cart">
                        </td>
                        <td data-th="Subtotal" class="text-center">₦{{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    <h3><strong>Total ₦{{ $total }}</strong></h3>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(".update-cart").change(function(e) {
                e.preventDefault(); // Prevent default behavior

                var ele = $(this); // Reference to the current element

                $.ajax({
                    url: '{{ route('update.cart') }}', // Route for updating the cart
                    method: "patch", // Use PATCH method
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                        id: ele.parents("tr").attr("data-id"), // Product ID
                        quantity: ele.parents("tr").find(".quantity").val() // Updated quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update subtotal and total dynamically
                            ele.parents("tr").find(".subtotal").text(response.subtotal);
                            $(".cart-total").text(response.total);
                            toastr.success(response
                                .success); // Optional: Display success message
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 404) {
                            toastr.error(
                                "Product not found in the cart."
                            ); // Optional: Display error message
                        } else {
                            toastr.error("An error occurred. Please try again.");
                        }
                    }
                });
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            // Confirm before removing item from cart
            if (confirm("Are You Sure You Want To Delete?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE", // Use DELETE method
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                        id: ele.parents("tr").attr("data-id"), // Product ID from the data-id attribute
                    },
                    success: function(response) {
                        // Handle the response, e.g., removing the row or updating the cart total
                        if (response.success) {
                            // Remove the row from the cart table
                            ele.parents("tr").remove();

                            // Optionally, update the cart total (if you return total from the controller)
                            $(".cart-total").text(response.cart_total);

                            // Show a success message
                            window.location.reload();
                            // Optional: You can replace this with a toastr or custom message
                        } else {
                            alert(response.error); // Optional: Error handling
                        }
                    },
                    error: function(xhr) {
                        alert("An error occurred while removing the item. Please try again.");
                    }
                });
            }
        });
    </script>
@endsection
