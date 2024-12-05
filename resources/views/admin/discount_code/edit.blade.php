@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/discount_code') }}">Discount Code</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Discount Code</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Discount Code</h6>

                        <form class="forms-sample" method="POST"
                            action="{{ url('admin/discount_code/edit/' . $getRecord->id) }}">
                            {{ csrf_field() }}

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Usage<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select name="user_id" class="form-control" required>
                                        @foreach ($getUser as $value)
                                            <option {{ ($getRecord->user_id == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Discount Code<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="discount_code" class="form-control"
                                        value="{{ $getRecord->discount_code }}" placeholder="Enter Discount Code" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Discount Price<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="discount_price" class="form-control"
                                        value="{{ $getRecord->discount_price }}" placeholder="Enter Discount Price"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Expiry Date<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="date" name="expiry_date" class="form-control"
                                        value="{{ $getRecord->expiry_date }}" placeholder="Enter Expiry Date" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Type<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select name="type" class="form-control">
                                        <option {{ ($getRecord->type == '0') ? 'selected' : '' }} value="0">Percentage %</option>
                                        <option {{ ($getRecord->type == '1') ? 'selected' : '' }} value="1">Amount</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Usage<span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select name="usages" class="form-control">
                                        <option {{ ($getRecord->usages == '1') ? 'selected' : '' }} value="1">Unlimited</option>
                                        <option {{ ($getRecord->usages == '2') ? 'selected' : '' }} value="2">One Time</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ url('admin/discount_code') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
