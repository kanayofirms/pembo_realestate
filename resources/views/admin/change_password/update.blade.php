@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/change_password') }}">Change Password</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Change Password</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Update Change Password</h6>

                        <form class="forms-sample" method="POST" action="{{ url('admin/change_password/update') }}">
                            {{ csrf_field() }}

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Old Password<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="old_password" class="form-control"
                                        placeholder="Old Password" required>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">New Password<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="new_password" class="form-control"
                                        placeholder="New Password" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Confirm Password<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="confirm_password" class="form-control"
                                        placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ url('admin/change_password') }}" class="btn btn-secondary">Reset</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
