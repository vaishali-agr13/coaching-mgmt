@extends('layouts.app')

@section('title', 'Reports Dashboard')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Reports & Analytics</h3>

    <div class="row">

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reports.studentPerformance') }}" class="btn btn-primary w-100">
                Student Performance
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reports.courseAnalytics') }}" class="btn btn-success w-100">
                Course Analytics
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reports.facultyPerformance') }}" class="btn btn-info w-100">
                Faculty Performance
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reports.feeCollection') }}" class="btn btn-warning w-100">
                Fee Collection
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reports.attendance') }}" class="btn btn-secondary w-100">
                Attendance Report
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reports.admission') }}" class="btn btn-dark w-100">
                Admission Report
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.reports.examResults') }}" class="btn btn-danger w-100">
                Exam Results
            </a>
        </div>

    </div>
</div>
@endsection