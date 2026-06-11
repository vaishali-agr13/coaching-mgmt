@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">
    <h3>Rank List - {{ $exam->exam_name }}</h3>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
    <th>Rank</th>
    <th>Student</th>
    <th>Marks</th>
    <th>Percentage</th>
    <th>Grade</th>
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
{{ $result->marks_obtained }}/{{ $result->total_marks }}
</td>

<td>
{{ $result->percentage }}%
</td>

<td>
{{ $result->grade }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

@endsection