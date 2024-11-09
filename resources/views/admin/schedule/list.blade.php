@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                <li class="breadcrumb-item active" aria-current="page">Schedule List</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Schedule List</h4>
                            <div class="d-flex align-items-center">

                            </div>
                        </div>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Week</th>
                                        <th>Open/Close</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($weekRecord as $row)
                                        <tr class="table-info text-dark">
                                            <td>{{ !empty($row->name) ? $row->name : '' }}</td>
                                            <td>
                                                <label for="" class="switch">
                                                    <input type="checkbox" name="week">
                                                </label>
                                            </td>
                                            <td>
                                                @foreach ($weekTimeRow as $timeRow1)
                                                    <option value="">{{ $timeRow1->name }}</option>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($weekTimeRow as $timeNow)
                                                    <option value="">{{ $timeNow->name }}</option>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="padding: 20px; float: right;">
                            {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
