@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Product Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Cart List</li>
            </ol>
        </nav>

        {{-- Search Start --}}
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search Product Cart</h6>
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">ID</label>
                                        <input type="text" name="id" class="form-control"
                                            value="{{ Request()->id }}" placeholder="Enter ID">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ Request()->name }}" placeholder="Enter Product Name">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" name="price" class="form-control"
                                            value="{{ Request()->price }}" placeholder="Enter Price">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">Created At</label>
                                        <input type="date" name="created_at" class="form-control"
                                            value="{{ Request()->created_at }}">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">Updated At</label>
                                        <input type="date" name="updated_at" class="form-control"
                                            value="{{ Request()->updated_at }}">
                                    </div>
                                </div>

                            </div>
                            <div style="text-align: right;">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('admin/product_cart') }}" class="btn btn-danger">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        {{-- Search End --}}

        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Product Cart List</h4>
                            <div class="d-flex align-items-center">

                                <a href="{{ url('admin/product_cart/add') }}" class="btn btn-primary">
                                    Add Product Cart
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @forelse ($getRecord as $value)
                                        @php
                                            $totalPrice = $totalPrice + $value->price;
                                        @endphp
                                        <tr class="table-info text-dark">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>
                                                <img src="{{ asset('product/' . $value->image) }}" alt="product_image"
                                                    style="width: 6.5vw; height: 14.5vh;">
                                            </td>
                                            <td>{{ $value->price }}</td>
                                            <td>{{ date('d-m-Y H:s:i', strtotime($value->created_at)) }}</td>
                                            <td>{{ date('d-m-Y H:s:i', strtotime($value->updated_at)) }}</td>

                                            <td>

                                                <a class="btn btn-primary"
                                                    href="{{ url('admin/product_cart/edit/' . $value->id) }}">Edit</a>

                                                <a class="btn btn-danger"
                                                    href="{{ url('admin/product_cart/delete/' . $value->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">No Record Found.</td>
                                        </tr>
                                    @endforelse
                                    @if (!empty($totalPrice))
                                        {{-- if the db table is empty remove record --}}
                                        <tr>
                                            <th colspan="4">Total Price (Amount)</th>
                                            <td>{{ number_format($totalPrice, 2) }}</td>
                                            <th colspan="4"></th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div style="padding: 20px; float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
