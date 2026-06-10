@extends('layouts.app')

@section('title', 'Create Faculty')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Add Faculty</h4>
        <a href="{{ route('admin.faculty.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.faculty.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    {{-- User ID --}}
                    <div class="col-md-4">
                        <label class="form-label">User</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Employee ID --}}
                    <div class="col-md-4">
                        <label class="form-label">Employee ID</label>
                        <input type="text" name="employee_id" class="form-control" placeholder="EMP001">
                    </div>

                    {{-- Department --}}
                    <div class="col-md-4">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" placeholder="Computer Science">
                    </div>

                    {{-- Specialization --}}
                    <div class="col-md-4">
                        <label class="form-label">Specialization</label>
                        <input type="text" name="specialization" class="form-control">
                    </div>

                    {{-- Qualification --}}
                    <div class="col-md-4">
                        <label class="form-label">Qualification</label>
                        <input type="text" name="qualification" class="form-control">
                    </div>

                    {{-- Experience --}}
                    <div class="col-md-4">
                        <label class="form-label">Experience (Years)</label>
                        <input type="number" name="experience_years" class="form-control">
                    </div>

                    {{-- Joining Date --}}
                    <div class="col-md-4">
                        <label class="form-label">Joining Date</label>
                        <input type="date" name="joining_date" class="form-control">
                    </div>

                    {{-- Salary --}}
                    <div class="col-md-4">
                        <label class="form-label">Salary</label>
                        <input type="number" name="salary" class="form-control">
                    </div>

                    {{-- Office Hours --}}
                    <div class="col-md-4">
                        <label class="form-label">Office Hours</label>
                        <input type="text" name="office_hours" class="form-control" placeholder="10AM - 4PM">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    {{-- Bio --}}
                    <div class="col-md-12">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3"></textarea>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Save Faculty
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection