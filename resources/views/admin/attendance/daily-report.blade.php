@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Daily Attendance Report</h4>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('admin.attendance.dailyReport') }}">

                <div class="row mb-3">

                    <div class="col-md-3">
                        <input type="date"
                            name="date"
                            value="{{ $date }}"
                            class="form-control">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>

                </div>

            </form>

            <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            @foreach($attendance as $row)

                <tr>
                    <td>{{ $row->student->user->name }}</td>
                    <td>{{ $row->course->course_name }}</td>
                    <td>{{ ucfirst($row->status) }}</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>
</div>

@endsection