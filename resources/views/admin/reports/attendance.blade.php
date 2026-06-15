@extends('layouts.app')

@section('title', 'Attendance Report')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Attendance Report</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Total Classes</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Attendance %</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($students as $student)

                            @php
                                $attendance = $student->attendance->first();

                                $total = $attendance->total ?? 0;
                                $present = $attendance->present ?? 0;
                                $absent = $total - $present;

                                $percentage = $total > 0
                                    ? round(($present / $total) * 100, 2)
                                    : 0;
                            @endphp

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $student->user->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $total }}
                                </td>

                                <td>
                                    {{ $present }}
                                </td>

                                <td>
                                    {{ $absent }}
                                </td>

                                <td>
                                    {{ $percentage }}%
                                </td>

                                <td>

                                    @if($percentage >= 90)
                                        <span class="badge bg-success">
                                            Excellent
                                        </span>

                                    @elseif($percentage >= 75)
                                        <span class="badge bg-primary">
                                            Good
                                        </span>

                                    @elseif($percentage >= 60)
                                        <span class="badge bg-warning text-dark">
                                            Average
                                        </span>

                                    @else
                                        <span class="badge bg-danger">
                                            Low
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center">
                                    No Attendance Records Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $students->links() }}
            </div>

        </div>
    </div>

</div>

@endsection