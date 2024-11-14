@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/notification') }}">SMTP Setting</a></li>
                <li class="breadcrumb-item active" aria-current="page">SMTP Setting</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">SMTP Setting Update</h6>

                        <form class="forms-sample" method="POST" action="{{ url('admin/smtp_update') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">App Name <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="app_name" autocomplete="off"
                                        placeholder="Enter App Name" value="{{ $getRecord->app_name }}" required>
                                    <span style="color: red;">{{ $errors->first('app_name') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mail Mailer <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mail_mailer" autocomplete="off"
                                        placeholder="Enter Mail Mailer" value="{{ $getRecord->mail_mailer }}" required>
                                    <span style="color: red;">{{ $errors->first('mail_mailer') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mail Host<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mail_host" autocomplete="off"
                                        placeholder="Enter Host Namer" value="{{ $getRecord->mail_host }}" required>
                                    <span style="color: red;">{{ $errors->first('mail_host') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mail Port<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mail_port" autocomplete="off"
                                        placeholder="Enter Mail Port" value="{{ $getRecord->mail_port }}" required>
                                    <span style="color: red;">{{ $errors->first('mail_port') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mail Username<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mail_username" autocomplete="off"
                                        placeholder="Enter Mail Username" value="{{ $getRecord->mail_username }}" required>
                                    <span style="color: red;">{{ $errors->first('mail_username') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mail Password<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mail_password" autocomplete="off"
                                        placeholder="Enter Mail Password" value="{{ $getRecord->mail_password }}" required>
                                    <span style="color: red;">{{ $errors->first('mail_password') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mail Encryption<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mail_encryption" autocomplete="off"
                                        placeholder="Enter Mail Encryption" value="{{ $getRecord->mail_encryption }}"
                                        required>
                                    <span style="color: red;">{{ $errors->first('mail_encryption') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mail From Address<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mail_from_address" autocomplete="off"
                                        placeholder="Enter Mail From Address" value="{{ $getRecord->mail_from_address }}"
                                        required>
                                    <span style="color: red;">{{ $errors->first('mail_from_address') }}</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update SMTP</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
