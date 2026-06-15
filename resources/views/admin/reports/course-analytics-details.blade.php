@extends('layouts.app')

@section('content')

<h3>Course Analytics Details</h3>

<div class="card">
    <div class="card-body">

        <p>Total Enrollments : {{ $totalEnrollments }}</p>

        <p>Completed Enrollments : {{ $completedEnrollments }}</p>

        <p>Average Exam Score : {{ $averageExamScore }}</p>

        <p>Revenue Generated : ₹{{ $revenueGenerated }}</p>

    </div>
</div>

@endsection