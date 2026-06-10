@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Monthly Attendance Report</h4>
    </div>

    <div class="card-body">

        <form method="GET" class="row mb-3">

            <div class="col-md-3">
                <select name="month" class="form-control">

                    @for($i=1;$i<=12;$i++)

                    <option value="{{ $i }}"
                        {{ $month==$i ? 'selected' : '' }}>
                        {{ date('F', mktime(0,0,0,$i,1)) }}
                    </option>

                    @endfor

                </select>
            </div>

            <div class="col-md-3">
                <input type="number"
                       name="year"
                       value="{{ $year }}"
                       class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">
                    Filter
                </button>
            </div>

        </form>

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>Student</th>
                    <th>Total Days</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Percentage</th>
                </tr>

            </thead>

            <tbody>

            @foreach($report as $row)

                @php
                    $percentage = $row->total_days > 0
                        ? round(($row->present_days/$row->total_days)*100,2)
                        : 0;
                @endphp

                <tr>
                    <td>{{ $row->student->user->name }}</td>
                    <td>{{ $row->total_days }}</td>
                    <td>{{ $row->present_days }}</td>
                    <td>{{ $row->absent_days }}</td>
                    <td>{{ $percentage }}%</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection