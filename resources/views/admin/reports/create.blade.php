@extends('layouts.app')

@section('title', 'Upload Study Material')

@section('content')
<div class="container mt-4">

<h4>📤 Upload Study Material</h4>

<form action="{{ route('admin.study-materials.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">

    <div class="col-md-6">
        <label>Material Code</label>
        <input type="text" name="material_code" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="col-md-12 mt-2">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="col-md-6 mt-2">
        <label>Course</label>
        <select name="course_id" class="form-control" required>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mt-2">
        <label>Material Type</label>
        <select name="material_type" class="form-control">
            <option value="pdf">PDF</option>
            <option value="video">Video</option>
            <option value="document">Document</option>
            <option value="image">Image</option>
        </select>
    </div>

    <div class="col-md-6 mt-2">
        <label>File</label>
        <input type="file" name="file" class="form-control" required>
    </div>

    <div class="col-md-6 mt-2">
        <label>Visibility</label>
        <select name="visibility" class="form-control">
            <option value="public">Public</option>
            <option value="private">Private</option>
            <option value="restricted">Restricted</option>
        </select>
    </div>

    <div class="col-md-12 mt-3">
        <button class="btn btn-primary">Upload</button>
    </div>

</div>

</form>

</div>
@endsection