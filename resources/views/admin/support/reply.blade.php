@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/support') }}">Reply</a></li>
                <li class="breadcrumb-item active" aria-current="page">Support Reply</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Support Reply</h6>
                        <div class="content-frame-body content-frame-body-left" style="width: 100%;">
                            <div class="messages messages-img">
                                <!-- Display Ticket Details -->
                                <div class="item in">
                                    <div class="text">
                                        <div class="heading">
                                            <a href="#">{{ $edit->user->name ?? '' }}</a>
                                            <span class="date">{{ date('d-m-Y', strtotime($edit->created_at)) }}</span>
                                        </div>
                                        <b>Title:</b> {{ $edit->title }}<br />
                                        <b>Description:</b> {{ $edit->description }}
                                    </div>
                                </div>

                                <!-- Display Replies -->
                                @foreach ($edit->getSupportReply as $value)
                                    <div class="item {{ Auth::user()->id == $value->user_id ? '' : 'in' }}">
                                        <div class="text">
                                            <div class="heading">
                                                <a href="#">{{ $value->user->name ?? '' }}</a>
                                                <span
                                                    class="date">{{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                                            </div>
                                            {{ $value->description }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Reply Form -->
                            @if (empty($edit->status))
                                <div class="panel panel-default push-up-10">
                                    <div class="panel-body panel-body-search">
                                        <form action="" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" disabled>Reply Message</button>
                                                </div>
                                                <input type="text" name="description" class="form-control"
                                                    placeholder="Your message..." required>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary" type="submit">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                        @if ($errors->any())
                                            <div class="alert alert-danger mt-3">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
