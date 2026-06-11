@extends('layouts.app')

@section('title', 'Examination Management')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold">Examination Management</h3>
            <p class="text-muted">Manage Tests, Results & Analysis</p>
        </div>

        <div class="col-md-6 text-end">
            <a href="{{ route('admin.exams.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Test
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Search & Filter</h5>
        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('admin.exams.index') }}">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Search Exam</label>
                        <input type="text"
                               name="search"
                               class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Exam Name / Code">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Course</label>

                        <select name="course_id" class="form-control">
                            <option value="">All Courses</option>

                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="">All</option>

                            <option value="scheduled"
                                {{ request('status')=='scheduled' ? 'selected' : '' }}>
                                Scheduled
                            </option>

                            <option value="completed"
                                {{ request('status')=='completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button class="btn btn-success w-100">
                            Search
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">Exam List</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Exam Code</th>
                        <th>Exam Name</th>
                        <th>Course</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Total Marks</th>
                        <th>Status</th>
                        <th width="300">Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($exams as $exam)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $exam->exam_code }}</td>

                            <td>{{ $exam->exam_name }}</td>

                            <td>
                                {{ $exam->course->course_name ?? 'N/A' }}
                            </td>

                            <td>
                                <span class="badge bg-info">
                                    {{ ucfirst(str_replace('_',' ',$exam->exam_type)) }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}
                            </td>

                            <td>{{ $exam->total_marks }}</td>

                            <td>

                                @if($exam->status=='scheduled')
                                    <span class="badge bg-warning">
                                        Scheduled
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        Completed
                                    </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.exams.show',$exam->id) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ route('admin.exams.edit',$exam->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="{{ route('admin.exams.results',$exam->id) }}"
                                   class="btn btn-success btn-sm">
                                    Results
                                </a>

                                <!-- <a href="{{ route('admin.exams.results',$exam->id) }}"
                                    class="btn btn-success btn-sm">
                                    Upload Marks
                                </a> -->
                                
                                <form action="{{ route('admin.exams.destroy',$exam->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this exam?')"
                                        class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center">
                                No Exams Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $exams->links() }}
            </div>

        </div>

    </div>

</div>

@endsection