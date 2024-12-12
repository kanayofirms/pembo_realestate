<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add To Cart - pembo.org</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <style type="text/css">
        .dropdown {
            float: right;
            padding-right: 2rem;
        }

        .dropdown .dropdown-menu {
            padding: 20px;
            top: 30px !important;
            width: 350px !important;
            left: 0px !important;
            box-shadow: 0px 5px 30px black;
        }

        .dropdown-menu:before {
            content: " ";
            position: absolute;
            top: -20px;
            right: 50px;
            border: 10px solid transparent;
            border-bottom-color: #fff;
        }

        .fs-8 {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row navbar-light bg-light pt-2 pb-2">
            <div class="col-lg-10">
                <h3 class="mt-2">Add To Cart - pembo.org</h3>
            </div>
            <div class="col-md-2 text-end main-section">
                <div class="dropdown">
                    <button type="button" class="btn btn-info dropdown-toggle mt-1" data-bs-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Cart <span class="badge bg-danger">11</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="badge bg-danger">22</span>
                            </div>
                        </div>

                        <div class="row cart-detail pb-3 pt-2">
                            <div class="col-lg-4 col-sm-4 col-4">
                                <img src="{{ asset('product/fgk442bW8F8Yc3rvRSQJhgzTcBxkP4.jpg') }}" class="img-fluid"
                                    alt="Product Image" />
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <p class="mb-0">Product Name</p>
                                <span class="fs-8 text-info">Price: N200</span><br>
                                <span class="fs-8 fw-lighter">Quantity: 55</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="#" class="btn btn-info">View All</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>
