@extends('layouts.app')

@section('title', 'Admissions List')

@section('content')
<div class="container-fluid">

    <h4 class="mb-3">Admissions</h4>

    {{-- Filters --}}
    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name/email">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                <option value="waitlist" {{ request('status')=='waitlist'?'selected':'' }}>Waitlist</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    {{-- Table --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($admissions as $admission)
                        <tr>
                            <td>{{ $admission->first_name }} {{ $admission->last_name }}</td>
                            <td>{{ $admission->email }}</td>
                            <td>{{ $admission->applied_course->course_name ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ ucfirst($admission->application_status) }}
                                </span>
                            </td>
                            <td>{{ $admission->application_date }}</td>

                            <td>
                                <a href="{{ route('admissions.show', $admission->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admissions.edit', $admission->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admissions.destroy', $admission->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $admissions->links() }}
        </div>
    </div>

</div>
@endsection