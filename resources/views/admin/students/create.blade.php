@extends('layouts.app')

@section('title', 'Create Student')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 font-weight-bold text-dark">
                <i class="fas fa-user-plus"></i> Add New Student
            </h1>
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

    <form action="{{ route('admin.students.store') }}" method="POST" id="studentForm">
        @csrf

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
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" placeholder="10-digit number">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            <small class="form-text text-muted">Minimum 8 characters</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                           id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
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
                                        <option value="male" @if(old('gender') === 'male') selected @endif>Male</option>
                                        <option value="female" @if(old('gender') === 'female') selected @endif>Female</option>
                                        <option value="other" @if(old('gender') === 'other') selected @endif>Other</option>
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
                            <label for="roll_number" class="form-label">Roll Number *</label>
                            <input type="text" class="form-control @error('roll_number') is-invalid @enderror" 
                                   id="roll_number" name="roll_number" value="{{ old('roll_number') }}" required>
                            @error('roll_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="registration_number" class="form-label">Registration Number *</label>
                            <input type="text" class="form-control @error('registration_number') is-invalid @enderror" 
                                   id="registration_number" name="registration_number" value="{{ old('registration_number') }}" required>
                            @error('registration_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="admission_date" class="form-label">Admission Date *</label>
                            <input type="date" class="form-control @error('admission_date') is-invalid @enderror" 
                                   id="admission_date" name="admission_date" value="{{ old('admission_date') }}" required>
                            @error('admission_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> <strong>Note:</strong> Student account will be created with "Active" status.
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
                                   id="father_name" name="father_name" value="{{ old('father_name') }}">
                            @error('father_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                                   id="mother_name" name="mother_name" value="{{ old('mother_name') }}">
                            @error('mother_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="parent_phone" class="form-label">Parent/Guardian Phone</label>
                            <input type="tel" class="form-control @error('parent_phone') is-invalid @enderror" 
                                   id="parent_phone" name="parent_phone" value="{{ old('parent_phone') }}">
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
                                      id="address" name="address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                           id="city" name="city" value="{{ old('city') }}">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                           id="state" name="state" value="{{ old('state') }}">
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                   id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
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
                            <i class="fas fa-save"></i> Create Student
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
