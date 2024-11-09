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
                                        @php
                                            $getUserWeek = App\Models\UserTimeModel::getDetail($row->id);
                                            $open_close = !empty($getUserWeek->status) ? $getUserWeek->status : '';
                                            $start_time = !empty($getUserWeek->start_time)
                                                ? $getUserWeek->start_time
                                                : '';
                                            $end_time = !empty($getUserWeek->end_time) ? $getUserWeek->end_time : '';
                                        @endphp
                                        <tr class="table-info text-dark">
                                            <td>{{ !empty($row->name) ? $row->name : '' }}</td>
                                            <td>
                                                <input type="hidden" value="{{ $row->id }}"
                                                    name="week[{{ $row->id }}][week_id]">
                                                <label for="" class="switch">
                                                    <input type="checkbox" name="week[{{ $row->id }}][status]"
                                                        id="{{ $row->id }}" {{ !empty($open_close) ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                            <td>
                                                <select name="week[{{ $row->id }}][start_time]" class="form-control">
                                                    @foreach ($weekTimeRow as $timeRow1)
                                                        <option value="">{{ $timeRow1->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="week[{{ $row->id }}][end_time]" class="form-control">
                                                    @foreach ($weekTimeRow as $timeNow)
                                                        <option value="">{{ $timeNow->name }}</option>
                                                    @endforeach
                                                </select>
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
