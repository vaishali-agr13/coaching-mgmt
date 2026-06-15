@extends('layouts.app')

@section('title','Student Performance')

@section('content')

<h3>Student Performance Report</h3>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->user->name ?? '-' }}</td>
        <td>
            <a href="{{ route('admin.reports.studentPerformanceDetails',$student->id) }}"
                class="btn btn-sm btn-primary">
                View
            </a>
        </td>
    </tr>
    @endforeach
</table>

{{ $students->links() }}

@endsection