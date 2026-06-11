@extends('layouts.app')

@section('content')

<div class="container">

<h3>Edit Result</h3>

<div class="card p-3">

<form method="POST" 
action="{{ route('admin.exams.updateResult',$result->id) }}">

@csrf
@method('PUT')

<div class="mb-3">
<label>Student</label>
<input type="text"
value="{{ $result->student->user->name ?? 'N/A' }}"
class="form-control" disabled>
</div>

<div class="mb-3">
<label>Marks Obtained</label>
<input type="number"
name="marks_obtained"
value="{{ $result->marks_obtained }}"
class="form-control">
</div>

<div class="mb-3">
<label>Remarks</label>
<textarea name="remarks"
class="form-control">{{ $result->remarks }}</textarea>
</div>

<button class="btn btn-success">
Update Result
</button>

</form>

</div>

</div>

@endsection