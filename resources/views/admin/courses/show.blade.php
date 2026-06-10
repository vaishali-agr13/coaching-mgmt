@extends('layouts.app')

@section('title', 'Course Details')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Course Details</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.courses.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>

                    <a href="{{ route('admin.courses.edit',$course->id) }}"
                       class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            {{-- Course Information --}}
            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-book"></i>
                        Course Information
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">
                            <strong>Course Code</strong>
                            <p>{{ $course->course_code }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Course Name</strong>
                            <p>{{ $course->course_name }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Category</strong>
                            <p>{{ $course->category ?? '-' }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Level</strong>
                            <p>{{ ucfirst($course->level) }}</p>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <strong>Duration</strong>
                            <p>{{ $course->duration_hours }} Hours</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Max Students</strong>
                            <p>{{ $course->max_students }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Course Fee</strong>
                            <p>₹{{ number_format($course->fee,2) }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Status</strong>
                            <p>
                                @if($course->status=='active')
                                    <span class="badge badge-success">Active</span>
                                @elseif($course->status=='completed')
                                    <span class="badge badge-primary">Completed</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </p>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <strong>Start Date</strong>
                            <p>{{ $course->start_date }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>End Date</strong>
                            <p>{{ $course->end_date }}</p>
                        </div>

                        <div class="col-md-6">
                            <strong>Faculty</strong>
                            <p>
                                {{ $course->faculty->user->name ?? $course->faculty->employee_id ?? 'Not Assigned' }}
                            </p>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <strong>Description</strong>
                            <p>
                                {{ $course->description ?? 'No description available.' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Enrolled Students --}}
            <div class="card card-success">

                <div class="card-header">
                    <h3 class="card-title">
                        Enrolled Students
                    </h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Roll Number</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($course->enrollments as $enrollment)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $enrollment->student->user->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $enrollment->student->roll_number ?? '-' }}
                                    </td>

                                    <td>
                                        <span class="badge badge-success">
                                            Enrolled
                                        </span>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center">
                                        No Students Enrolled
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Exams --}}
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">
                        Course Exams
                    </h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam Name</th>
                                <th>Exam Date</th>
                                <th>Total Marks</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($course->exams as $exam)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $exam->exam_name }}</td>

                                    <td>{{ $exam->exam_date }}</td>

                                    <td>{{ $exam->total_marks }}</td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center">
                                        No Exams Found
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection