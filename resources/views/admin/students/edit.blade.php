@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 font-weight-bold text-dark">
                <i class="fas fa-user-edit"></i> Edit Student
            </h1>
            <p class="text-muted">Update student information</p>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary float-end">
                <i class="fas fa-arrow-left"></i> Back to Students
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Validation Errors</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST" id="studentForm">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Personal Information -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $student->user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $student->user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $student->user->phone) }}" placeholder="10-digit number">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                           id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                        <option value="">-- Select Gender --</option>
                                        <option value="male" @if(old('gender', $student->gender) === 'male') selected @endif>Male</option>
                                        <option value="female" @if(old('gender', $student->gender) === 'female') selected @endif>Female</option>
                                        <option value="other" @if(old('gender', $student->gender) === 'other') selected @endif>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Academic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="roll_number" class="form-label">Roll Number</label>
                            <input type="text" class="form-control" id="roll_number" 
                                   value="{{ $student->roll_number }}" disabled>
                            <small class="text-muted">Roll number cannot be changed</small>
                        </div>

                        <div class="mb-3">
                            <label for="registration_number" class="form-label">Registration Number</label>
                            <input type="text" class="form-control" id="registration_number" 
                                   value="{{ $student->registration_number }}" disabled>
                            <small class="text-muted">Registration number cannot be changed</small>
                        </div>

                        <div class="mb-3">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <input type="date" class="form-control" id="admission_date" 
                                   value="{{ $student->admission_date }}" disabled>
                            <small class="text-muted">Admission date cannot be changed</small>
                        </div>

                        <!-- Status Update -->
                        <div class="mb-3 mt-4">
                            <h6 class="mb-3">Update Status</h6>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="status" id="active" 
                                       value="active" @if($student->status === 'active') checked @endif>
                                <label class="btn btn-outline-success" for="active">Active</label>

                                <input type="radio" class="btn-check" name="status" id="inactive" 
                                       value="inactive" @if($student->status === 'inactive') checked @endif>
                                <label class="btn btn-outline-warning" for="inactive">Inactive</label>

                                <input type="radio" class="btn-check" name="status" id="graduated" 
                                       value="graduated" @if($student->status === 'graduated') checked @endif>
                                <label class="btn btn-outline-info" for="graduated">Graduated</label>

                                <input type="radio" class="btn-check" name="status" id="dropped" 
                                       value="dropped" @if($student->status === 'dropped') checked @endif>
                                <label class="btn btn-outline-danger" for="dropped">Dropped</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parent/Guardian Information -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-users"></i> Parent/Guardian Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="father_name" class="form-label">Father's Name</label>
                            <input type="text" class="form-control @error('father_name') is-invalid @enderror" 
                                   id="father_name" name="father_name" value="{{ old('father_name', $student->father_name) }}">
                            @error('father_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                                   id="mother_name" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}">
                            @error('mother_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="parent_phone" class="form-label">Parent/Guardian Phone</label>
                            <input type="tel" class="form-control @error('parent_phone') is-invalid @enderror" 
                                   id="parent_phone" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}">
                            @error('parent_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Address Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                           id="city" name="city" value="{{ old('city', $student->city) }}">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                           id="state" name="state" value="{{ old('state', $student->state) }}">
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                   id="postal_code" name="postal_code" value="{{ old('postal_code', $student->postal_code) }}">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-save"></i> Update Student
                        </button>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border-radius: 0.35rem;
        margin-bottom: 2rem;
    }

    .card-header {
        border-bottom: 1px solid #e3e6f0;
        border-radius: 0.35rem 0.35rem 0 0;
    }

    .form-control, .form-select {
        border-radius: 0.25rem;
        border: 1px solid #ddd;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-control:disabled {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }

    .btn-group {
        gap: 0.5rem;
    }

    .btn-check {
        display: none;
    }

    .btn-check:checked + .btn {
        border-color: currentColor;
        background-color: rgba(102, 126, 234, 0.1);
    }
</style>

<script>
    // Form validation
    document.getElementById('studentForm').addEventListener('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        this.classList.add('was-validated');
    });
</script>
@endsection
