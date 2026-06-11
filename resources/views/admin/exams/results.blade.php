@extends('layouts.app')

@section('content')

<div class="container">

<h3>{{ $exam->exam_name }} - Results</h3>

{{-- UPLOAD MARKS FORM --}}
<div class="card mb-4 p-3">

<h5>Upload Marks</h5>

<form method="POST" action="{{ route('admin.exams.storeResult',$exam->id) }}">
@csrf

<div class="row">

<div class="col-md-6">
<label>Student</label>
<select name="student_id" class="form-control">
@foreach($students as $student)

<option value="{{ $student->id }}">
    {{ $student->user->name ?? 'No Name' }}
</option>

@endforeach
</select>
</div>

<div class="col-md-6">
<label>Marks Obtained</label>
<input type="number" name="marks_obtained"
max="{{ $exam->total_marks }}"
class="form-control">
</div>

</div>

<br>

<button class="btn btn-success">
Upload Marks
</button>

</form>

</div>

{{-- RESULT TABLE --}}
<div class="card p-3">

<h5>Result List</h5>

<table class="table table-bordered">

<thead>
<tr>
<th>Student</th>
<th>Marks</th>
<th>%</th>
<th>Grade</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@foreach($exam->results as $result)

<tr>

<td>{{ $result->student->user->name ?? 'N/A' }}</td>
<td>{{ $result->marks_obtained }}/{{ $result->total_marks }}</td>

<td>{{ $result->percentage }}%</td>

<td>
<span class="badge bg-primary">
{{ $result->grade }}
</span>
</td>

<td>
<a href="{{ route('admin.exams.editResult',$result->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

{{-- PUBLISH BUTTON --}}
<form method="POST"
action="{{ route('admin.exams.publish',$exam->id) }}">
@csrf

<button class="btn btn-primary mt-3">
Generate & Publish Results
</button>

</form>

</div>

@endsection