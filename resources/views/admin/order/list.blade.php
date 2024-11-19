@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order List</li>
            </ol>
        </nav>
        {{-- Search Start --}}
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search Order</h6>
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ID</label>
                                        <input type="text" name="id" class="form-control"
                                            value="{{ Request()->id }}" placeholder="Enter ID">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ Request()->title }}" placeholder="Enter Product Title">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Created At</label>
                                        <input type="date" name="created_at" class="form-control"
                                            value="{{ Request()->created_at }}" placeholder="Enter Created At">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Updated At</label>
                                        <input type="date" name="updated_at" class="form-control"
                                            value="{{ Request()->updated_at }}" placeholder="Enter Updated At">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('admin/order') }}" class="btn btn-danger">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Search End --}}

        <br>
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Order List</h4>
                            <div class="d-flex align-items-center">
                                <a href="{{ url('admin/order/add') }}" class="btn btn-primary">
                                    Add Order
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Qtys</th>
                                        <th>Colour</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getOrder as $value)
                                        <tr class="table-info text-dark">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->title }}</td> {{-- Change product_id for title --}}
                                            <td>{{ $value->qtys }}</td>
                                            <td>
                                                @foreach ($value->getColour as $valueC)
                                                    {{ $valueC->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>

                                            <td>


                                                <a class="dropdown-item"
                                                    href="{{ url('admin/order/edit/' . $value->id) }}"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2 icon-sm me-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg> <span class="">Edit</span></a>

                                                <a class="dropdown-item"
                                                    href="{{ url('admin/order/delete/' . $value->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete?')"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash icon-sm me-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg> <span class="">Delete</span></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="padding: 20px; float: right;">
                            {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
