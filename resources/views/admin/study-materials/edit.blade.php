@extends('layouts.app')

@section('title', 'Edit Study Material')

@section('content')
<div class="container mt-4">

    <h4>✏️ Edit Study Material</h4>

    <form action="{{ route('admin.study-materials.update', $material->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6">
                <label>Material Code</label>
                <input type="text"
                       name="material_code"
                       class="form-control"
                       value="{{ old('material_code', $material->material_code) }}"
                       required>
            </div>

            <div class="col-md-6">
                <label>Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title', $material->title) }}"
                       required>
            </div>

            <div class="col-md-12 mt-2">
                <label>Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description', $material->description) }}</textarea>
            </div>

            <div class="col-md-6 mt-2">
                <label>Course</label>
                <select name="course_id" class="form-control" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}"
                            {{ old('course_id', $material->course_id) == $course->id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <label>Material Type</label>
                <select name="material_type" class="form-control">
                    <option value="pdf"
                        {{ old('material_type', $material->material_type) == 'pdf' ? 'selected' : '' }}>
                        PDF
                    </option>

                    <option value="video"
                        {{ old('material_type', $material->material_type) == 'video' ? 'selected' : '' }}>
                        Video
                    </option>

                    <option value="document"
                        {{ old('material_type', $material->material_type) == 'document' ? 'selected' : '' }}>
                        Document
                    </option>

                    <option value="image"
                        {{ old('material_type', $material->material_type) == 'image' ? 'selected' : '' }}>
                        Image
                    </option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <label>Replace File</label>
                <input type="file" name="file" class="form-control">

                @if($material->file_path)
                    <small class="text-success d-block mt-2">
                        Current File:
                        <a href="{{ asset('storage/' . $material->file_path) }}"
                           target="_blank">
                            View File
                        </a>
                    </small>
                @endif
            </div>

            <div class="col-md-6 mt-2">
                <label>Visibility</label>
                <select name="visibility" class="form-control">

                    <option value="public"
                        {{ old('visibility', $material->visibility) == 'public' ? 'selected' : '' }}>
                        Public
                    </option>

                    <option value="private"
                        {{ old('visibility', $material->visibility) == 'private' ? 'selected' : '' }}>
                        Private
                    </option>

                    <option value="restricted"
                        {{ old('visibility', $material->visibility) == 'restricted' ? 'selected' : '' }}>
                        Restricted
                    </option>

                </select>
            </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-success">
                    Update Study Material
                </button>

                <a href="{{ route('admin.study-materials.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </div>

        </div>

    </form>

</div>
@endsection