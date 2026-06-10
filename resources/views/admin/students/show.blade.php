@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 font-weight-bold text-dark">
                <i class="fas fa-user-circle"></i> Student Profile
            </h1>
        </div>
        <div class="col-md-4">
            <div class="btn-group float-end" role="group">
                <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button type="button" class="btn btn-danger" onclick="deleteStudent({{ $student->id }})">
                    <i class="fas fa-trash"></i> Delete
                </button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Personal Information Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->user->name) }}&background=667eea&color=fff&size=128" 
                             alt="Avatar" class="rounded-circle" width="100" height="100">
                    </div>
                    <h5 class="text-center mb-1">{{ $student->user->name }}</h5>
                    <p class="text-center text-muted mb-3">{{ $student->user->email }}</p>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Email</label>
                        <p class="mb-0">
                            <a href="mailto:{{ $student->user->email }}">
                                {{ $student->user->email }}
                            </a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Phone</label>
                        <p class="mb-0">
                            @if($student->user->phone)
                                <a href="tel:{{ $student->user->phone }}">
                                    {{ $student->user->phone }}
                                </a>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Date of Birth</label>
                        <p class="mb-0">
                            @if($student->date_of_birth)
                                {{ \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') }}
                                <small class="text-muted">(Age: {{ \Carbon\Carbon::parse($student->date_of_birth)->age }})</small>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Gender</label>
                        <p class="mb-0">
                            @if($student->gender)
                                <span class="badge bg-info">{{ ucfirst($student->gender) }}</span>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Status</label>
                        <p class="mb-0">
                            @if($student->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($student->status === 'inactive')
                                <span class="badge bg-warning">Inactive</span>
                            @elseif($student->status === 'graduated')
                                <span class="badge bg-info">Graduated</span>
                            @else
                                <span class="badge bg-danger">Dropped</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Information Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Academic Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small">Roll Number</label>
                        <p class="mb-0">
                            <span class="badge bg-info">{{ $student->roll_number }}</span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Registration Number</label>
                        <p class="mb-0">{{ $student->registration_number }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Admission Date</label>
                        <p class="mb-0">
                            @if($student->admission_date)
                                {{ \Carbon\Carbon::parse($student->admission_date)->format('d M Y') }}
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Total Courses Enrolled</label>
                        <p class="mb-0">
                            <h4 class="text-primary">{{ $student->enrollments->count() }}</h4>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Exams Taken</label>
                        <p class="mb-0">
                            <h4 class="text-info">{{ $student->examResults->count() }}</h4>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Average Score</label>
                        <p class="mb-0">
                            @php
                                $avgScore = $student->examResults->avg('percentage');
                            @endphp
                            @if($avgScore)
                                <h4 class="text-success">{{ round($avgScore, 2) }}%</h4>
                            @else
                                <span class="text-muted">No exams taken yet</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parent/Guardian Information Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Parent/Guardian</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small">Father's Name</label>
                        <p class="mb-0">
                            @if($student->father_name)
                                {{ $student->father_name }}
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Mother's Name</label>
                        <p class="mb-0">
                            @if($student->mother_name)
                                {{ $student->mother_name }}
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Guardian Phone</label>
                        <p class="mb-0">
                            @if($student->parent_phone)
                                <a href="tel:{{ $student->parent_phone }}">
                                    {{ $student->parent_phone }}
                                </a>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                     
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-users"></i>  Assign Course</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                           <form id="assignCourseForm" action="{{ route('admin.students.assignCourse', $student->id) }}"
                        method="POST">

                        @csrf

                        <select name="course_id" id="course_id" class="form-control">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary mt-2">
                            Assign Course
                        </button>

                    </form>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- Address Information Card -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Address Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Address</label>
                                <p class="mb-0">
                                    @if($student->address)
                                        {{ $student->address }}
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label text-muted small">City</label>
                                <p class="mb-0">
                                    @if($student->city)
                                        {{ $student->city }}
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label text-muted small">State</label>
                                <p class="mb-0">
                                    @if($student->state)
                                        {{ $student->state }}
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Postal Code</label>
                                <p class="mb-0">
                                    @if($student->postal_code)
                                        {{ $student->postal_code }}
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Enrollments Tab -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-book"></i> Course Enrollments ({{ $student->enrollments->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($student->enrollments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Course Code</th>
                                        <th>Enrollment Date</th>
                                        <th>Status</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->enrollments as $enrollment)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.courses.show', $enrollment->course->id) }}" class="text-decoration-none">
                                                    {{ $enrollment->course->course_name }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $enrollment->course->course_code }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d M Y') }}</td>
                                            <td>
                                                @if($enrollment->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif($enrollment->status === 'completed')
                                                    <span class="badge bg-info">Completed</span>
                                                @else
                                                    <span class="badge bg-warning">{{ ucfirst($enrollment->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($enrollment->grade)
                                                    <span class="badge bg-primary">{{ $enrollment->grade }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">No course enrollments yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Results Tab -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Exam Results ({{ $student->examResults->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($student->examResults->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Exam Code</th>
                                        <th>Exam Date</th>
                                        <th>Marks</th>
                                        <th>Percentage</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->examResults as $result)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.exams.show', $result->exam->id) }}" class="text-decoration-none">
                                                    {{ $result->exam->exam_name }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $result->exam->exam_code }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($result->exam->exam_date)->format('d M Y') }}</td>
                                            <td>
                                                {{ $result->marks_obtained }} / {{ $result->total_marks }}
                                            </td>
                                            <td>
                                                <strong>{{ round($result->percentage, 2) }}%</strong>
                                            </td>
                                            <td>
                                                @php
                                                    $gradeColor = match($result->grade) {
                                                        'A+' => 'success',
                                                        'A' => 'success',
                                                        'B' => 'info',
                                                        'C' => 'warning',
                                                        'D' => 'warning',
                                                        'F' => 'danger',
                                                        default => 'secondary'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $gradeColor }}">{{ $result->grade }}</span>
                                            </td>
                                            <td>
                                                @if($result->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif($result->status === 'evaluated')
                                                    <span class="badge bg-info">Evaluated</span>
                                                @else
                                                    <span class="badge bg-warning">{{ ucfirst($result->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">No exam results yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Fee Information Tab -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-credit-card"></i> Fee Information</h5>
                </div>
                <div class="card-body">
                    @if($student->fees->count() > 0)
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Total Dues</h6>
                                        <h3 class="text-danger">₹{{ number_format($student->fees->sum('fee_amount'), 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Paid</h6>
                                        <h3 class="text-success">₹{{number_format($student->fees->sum('paid_amount'), 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Pending</h6>
                                        <h3 class="text-warning">₹{{ number_format($student->fees->sum('fee_amount') - $student->fees->sum('paid_amount'), 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Total Fees</h6>
                                        <h3 class="text-info">{{ $student->fees->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course</th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>Due Date</th>
                                        <th>Paid</th>
                                        <th>Pending</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->fees as $fee)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.courses.show', $fee->course->id) }}" class="text-decoration-none">
                                                    {{ $fee->course->course_name }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ ucfirst($fee->fee_type) }}</span>
                                            </td>
                                            <td>₹{{ number_format($fee->fee_amount, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($fee->due_date)->format('d M Y') }}</td>
                                            <td>₹{{ number_format($fee->paid_amount, 2) }}</td>
                                            <td>₹{{ number_format($fee->fee_amount - $fee->paid_amount, 2) }}</td>
                                            <td>
                                                @if($fee->status === 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif($fee->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($fee->status === 'partial')
                                                    <span class="badge bg-info">Partial</span>
                                                @elseif($fee->status === 'overdue')
                                                    <span class="badge bg-danger">Overdue</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($fee->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.fees.show', $fee->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">No fee records yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Tab -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Attendance ({{ $student->attendance->count() }} records)</h5>
                </div>
                <div class="card-body">
                    @if($student->attendance->count() > 0)
                        @php
                            $totalAttendance = $student->attendance->count();
                            $presentDays = $student->attendance->where('status', 'present')->count();
                            $absentDays = $student->attendance->where('status', 'absent')->count();
                            $lateDays = $student->attendance->where('status', 'late')->count();
                            $attendancePercentage = ($presentDays / $totalAttendance) * 100;
                        @endphp

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Attendance %</h6>
                                        <h3 class="text-primary">{{ round($attendancePercentage, 2) }}%</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Present</h6>
                                        <h3 class="text-success">{{ $presentDays }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Absent</h6>
                                        <h3 class="text-danger">{{ $absentDays }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Late</h6>
                                        <h3 class="text-warning">{{ $lateDays }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Marked By</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->attendance->sortByDesc('attendance_date')->take(20) as $attendance)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.courses.show', $attendance->course->id) }}" class="text-decoration-none">
                                                    {{ $attendance->course->course_name }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($attendance->status === 'present')
                                                    <span class="badge bg-success">Present</span>
                                                @elseif($attendance->status === 'absent')
                                                    <span class="badge bg-danger">Absent</span>
                                                @elseif($attendance->status === 'late')
                                                    <span class="badge bg-warning">Late</span>
                                                @else
                                                    <span class="badge bg-info">{{ ucfirst($attendance->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($attendance->marked_by)
                                                    {{ $attendance->marked_by->user->name ?? 'N/A' }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($attendance->remarks)
                                                    <small>{{ $attendance->remarks }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($student->attendance->count() > 20)
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.attendance.student', $student->id) }}" class="btn btn-primary btn-sm">
                                    View All Attendance Records
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">No attendance records yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
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
                <p class="text-danger"><strong>Warning:</strong> All associated records will also be deleted.</p>
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
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border-radius: 0.35rem;
    }

    .card-header {
        border-bottom: 1px solid #e3e6f0;
        border-radius: 0.35rem 0.35rem 0 0;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        padding: 0.5rem 0.75rem;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    h5 {
        font-weight: 600;
    }
</style>

<script>
    function deleteStudent(studentId) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/students/${studentId}`;
        deleteModal.show();
    }

    //for assigned duplicate course 
    const assignedCourses = @json($assignedCourses);
    document.getElementById('assignCourseForm')
        .addEventListener('submit', function(e) {

            let courseId = parseInt(
                document.getElementById('course_id').value
            );

            if (assignedCourses.includes(courseId)) {
                e.preventDefault();
                alert('This course is already assigned.');
            }
    });

</script>
@endsection
