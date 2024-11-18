@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/colour') }}">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Order</h6>

                        <form class="forms-sample" method="POST" action="{{ url('admin/order/edit/' . $getRecord->id) }}">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Product Name <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select name="product_id" class="form-control">
                                        <option value="">Select Product</option>
                                        @foreach ($getProduct as $valueP)
                                            <option {{ ($getRecord->product_id == $valueP->id) ? 'selected' : '' }} value="{{ $valueP->id }}">
                                                {{ $valueP->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Colour Name<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    @foreach ($getColour as $valueC)

                                    @php
                                        $selected = '';
                                    @endphp

                                    @foreach ($getOrderDetail as $option)
                                    @if ($option->colour_id == $valueC->id)
                                    @php
                                        $selected = 'checked';
                                    @endphp

                                    @endif
                                    @endforeach
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="colour_id[]" value="{{ $valueC->id }}" {{ $selected }}>
                                                {{ $valueC->name }}
                                            </label>
                                        </div>
                                    @endforeach


                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Qtys<span style="color: red;">*</span></label>
                                <div class="col-sm-9">

                                    <input type="text" class="form-control" name="qtys" value="{{ $getRecord->qtys }}">




                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ url('admin/order') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
