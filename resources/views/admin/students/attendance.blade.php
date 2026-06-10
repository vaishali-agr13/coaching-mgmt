@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Attendance Records</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($student->attendance as $attendance)

                <tr>
                    <td>{{ $attendance->attendance_date  }}</td>

                    <td>
                        <span class="badge bg-{{ $attendance->status=='present' ? 'success' : 'danger' }}">
                            {{ ucfirst($attendance->status) }}
                        </span>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="2" class="text-center">
                        No Attendance Found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection