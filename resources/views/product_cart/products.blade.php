@extends('product_cart.layout')

@section('content')
    <div class="row mt-4">
        @foreach ($products as $product)
            <div class="col-md-3">
                <div class="card text-center">
                    <img src="{{ asset('product/' . $product->image) }}" alt="Product Image" class="card-img-top">
                    <div class="caption card-body">
                        <h4>{{ $product->name }}</h4>
                        <p>{{ $product->description }}</p>
                        <p><strong>Price :</strong> ₦{{ $product->price }}</p>
                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center"
                            role="button">Add
                            To Cart</a>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
@endsection


@section('script')
    <script type="text/javascript"></script>
@endsection
