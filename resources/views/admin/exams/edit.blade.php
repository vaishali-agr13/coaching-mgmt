@extends('layouts.app')

@section('content')

<div class="container">

<h3>Edit Exam</h3>

<form method="POST" action="{{ route('admin.exams.update',$exam->id) }}">
@csrf
@method('PUT')

<div class="card p-3">

<div class="row">

<div class="col-md-6 mb-3">
<label>Exam Code</label>
<input type="text" name="exam_code"
value="{{ $exam->exam_code }}"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Exam Name</label>
<input type="text" name="exam_name"
value="{{ $exam->exam_name }}"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Exam Type</label>
<select name="exam_type" class="form-control">
<option value="unit_test" {{ $exam->exam_type=='unit_test'?'selected':'' }}>Unit Test</option>
<option value="midterm" {{ $exam->exam_type=='midterm'?'selected':'' }}>Mid Term</option>
<option value="final" {{ $exam->exam_type=='final'?'selected':'' }}>Final</option>
<option value="mock" {{ $exam->exam_type=='mock'?'selected':'' }}>Mock</option>
<option value="practice" {{ $exam->exam_type=='practice'?'selected':'' }}>Practice</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label>Date</label>
<input type="date" name="exam_date"
value="{{ \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d') }}"
class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Start Time</label>
<input type="time" name="start_time"
value="{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}"
class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>End Time</label>
<input type="time" name="end_time"
value="{{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Total Marks</label>
<input type="number" name="total_marks"
value="{{ $exam->total_marks }}"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Passing Marks</label>
<input type="number" name="passing_marks"
value="{{ $exam->passing_marks }}"
class="form-control">
</div>

</div>

<button class="btn btn-success">Update Exam</button>

</div>

</form>

</div>

@endsection