@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 font-weight-bold text-dark mb-0">
                Dashboard
                <small class="text-muted">Welcome back, {{ Auth::user()->name }}!</small>
            </h1>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Students -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Total Students</h6>
                            <h3 class="h3 mb-0">{{ $stats['total_students'] ?? 0 }}</h3>
                        </div>
                        <div class="text-primary" style="font-size: 2.5rem;">
                            👨‍🎓
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Faculty -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Total Faculty</h6>
                            <h3 class="h3 mb-0">{{ $stats['total_faculty'] ?? 0 }}</h3>
                        </div>
                        <div class="text-success" style="font-size: 2.5rem;">
                            👨‍🏫
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Courses -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Total Courses</h6>
                            <h3 class="h3 mb-0">{{ $stats['total_courses'] ?? 0 }}</h3>
                        </div>
                        <div class="text-info" style="font-size: 2.5rem;">
                            📚
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Admissions -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Pending Admissions</h6>
                            <h3 class="h3 mb-0">{{ $stats['pending_admissions'] ?? 0 }}</h3>
                        </div>
                        <div class="text-warning" style="font-size: 2.5rem;">
                            📝
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fee Statistics Row -->
    <div class="row mb-4">
        <!-- Total Revenue -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-info">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Total Revenue</h6>
                    <h3 class="h3 mb-0">₹{{ number_format($stats['total_revenue'] ?? 0, 2) }}</h3>
                    <small class="text-muted">Year to date</small>
                </div>
            </div>
        </div>

        <!-- Fees Collected -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-success">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Fees Collected</h6>
                    <h3 class="h3 mb-0">₹{{ number_format($feeStatus['total_fee_collected'] ?? 0, 2) }}</h3>
                    <small class="text-muted">{{ $feeStatus['collection_percentage'] ?? 0 }}% collected</small>
                </div>
            </div>
        </div>

        <!-- Pending Fees -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-warning">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Pending Fees</h6>
                    <h3 class="h3 mb-0">₹{{ number_format($stats['pending_fees'] ?? 0, 2) }}</h3>
                    <small class="text-muted">Awaiting payment</small>
                </div>
            </div>
        </div>

        <!-- Admins -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-secondary">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2">Total Admins</h6>
                    <h3 class="h3 mb-0">{{ $stats['total_admins'] ?? 0 }}</h3>
                    <small class="text-muted">Active administrators</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Overview -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Attendance Overview (Today)</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Present</h6>
                            <h3 class="h3 text-success">{{ $attendanceOverview['present_today'] ?? 0 }}</h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Absent</h6>
                            <h3 class="h3 text-danger">{{ $attendanceOverview['absent_today'] ?? 0 }}</h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Late</h6>
                            <h3 class="h3 text-warning">{{ $attendanceOverview['late_today'] ?? 0 }}</h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Average</h6>
                            <h3 class="h3 text-info">{{ $attendanceOverview['average_attendance'] ?? 0 }}%</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fee Collection Progress -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Fee Collection Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Collection Progress</span>
                            <span class="fw-bold">{{ $feeStatus['collection_percentage'] ?? 0 }}%</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-success" style="width: {{ $feeStatus['collection_percentage'] ?? 0 }}%">
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <h6 class="text-muted">Total Due</h6>
                            <h5>₹{{ number_format($feeStatus['total_fee_due'] ?? 0, 2) }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Pending</h6>
                            <h5>₹{{ number_format($feeStatus['pending_fees'] ?? 0, 2) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities and Upcoming Exams -->
    <div class="row">
        <!-- Recent Admissions -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Recent Admissions</h5>
                </div>
                <div class="card-body p-0">
            @if (isset($recentActivities) && isset($recentActivities['recent_admissions']) && count($recentActivities['recent_admissions']) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentActivities['recent_admissions'] as $admission)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">
                                                    {{ $admission->first_name }} {{ $admission->last_name }}
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $admission->application_date ? \Carbon\Carbon::parse($admission->application_date)->format('M d, Y') : 'N/A' }}
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $admission->application_status === 'approved' ? 'success' : ($admission->application_status === 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($admission->application_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center text-muted">
                            No recent admissions
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upcoming Exams -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Upcoming Exams</h5>
                </div>
                <div class="card-body p-0">
                    @if (!empty($upcomingExams) && count($upcomingExams) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($upcomingExams as $exam)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">
                                                    {{ $exam['exam_name'] ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ isset($exam['exam_date']) ? \Carbon\Carbon::parse($exam['exam_date'])->format('M d, Y') : 'N/A' }}
                                                </small>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $exam['start_time'] ?? 'N/A' }} - {{ $exam['end_time'] ?? 'N/A' }}
                                                </small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center text-muted">
                            No upcoming exams
                        </div>
                    @endif
                </div>
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

    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }

    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }

    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }

    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }

    .border-left-secondary {
        border-left: 0.25rem solid #858796 !important;
    }

    .card-header {
        border-bottom: 1px solid #e3e6f0;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection
