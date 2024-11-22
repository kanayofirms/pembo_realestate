@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog List</li>
            </ol>
        </nav>


        {{-- Search Box Start --}}
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search Blog</h6>
                        <form action="" action="">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ID</label>
                                        <input type="text" name="id" class="form-control"
                                            value="{{ Request()->id }}" placeholder="Enter ID">
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ Request()->title }}" placeholder="Enter Title">
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ Request()->slug }}" placeholder="Enter Slug">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('admin/blog') }}" class="btn btn-danger">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Search Box End --}}
        <br>

        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Blog List</h4>
                            <div class="d-flex align-items-center">
                                <a href="{{ url('admin/blog/add') }}" class="btn btn-primary">
                                    Add Blog
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->slug }}</td>
                                            <td>{!! $value->description !!}</td>
                                            <td>{{ date('d-m-Y H:s:i', strtotime($value->created_at)) }}</td>
                                            <td>{{ date('d-m-Y H:s A', strtotime($value->updated_at)) }}</td>

                                            <td>
                                                <a class="btn btn-primary"
                                                    href="{{ url('admin/blog/edit/' . $value->id) }}"><span
                                                        class="">Edit</span></a>

                                                <a class="btn btn-secondary"
                                                    href="{{ url('admin/blog/view/' . $value->id) }}"><span
                                                        class="">View</span></a>

                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger"
                                                    href="{{ url('admin/blog/delete/' . $value->id) }}"><span
                                                        class="">Delete</span></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">No Record Found.</td>
                                        </tr>
                                    @endforelse
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
