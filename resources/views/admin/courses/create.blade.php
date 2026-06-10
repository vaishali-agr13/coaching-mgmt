@extends('layouts.app')

@section('title','Create Course')

@section('content')

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Create Course</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card card-primary">

<div class="card-header">
    <h3 class="card-title">Course Details</h3>
</div>

<form action="{{ route('admin.courses.store') }}" method="POST">
@csrf

<div class="card-body">

<div class="row">

<div class="col-md-6">
    <div class="form-group">
        <label>Course Code</label>
        <input type="text"
               name="course_code"
               class="form-control"
               required>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Course Name</label>
        <input type="text"
               name="course_name"
               class="form-control"
               required>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Category</label>
        <select name="category" class="form-control">
            <option value="Programming">Programming</option>
            <option value="Commerce">Commerce</option>
            <option value="Management">Management</option>
        </select>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Level</label>
        <select name="level" class="form-control">
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Duration Hours</label>
        <input type="number"
               name="duration_hours"
               class="form-control">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Maximum Students</label>
        <input type="number"
               name="max_students"
               class="form-control">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Faculty</label>

        <select name="faculty_id"
                class="form-control">

            <option value="">Select Faculty</option>

            @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}">
                    {{ $faculty->user->name }}
                </option>
            @endforeach

        </select>

    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Fee</label>
        <input type="number"
               step="0.01"
               name="fee"
               class="form-control">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Start Date</label>
        <input type="date"
               name="start_date"
               class="form-control">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>End Date</label>
        <input type="date"
               name="end_date"
               class="form-control">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Description</label>
        <textarea name="description"
                  rows="4"
                  class="form-control"></textarea>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Status</label>

        <select name="status" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>
</div>

</div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">
        Save Course
    </button>
</div>

</form>

</div>

</div>

</section>

</div>

@endsection