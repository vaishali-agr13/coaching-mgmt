@extends('layouts.app')

@section('title', 'Faculty List')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Faculty List</h4>
        <a href="{{ route('admin.faculty.create') }}" class="btn btn-primary">
            + Add Faculty
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('admin.faculty.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control"
                               placeholder="Search faculty by name, email, phone..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Faculty Table --}}
    <div class="card">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <!-- <th>Photo</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($faculties as $key => $faculty)
                            <tr>
                                <td>{{ $faculties->firstItem() + $key }}</td>

                                <!-- <td>
                                    <img src="{{ $faculty->photo ? asset('uploads/faculty/'.$faculty->photo) : asset('admin/default-user.png') }}"
                                         width="45" height="45"
                                         class="rounded-circle">
                                </td> -->

                                <td>{{ $faculty->user->name }}</td>
                                <td>{{ $faculty->user->email }}</td>
                                <td>{{ $faculty->user->phone }}</td>
                                <td>{{ $faculty->department }}</td>

                                <td>
                                    @if($faculty->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.faculty.edit', $faculty->id) }}"
                                       class="btn btn-sm btn-info">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.faculty.destroy', $faculty->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    No faculty found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer">
        </div>
    </div>

</div>

@endsection