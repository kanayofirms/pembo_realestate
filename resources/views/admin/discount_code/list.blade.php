@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Discount Code</a></li>
                <li class="breadcrumb-item active" aria-current="page">Discount Code List</li>
            </ol>
        </nav>

        {{-- Search Start --}}
        {{-- <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search Discount Code</h6>
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label for="">ID</label>
                                        <input type="text" name="id" class="form-control"
                                            value="{{ Request()->id }}" placeholder="Enter ID">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="">Country Name</label>
                                        <input type="text" name="country_name" class="form-control"
                                            value="{{ Request()->country_name }}" placeholder="Enter Country Name">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="">State Name</label>
                                        <input type="text" name="state_name" class="form-control"
                                            value="{{ Request()->state_name }}" placeholder="Enter State Name">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="">City Name</label>
                                        <input type="text" name="city_name" class="form-control"
                                            value="{{ Request()->city_name }}" placeholder="Enter City Name">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('admin/city') }}" class="btn btn-danger">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br> --}}
        {{-- Search End --}}

        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Discount Code List</h4>
                            <div class="d-flex align-items-center">

                                <a href="{{ url('admin/discount_code/add') }}" class="btn btn-primary">
                                    Add Discount Code
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Country Name</th>
                                        <th>State Name</th>
                                        <th>City Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($getRecord as $value)
                                        <tr class="table-info text-dark">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->country_name }}</td>
                                            <td>{{ $value->state_name }}</td>
                                            <td>{{ $value->city_name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>

                                            <td>

                                                <a class="dropdown-item"
                                                    href="{{ url('admin/city/edit/' . $value->id) }}"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2 icon-sm me-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg> <span class="">Edit</span></a>

                                                <a class="dropdown-item"
                                                    href="{{ url('admin/city/delete/' . $value->id) }}"
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
                                    @empty
                                        <tr>
                                            <td colspan="100%">No Record Found.</td>
                                        </tr>
                                    @endforelse --}}
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