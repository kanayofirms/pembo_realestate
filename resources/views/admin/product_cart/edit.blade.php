@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/product_cart') }}">Product Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product Cart</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Product Cart</h6>

                        <form class="forms-sample" method="POST"
                            action="{{ url('admin/product_cart/edit/' . $getRecord->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Name <span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="{{ $getRecord->name }}"
                                        placeholder="Name" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Description<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" placeholder="Description" required>{{ $getRecord->description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Image<span
                                        style="color: red;"></span></label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control">
                                    <img src="{{ asset('product/' . $getRecord->image) }}" alt="product_image"
                                        style="width: 6.5vw; height: 14.5vh;">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Price<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="price" class="form-control"
                                        value="{{ $getRecord->price }}" placeholder="Price" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ url('admin/product_cart') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
