@extends('layouts.app')

@section('title', 'Edit Admission')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5>Edit Admission</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admissions.update', $admission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ $admission->first_name }}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $admission->last_name }}" class="form-control">
                    </div>

                    <div class="col-md-6 mt-2">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $admission->email }}" class="form-control">
                    </div>

                    <div class="col-md-6 mt-2">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{ $admission->phone }}" class="form-control">
                    </div>

                    <div class="col-md-6 mt-2">
                        <label>Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ $admission->date_of_birth }}" class="form-control">
                    </div>

                    <div class="col-md-6 mt-2">
                        <label>Course</label>
                        <select name="applied_course_id" class="form-control">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $admission->applied_course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label>Education Background</label>
                        <textarea name="education_background" class="form-control">{{ $admission->education_background }}</textarea>
                    </div>
                </div>

                <button class="btn btn-primary mt-3">Update</button>
            </form>

        </div>
    </div>

</div>
@endsection