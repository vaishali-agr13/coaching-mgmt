@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header d-flex justify-content-between">

<h3>
Published Results
</h3>

<span class="badge bg-success">
Published
</span>

</div>

<div class="card-body">

<h5>{{ $exam->exam_name }}</h5>

<p>
Total Marks:
<strong>{{ $exam->total_marks }}</strong>
</p>

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>
<th>Rank</th>
<th>Student</th>
<th>Marks</th>
<th>Percentage</th>
<th>Grade</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@foreach($results as $index => $result)

<tr>

<td>

@if($index == 0)
🥇
@elseif($index == 1)
🥈
@elseif($index == 2)
🥉
@else
{{ $index + 1 }}
@endif

</td>

<td>
{{ $result->student->user->name ?? 'N/A' }}
</td>

<td>
{{ $result->marks_obtained }}
/
{{ $result->total_marks }}
</td>

<td>
{{ $result->percentage }}%
</td>

<td>
<span class="badge bg-primary">
{{ $result->grade }}
</span>
</td>

<td>
<span class="badge bg-success">
Published
</span>
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-3">

<a href="{{ route('admin.exams.results',$exam->id) }}"
class="btn btn-secondary">
Back
</a>

<a href="{{ route('admin.exams.rankList',$exam->id) }}"
class="btn btn-dark">
Rank List
</a>

<a href="{{ route('admin.exams.analysis',$exam->id) }}"
class="btn btn-info">
Performance Analysis
</a>

</div>

</div>

</div>

</div>

@endsection