@extends('layouts.app')

@section('title','Student Details')

@section('content')

<h3>Student Performance Details</h3>

<div class="card">
    <div class="card-body">

        <p><strong>Name:</strong> {{ $student->user->name }}</p>

        <p><strong>Total Exams:</strong> {{ $totalExams }}</p>

        <p><strong>Average Marks:</strong> {{ $averageMarks }}%</p>

        <p><strong>Total Homework:</strong> {{ $totalHomework }}</p>

        <p><strong>Completed Homework:</strong> {{ $completedHomework }}</p>

        <p><strong>Attendance:</strong> {{ $attendancePercentage }}%</p>

    </div>
</div>

@endsection