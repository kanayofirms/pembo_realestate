@extends('agent.agent_dashboard')

@section('agent')
<div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/transactions') }}">Transactions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Transactions</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Transactions</h6>

                        <form class="forms-sample" method="POST" action="{{ url('agent/transactions/add') }}">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Order Number <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                        <input type="text" name="order_number" class="form-control" placeholder="Enter Order Number" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Transaction<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="transaction_id" class="form-control" placeholder="Enter Transaction" required>

                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Amount<span style="color: red;">*</span></label>
                                <div class="col-sm-9">

                                    <input type="text" class="form-control" name="amount" placeholder="Enter Amount" required>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Payment Status<span style="color: red;">*</span></label>
                                <div class="col-sm-9">

                                    <select name="is_payment" class="form-control" required>
                                        <option value="">Select Payment Status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Completed</option>
                                    </select>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ url('admin/transactions') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
