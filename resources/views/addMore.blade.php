<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add More Fields - pembo.org</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Add More Fields - pembo.org</h3>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif

                <form action="{{ route('add-more.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h5>Create Category: </h5>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Enter Name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <table class="table table-bordered mt-2 table-add-more">
                        <thead>
                            <tr>
                                <th colspan="2">Add Stocks</th>
                                <th>
                                    <button type="button" class="btn btn-primary btn-sm btn-add-more">
                                        <i class="fa fa-plus"></i> Add More
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (old('stocks'))
                                @foreach (old('stocks') as $key => $stock)
                                    <tr>
                                        <td>
                                            <input type="number" name="stocks[{{ $key }}][quantity]"
                                                class="form-control" value="{{ $stock['quantity'] ?? '' }}"
                                                placeholder="Quantity">
                                            @error("stocks.$key.quantity")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" name="stocks[{{ $key }}][price]"
                                                class="form-control" value="{{ $stock['price'] ?? '' }}"
                                                placeholder="Price">
                                            @error("stocks.$key.price")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm btn-add-more-rm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="number" name="stocks[0][quantity]" class="form-control"
                                            placeholder="Quantity">
                                    </td>
                                    <td>
                                        <input type="number" name="stocks[0][price]" class="form-control"
                                            placeholder="Price">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm btn-add-more-rm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa fa-save"></i> Submit
                        </button>
                    </div>
                </form>

                <h5 class="mt-5">Category List</h5>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Total Price</th>
                            <th>Total Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Populate dynamically or leave empty -->
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stocks->sum('price') }}</td>
                                <td>{{ $product->stocks->sum('quantity') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    There are no category available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Pagination --}}
                {!! $products->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Add More Button Click
            let i = $(".table-add-more tbody tr").length;
            $(".btn-add-more").click(function(e) {
                e.preventDefault();
                $(".table-add-more tbody").append(
                    `<tr>
                        <td>
                            <input type="number" name="stocks[${i}][quantity]" class="form-control" placeholder="Quantity">
                        </td>
                        <td>
                            <input type="number" name="stocks[${i}][price]" class="form-control" placeholder="Price">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm btn-add-more-rm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>`
                );
                i++;
            });

            // Remove Row Button Click
            $(document).on("click", ".btn-add-more-rm", function(e) {
                e.preventDefault();
                $(this).closest("tr").remove();
            });
        });
    </script>
</body>

</html>
