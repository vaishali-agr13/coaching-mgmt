@extends('layouts.app')

@section('title', 'Study Materials')

@section('content')

<a href="{{ route('admin.study-materials.create') }}">Create</a>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>📚 Study Materials</h4>

        <a href="{{ route('admin.study-materials.create') }}" class="btn btn-primary">
            + Upload Material
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search title/code">
        </div>

        <div class="col-md-3">
            <select name="course_id" class="form-control">
                <option value="">All Courses</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="draft">Draft</option>
                <option value="archived">Archived</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100">Filter</button>
        </div>
    </form>

    {{-- Table --}}
    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Course</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($materials as $material)
                    <tr>
                        <td>{{ $material->material_code }}</td>
                        <td>{{ $material->title }}</td>
                        <td>{{ $material->course->course_name ?? '-' }}</td>
                        <td>{{ ucfirst($material->material_type) }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ $material->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.study-materials.show', $material->id) }}" class="btn btn-sm btn-info">View</a>

                            <a href="{{ route('admin.study-materials.edit', $material->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <a href="{{ route('admin.study-materials.download', $material->id) }}" class="btn btn-sm btn-success">Download</a>

                            <form action="{{ route('admin.study-materials.destroy', $material->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $materials->links() }}

        </div>
    </div>

</div>
@endsection