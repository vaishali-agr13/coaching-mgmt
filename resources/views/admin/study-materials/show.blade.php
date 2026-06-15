@extends('layouts.app')

@section('title', 'Material Details')

@section('content')
<div class="container mt-4">

<h4>📄 Material Details</h4>

<div class="card">
    <div class="card-body">

        <p><b>Code:</b> {{ $material->material_code }}</p>
        <p><b>Title:</b> {{ $material->title }}</p>
        <p><b>Course:</b> {{ $material->course->course_name }}</p>
        <p><b>Type:</b> {{ $material->material_type }}</p>
        <p><b>Status:</b> {{ $material->status }}</p>

        <a href="{{ route('admin.study-materials.download', $material->id) }}" class="btn btn-success">
            Download
        </a>

    </div>
</div>

</div>
@endsection