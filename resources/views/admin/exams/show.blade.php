@extends('layouts.app')

@section('content')

<div class="container">

<h3>Exam Details</h3>

<div class="card p-3">

<p><b>Exam:</b> {{ $exam->exam_name }}</p>
<p><b>Code:</b> {{ $exam->exam_code }}</p>
<p><b>Course:</b> {{ $exam->course->course_name }}</p>
<p><b>Date:</b> {{ $exam->exam_date }}</p>
<p><b>Total Marks:</b> {{ $exam->total_marks }}</p>
<p><b>Status:</b> {{ $exam->status }}</p>

<a href="{{ route('admin.exams.results',$exam->id) }}"
class="btn btn-success">
Upload / View Results
</a>

</div>

</div>

@endsection