@extends('layouts.app')

@section('content')

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1>Parent Management</h1>

</div>

<div class="col-sm-6 text-right">

<a href="{{ route('admin.parents.create') }}"
class="btn btn-primary">

<i class="fas fa-plus"></i>

Add Parent

</a>

</div>

</div>

</div>

</section>


<section class="content">

<div class="container-fluid">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif


<div class="card">

<div class="card-header">

<h3 class="card-title">

Parent List

</h3>

</div>


<div class="card-body">

<table id="parentTable"

class="table table-bordered table-striped">

<thead>

<tr>

<th>#</th>

<th>Name</th>

<th>Email</th>

<th>Father Name</th>

<th>Phone</th>

<th>Occupation</th>

<th>Action</th>

</tr>

</thead>

<tbody>

@foreach($parents as $key => $parent)

<tr>

<td>

{{ $key+1 }}

</td>

<td>

{{ $parent->user->name }}

</td>

<td>

{{ $parent->user->email }}

</td>

<td>

{{ $parent->father_name }}

</td>

<td>

{{ $parent->phone }}

</td>

<td>

{{ $parent->occupation }}

</td>

<td>

<a href="{{ route('admin.parents.edit',$parent->id) }}"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>


<form action="{{ route('admin.parents.destroy',$parent->id) }}"

method="POST"

style="display:inline;">

@csrf

@method('DELETE')

<button type="submit"

class="btn btn-danger btn-sm"

onclick="return confirm('Delete Parent ?')">

<i class="fas fa-trash"></i>

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

@endsection


@section('scripts')

<script>

$(function(){

$('#parentTable').DataTable({

responsive:true,

lengthChange:true,

autoWidth:false,

});

});

</script>

@endsection