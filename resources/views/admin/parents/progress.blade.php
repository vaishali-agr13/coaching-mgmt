@extends('layouts.app')

@section('content')

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1>

Student Progress

</h1>

</div>

</div>

</div>

</section>



<section class="content">

<div class="container-fluid">



{{-- Student Information --}}

<div class="card">

<div class="card-header">

<h3 class="card-title">

Student Information

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">

<strong>Name :</strong>

{{ $student->name }}

</div>

<div class="col-md-4">

<strong>Roll No :</strong>

{{ $student->roll_number ?? '-' }}

</div>

<div class="col-md-4">

<strong>Admission No :</strong>

{{ $student->registration_number ?? '-' }}

</div>

</div>

</div>

</div>



{{-- Summary Cards --}}

<div class="row">


<div class="col-lg-3 col-6">

<div class="small-box bg-info">

<div class="inner">

<h3>

{{ $totalClasses }}

</h3>

<p>

Total Classes

</p>

</div>

<div class="icon">

<i class="fas fa-calendar"></i>

</div>

</div>

</div>



<div class="col-lg-3 col-6">

<div class="small-box bg-success">

<div class="inner">

<h3>

{{ $present }}

</h3>

<p>

Present

</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>



<div class="col-lg-3 col-6">

<div class="small-box bg-danger">

<div class="inner">

<h3>

{{ $absent }}

</h3>

<p>

Absent

</p>

</div>

<div class="icon">

<i class="fas fa-times-circle"></i>

</div>

</div>

</div>



<div class="col-lg-3 col-6">

<div class="small-box bg-warning">

<div class="inner">

<h3>

{{ $attendancePercentage }}%

</h3>

<p>

Attendance %

</p>

</div>

<div class="icon">

<i class="fas fa-chart-pie"></i>

</div>

</div>

</div>


</div>



{{-- Attendance Table --}}

<div class="card">

<div class="card-header">

<h3 class="card-title">

Attendance Report

</h3>

</div>

<div class="card-body table-responsive p-0">

<table class="table table-hover text-nowrap">

<thead>

<tr>

<th>#</th>

<th>Date</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($attendance as $row)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

{{ \Carbon\Carbon::parse($row->attendance_date )->format('d-m-Y') }}

</td>

<td>

@if($row->status == 'present')

<span class="badge bg-success">

Present

</span>

@else

<span class="badge bg-danger">

Absent

</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="3" class="text-center">

No Attendance Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>



{{-- Results Table --}}

<div class="card">

<div class="card-header">

<h3 class="card-title">

Exam Results

</h3>

</div>

<div class="card-body table-responsive p-0">

<table class="table table-bordered">

<thead>

<tr>

<th>#</th>

<th>Exam</th>

<th>Subject</th>

<th>Marks Obtained</th>

<th>Total Marks</th>

<th>Percentage</th>

</tr>

</thead>

<tbody>

@forelse($results as $result)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

{{ $result->exam->exam_name }}

</td>

<td>

{{ $result->exam->course->course_name ?? '-' }}
</td>

<td>

{{ $result->marks_obtained }}

</td>

<td>

{{ $result->total_marks }}

</td>

<td>

{{ round(($result->marks_obtained/$result->total_marks)*100) }}%

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center">

No Results Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>


</div>

</section>

</div>

@endsection