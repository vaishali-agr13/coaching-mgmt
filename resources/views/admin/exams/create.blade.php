@extends('layouts.app')

@section('content')

<div class="card">

<div class="card-header">
Create Test
</div>

<div class="card-body">

<form action="{{ route('admin.exams.store') }}" method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">
<label>Exam Code</label>
<input type="text"
name="exam_code"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Exam Name</label>
<input type="text"
name="exam_name"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Course</label>

<select name="course_id" class="form-control">

@foreach($courses as $course)

<option value="{{ $course->id }}">
{{ $course->course_name }}
</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Exam Type</label>

<select name="exam_type" class="form-control">
<option value="unit_test">Unit Test</option>
<option value="midterm">Mid Term</option>
<option value="final">Final</option>
<option value="mock">Mock</option>
<option value="practice">Practice</option>
</select>

</div>

<div class="col-md-4 mb-3">
<label>Date</label>
<input type="date" name="exam_date"
class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Start Time</label>
<input type="time" name="start_time"
class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>End Time</label>
<input type="time" name="end_time"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Total Marks</label>
<input type="number"
name="total_marks"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Passing Marks</label>
<input type="number"
name="passing_marks"
class="form-control">
</div>

</div>

<button class="btn btn-success">
Save Exam
</button>

</form>

</div>
</div>

@endsection