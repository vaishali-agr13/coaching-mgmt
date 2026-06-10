@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Edit Course</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.courses.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="container-fluid">

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-book"></i>
                        Edit Course Information
                    </h3>
                </div>

                <form action="{{ route('admin.courses.update', $course->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row">

                            <!-- Course Code -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Course Code <span class="text-danger">*</span></label>

                                    <input type="text"
                                           name="course_code"
                                           class="form-control"
                                           value="{{ old('course_code', $course->course_code) }}"
                                           required>
                                </div>
                            </div>

                            <!-- Course Name -->
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Course Name <span class="text-danger">*</span></label>

                                    <input type="text"
                                           name="course_name"
                                           class="form-control"
                                           value="{{ old('course_name', $course->course_name) }}"
                                           required>
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>

                                    <input type="text"
                                           name="category"
                                           class="form-control"
                                           value="{{ old('category', $course->category) }}">
                                </div>
                            </div>

                            <!-- Level -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Level</label>

                                    <select name="level"
                                            class="form-control">

                                        <option value="beginner"
                                            {{ $course->level == 'beginner' ? 'selected' : '' }}>
                                            Beginner
                                        </option>

                                        <option value="intermediate"
                                            {{ $course->level == 'intermediate' ? 'selected' : '' }}>
                                            Intermediate
                                        </option>

                                        <option value="advanced"
                                            {{ $course->level == 'advanced' ? 'selected' : '' }}>
                                            Advanced
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <!-- Faculty -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Faculty</label>

                                    <select name="faculty_id"
                                            class="form-control">

                                        <option value="">Select Faculty</option>

                                        @foreach($faculty as $fac)
                                            <option value="{{ $fac->id }}"
                                                {{ $course->faculty_id == $fac->id ? 'selected' : '' }}>
                                                {{ $fac->user->name ?? $fac->employee_id }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <!-- Duration -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Duration (Hours)</label>

                                    <input type="number"
                                           name="duration_hours"
                                           class="form-control"
                                           value="{{ old('duration_hours', $course->duration_hours) }}">
                                </div>
                            </div>

                            <!-- Max Students -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Max Students</label>

                                    <input type="number"
                                           name="max_students"
                                           class="form-control"
                                           value="{{ old('max_students', $course->max_students) }}">
                                </div>
                            </div>

                            <!-- Fee -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Course Fee</label>

                                    <input type="number"
                                           step="0.01"
                                           name="fee"
                                           class="form-control"
                                           value="{{ old('fee', $course->fee) }}">
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>

                                    <input type="date"
                                           name="start_date"
                                           class="form-control"
                                           value="{{ old('start_date', $course->start_date) }}">
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>

                                    <input type="date"
                                           name="end_date"
                                           class="form-control"
                                           value="{{ old('end_date', $course->end_date) }}">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>

                                    <select name="status"
                                            class="form-control">

                                        <option value="active"
                                            {{ $course->status == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="inactive"
                                            {{ $course->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>

                                        <option value="completed"
                                            {{ $course->status == 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>

                                    <textarea name="description"
                                              rows="5"
                                              class="form-control">{{ old('description', $course->description) }}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Course
                        </button>

                        <a href="{{ route('admin.courses.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection