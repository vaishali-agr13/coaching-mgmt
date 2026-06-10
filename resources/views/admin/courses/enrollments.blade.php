@extends('layouts.app')

@section('title', 'Course Enrollments')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Course Enrollments</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.courses.show', $course->id) }}"
                       class="btn btn-secondary">
                        Back
                    </a>
                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        {{ $course->course_name }}
                    </h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Roll Number</th>
                                <th>Email</th>
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
                                        {{ $enrollment->student->user->email ?? '-' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center">
                                        No Enrollments Found
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