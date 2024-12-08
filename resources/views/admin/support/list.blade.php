@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Support</a></li>
                <li class="breadcrumb-item active" aria-current="page">Support List</li>
            </ol>
        </nav>

        {{-- Search Start --}}
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search Support</h6>
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
                                        <label class="form-label">Username</label>
                                        <select name="user_id" class="form-control">
                                            <option value="">Select Username</option>
                                            @foreach ($getUser as $value)
                                                <option {{ Request()->user_id == $value->id ? 'selected' : '' }}
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ Request()->title }}" placeholder="Enter Title">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option {{ Request()->status == '1' ? 'selected' : '' }} value="1">Closed
                                            </option>
                                            <option {{ Request()->status == '1000' ? 'selected' : '' }} value="1000">
                                                Open</option>
                                        </select>

                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('admin/support') }}" class="btn btn-danger">Reset</a>
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
                            <h4 class="card-title">Support List</h4>
                            <div class="d-flex align-items-center">

                                <a href="{{ url('admin/support/add') }}" class="btn btn-primary">
                                    Add Support
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>On/Off</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user as $value)
                                        <tr class="table-info text-dark">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ !empty($value->user->name) ? $value->user->name : '' }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>

                                                @if (Auth::user()->role == 'admin')
                                                    <select name="" id="{{ $value->id }}"
                                                        class="form-control ChangeSupportStatus" style="width: 80px;">
                                                        <option <?= $value->status == '0' ? 'selected' : '' ?>
                                                            value="0">Open</option>
                                                        <option <?= $value->status == '1' ? 'selected' : '' ?>
                                                            value="1">Closed</option>
                                                    </select>
                                                @else
                                                    {{ $value->status == '1' ? 'Closed' : 'Open' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($value->status == 0)
                                                    <a href="{{ url('admin/support/status_update/' . $value->id) }}"
                                                        class="btn btn-success">On</a>
                                                @else
                                                    <a href="{{ url('admin/support/status_update/' . $value->id) }}"
                                                        class="btn btn-danger">Off</a>
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y H:s A', strtotime($value->created_at)) }}</td>
                                            <td>{{ date('d-m-Y H:s A', strtotime($value->updated_at)) }}</td>

                                            <td>

                                                <a class="btn btn-primary"
                                                    href="{{ url('admin/support/reply/' . $value->id) }}">Reply</span></a>

                                                <a class="btn btn-danger"
                                                    href="{{ url('admin/support/delete/' . $value->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete?')"><span
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
                            {!! $user->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
