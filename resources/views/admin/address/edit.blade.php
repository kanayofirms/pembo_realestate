@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/countries') }}">Address</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Address</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Address</h6>

                        <form class="forms-sample" method="POST"
                            action="{{ url('admin/address/edit/' . $getRecordAdd->id) }}">
                            {{ csrf_field() }}

                            {{-- Country Dropdown --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Country Name <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select id="country_add" name="countries_id" class="form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach ($getRecord as $value)
                                            <option {{ $getRecordAdd->countries_id == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->country_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- State Dropdown --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">State Name <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select name="state_id" id="state_add" class="form-control" required>
                                        <option value="">Select State</option>
                                        @foreach ($getState as $valueS)
                                            <option {{ $getRecordAdd->state_id == $valueS->id ? 'selected' : '' }}
                                                value="{{ $valueS->id }}">{{ $valueS->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- City Dropdown --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">City Name <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select name="city_id" id="city_add" class="form-control" required>
                                        <option value="">Select City</option>
                                        @foreach ($getCity as $valueC)
                                            <option {{ $getRecordAdd->city_id == $valueC->id ? 'selected' : '' }}
                                                value="{{ $valueC->id }}">{{ $valueC->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ url('admin/address') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
