@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3>{{ $totalStudents }}</h3>
<p>Total Students</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3>{{ $averageMarks }}</h3>
<p>Average Marks</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3>{{ $highestMarks }}</h3>
<p>Highest Marks</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3>{{ $lowestMarks }}</h3>
<p>Lowest Marks</p>
</div>
</div>
</div>

</div>

<br>

<div class="row">

<div class="col-md-4">
<div class="card text-center">
<div class="card-body">
<h3>{{ $averagePercentage }}%</h3>
<p>Average Percentage</p>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card text-center">
<div class="card-body">
<h3>{{ $passCount }}</h3>
<p>Passed Students</p>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card text-center">
<div class="card-body">
<h3>{{ $failCount }}</h3>
<p>Failed Students</p>
</div>
</div>
</div>

</div>

<br>

<div class="card">

<div class="card-header">
Performance Summary
</div>

<div class="card-body">

<p>
Pass Percentage:
<strong>{{ $passPercentage }}%</strong>
</p>

<p>
Exam Name:
<strong>{{ $exam->exam_name }}</strong>
</p>

<p>
Passing Marks:
<strong>{{ $exam->passing_marks }}</strong>
</p>

</div>

</div>

</div>

@endsection