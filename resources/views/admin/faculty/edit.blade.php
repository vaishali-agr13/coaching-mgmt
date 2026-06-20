@extends('layouts.app')


@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Faculty</h4>
        <a href="{{ route('admin.faculty.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.faculty.update', $faculty->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- User --}}
                    <div class="col-md-4">
                        <label class="form-label">User</label>
                        <select name="user_id" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ $faculty->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Employee ID --}}
                    <div class="col-md-4">
                        <label class="form-label">Employee ID</label>
                        <input type="text" name="employee_id" class="form-control"
                               value="{{ $faculty->employee_id }}">
                    </div>

                    {{-- Department --}}
                    <div class="col-md-4">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control"
                               value="{{ $faculty->department }}">
                    </div>

                    {{-- Specialization --}}
                    <div class="col-md-4">
                        <label class="form-label">Specialization</label>
                        <input type="text" name="specialization" class="form-control"
                               value="{{ $faculty->specialization }}">
                    </div>

                    @if($faculty->faculty_image)

                        <div class="mt-2">

                            <img src="{{ asset('public/uploads/faculty/'.$faculty->faculty_image) }}"
                                alt="Faculty Image"
                                 style="width:120px; height:120px; object-fit:cover; border-radius:10px;"
                                class="faculty-preview">

                        </div>

                    @endif
                    <div class="col-md-4">

                        <label class="form-label">Faculty Image</label>

                        <input type="file"
                            name="faculty_image"
                            class="form-control"
                            accept="image/*">

                    </div>

                    {{-- Qualification --}}
                    <div class="col-md-4">
                        <label class="form-label">Qualification</label>
                        <input type="text" name="qualification" class="form-control"
                               value="{{ $faculty->qualification }}">
                    </div>

                    {{-- Experience --}}
                    <div class="col-md-4">
                        <label class="form-label">Experience (Years)</label>
                        <input type="number" name="experience_years" class="form-control"
                               value="{{ $faculty->experience_years }}">
                    </div>

                    {{-- Joining Date --}}
                    <div class="col-md-4">
                        <label class="form-label">Joining Date</label>
                        <input type="date" name="joining_date" class="form-control"
                               value="{{ $faculty->joining_date }}">
                    </div>

                    {{-- Salary --}}
                    <div class="col-md-4">
                        <label class="form-label">Salary</label>
                        <input type="number" name="salary" class="form-control"
                               value="{{ $faculty->salary }}">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $faculty->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $faculty->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Office Hours --}}
                    <div class="col-md-4">
                        <label class="form-label">Office Hours</label>
                        <input type="text" name="office_hours" class="form-control"
                               value="{{ $faculty->office_hours }}">
                    </div>

                    {{-- Bio --}}
                    <div class="col-md-12">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3">{{ $faculty->bio }}</textarea>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        Update Faculty
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection