@extends('layouts.app')

@section('title','Course Analytics')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">Course Analytics Report</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Faculty</th>
                            <th>Duration</th>
                            <th>Max Students</th>
                            <th>Completed Enrollments</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Analytics</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($courses as $course)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $course->course_name }}</strong>
                            </td>

                            <td>
                                {{ $course->faculty->user->name ?? 'Not Assigned' }}
                            </td>

                            <td>
                                {{ $course->duration_hours }} Hours
                            </td>

                            <td>
                                {{ $course->max_students }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $course->enrollments->count() }}
                                </span>
                            </td>

                            <td>
                                ₹{{ number_format($course->fee,2) }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.reports.courseAnalyticsDetails',$course->id) }}"
                                   class="btn btn-primary btn-sm">
                                    View Details
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center">
                                No Courses Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $courses->links() }}
            </div>

        </div>

    </div>

</div>

@endsection