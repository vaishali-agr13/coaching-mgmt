@extends('layouts.app')

@section('title', 'Courses')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Courses</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.courses.create') }}"
                       class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Course
                    </a>
                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Course List</h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Course Name</th>
                            <th>Category</th>
                            <th>Level</th>
                            <th>Faculty</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($courses as $course)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $course->course_code }}</td>

                                <td>{{ $course->course_name }}</td>

                                <td>{{ $course->category }}</td>

                                <td>{{ $course->level }}</td>

                                <td>
                                    {{ $course->faculty->user->name ?? 'N/A' }}
                                </td>

                                <td>
                                    ₹ {{ number_format($course->fee,2) }}
                                </td>

                                <td>
                                    @if($course->status == 'active')
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('admin.courses.show',$course->id) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="{{ route('admin.courses.edit',$course->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                     <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.courses.enrollments', $course->id) }}"
                                        class="btn btn-success btn-sm">
                                            <i class="fas fa-users"></i> Enrollments
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

                <div class="card-footer">
                    {{ $courses->links() }}
                </div>

            </div>

        </div>

    </section>

</div>

@endsection