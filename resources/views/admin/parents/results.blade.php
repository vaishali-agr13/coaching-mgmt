@extends('layouts.app')

@section('content')

<h3>Results</h3>

<table class="table">

<thead>

<tr>

<th>Exam</th>

<th>Subject</th>

<th>Marks</th>

<th>Total</th>

</tr>

</thead>

<tbody>

@foreach($results as $result)

<tr>

<td>

{{ $result->exam_name }}

</td>

<td>

{{ $result->subject }}

</td>

<td>

{{ $result->marks }}

</td>

<td>

{{ $result->total_marks }}

</td>

</tr>

@endforeach

</tbody>

</table>

@endsection