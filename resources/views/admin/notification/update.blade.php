@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/notification') }}">Notification</a></li>
                <li class="breadcrumb-item active" aria-current="page">Push Notification</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Push Notification</h6>

                        <form class="forms-sample" method="POST" action="{{ url('admin/notification_send') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Title <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title" autocomplete="off"
                                        placeholder="Title" value="" required>
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Message <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="message" class="form-control" placeholder="Message" cols="30" rows="10" required></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Send Notification</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
