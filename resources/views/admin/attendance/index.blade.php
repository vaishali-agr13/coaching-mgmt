@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="card">
<div class="card-header">
    <h4>Attendance Records</h4>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
    <th>Date</th>
    <th>Student</th>
    <th>Course</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

@foreach($attendance as $row)

<tr>
    <td>{{ $row->attendance_date }}</td>
    <td>{{ $row->student->user->name ?? '' }}</td>
    <td>{{ $row->course->course_name ?? '' }}</td>
    <td>
        <span class="badge bg-{{ $row->status=='present' ? 'success' : 'danger' }}">
            {{ ucfirst($row->status) }}
        </span>
    </td>
</tr>

@endforeach

</tbody>

</table>

{{ $attendance->links() }}

</div>
</div>

</div>

@endsection