@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add User</h6>

                        <form class="forms-sample" method="POST" action="{{ url('admin/users/add') }}">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Name <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Username <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" autocomplete="off"
                                        placeholder="Email" value="{{ old('email') }}" required>
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="phone" placeholder="Phone number">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Role<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="role" required>
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="agent">Agent</option>
                                        <option value="user">User</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ url('admin/users') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
