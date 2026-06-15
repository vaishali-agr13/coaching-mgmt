@extends('layouts.app')

@section('title', 'Admission Details')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5>Admission Details</h5>
        </div>

        <div class="card-body">
            <p><strong>Name:</strong> {{ $admission->first_name }} {{ $admission->last_name }}</p>
            <p><strong>Email:</strong> {{ $admission->email }}</p>
            <p><strong>Phone:</strong> {{ $admission->phone }}</p>
            <p><strong>DOB:</strong> {{ $admission->date_of_birth }}</p>
            <p><strong>Course:</strong> {{ $admission->applied_course->course_name ?? '-' }}</p>
            <p><strong>Education:</strong> {{ $admission->education_background }}</p>

            <p>
                <strong>Status:</strong>
                <span class="badge bg-primary">{{ $admission->application_status }}</span>
            </p>

            <hr>

            {{-- Actions --}}
            <form action="{{ route('admissions.approve', $admission->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-success">Approve</button>
            </form>

            <form action="{{ route('admissions.reject', $admission->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-danger">Reject</button>
            </form>

            <form action="{{ route('admissions.waitlist', $admission->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-warning">Waitlist</button>
            </form>

        </div>
    </div>

</div>
@endsection