@extends('layouts.app')

@section('content')

<h3>Faculty Performance Details</h3>

<div class="card">
    <div class="card-body">

        <p>Courses Taught : {{ $coursesTaught }}</p>

        <p>Total Students : {{ $totalStudents }}</p>

        <p>Average Student Score : {{ $averageStudentScore }}</p>

    </div>
</div>

@endsection