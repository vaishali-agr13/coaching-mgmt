@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 font-weight-bold text-dark">
                <i class="fas fa-users"></i> Student Management
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Student
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search & Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.students.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email or roll number..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">-- All Status --</option>
                        <option value="active" @if(request('status') === 'active') selected @endif>Active</option>
                        <option value="inactive" @if(request('status') === 'inactive') selected @endif>Inactive</option>
                        <option value="graduated" @if(request('status') === 'graduated') selected @endif>Graduated</option>
                        <option value="dropped" @if(request('status') === 'dropped') selected @endif>Dropped</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary w-100 mt-2">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Students</h5>
                    <h2 class="text-primary">{{ \App\Models\Student::where('status', 'active')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-muted">Inactive</h5>
                    <h2 class="text-warning">{{ \App\Models\Student::where('status', 'inactive')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-muted">Graduated</h5>
                    <h2 class="text-success">{{ \App\Models\Student::where('status', 'graduated')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-muted">Dropped</h5>
                    <h2 class="text-danger">{{ \App\Models\Student::where('status', 'dropped')->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Name</th>
                        <th width="15%">Roll Number</th>
                        <th width="20%">Email</th>
                        <th width="15%">Admission Date</th>
                        <th width="10%">Status</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->user->name) }}&background=667eea&color=fff" 
                                         alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">{{ $student->user->name }}</h6>
                                        <small class="text-muted">{{ $student->registration_number }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $student->roll_number }}</span>
                            </td>
                            <td>
                                <a href="mailto:{{ $student->user->email }}" class="text-decoration-none">
                                    {{ $student->user->email }}
                                </a>
                            </td>
                            <td>
                                <small>{{ $student->admission_date ? \Carbon\Carbon::parse($student->admission_date)->format('d M Y') : 'N/A' }}</small>
                            </td>
                            <td>
                                @if($student->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($student->status === 'inactive')
                                    <span class="badge bg-warning">Inactive</span>
                                @elseif($student->status === 'graduated')
                                    <span class="badge bg-info">Graduated</span>
                                @else
                                    <span class="badge bg-danger">Dropped</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.students.show', $student->id) }}" 
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.students.edit', $student->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="deleteStudent({{ $student->id }})" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox" style="font-size: 3rem;"></i>
                                    <p class="mt-3">No students found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $students->links() }}
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-trash"></i> Delete Student</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this student? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border-radius: 0.35rem;
    }
</style>

<script>
    function deleteStudent(studentId) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/students/${studentId}`;
        deleteModal.show();
    }
</script>
@endsection
