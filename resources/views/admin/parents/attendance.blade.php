@extends('layouts.app')

@section('content')

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Student Name</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    @forelse($attendance as $row)

        <tr>
           
            <td>{{ $row->student->user->name }}</td>
               

            <td>{{ $row->attendance_date  }}</td>

            <td>{{ ucfirst($row->status) }}</td>

        </tr>

    @empty

        <tr>
            <td colspan="3">No attendance found</td>
        </tr>

    @endforelse

    </tbody>

</table>

@endsection