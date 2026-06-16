@extends('layouts.app')

@section('title','Student Dashboard')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">
        Student Dashboard
    </h3>

    {{-- Statistics Cards --}}

    <div class="row mb-4">

    <div class="col-md-3 mb-3">

        <div class="card bg-primary text-white shadow border-0">

            <div class="card-body text-center">

                <h6>Total Subjects</h6>

                <h3>{{ $studentStats['total_subjects'] ?? 0 }}</h3>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-success text-white shadow border-0">

            <div class="card-body text-center">

                <h6>Attendance %</h6>

                <h3>{{ round($studentStats['attendance_percentage'] ?? 0) }}%</h3>

            </div>

        </div>

    </div>

    <!-- <div class="col-md-3 mb-3">

        <div class="card bg-warning text-dark shadow border-0">

            <div class="card-body text-center">

                <h6>Pending Homework</h6>

                <h3>{{ $studentStats['pending_homeworks'] ?? 0 }}</h3>

            </div>

        </div>

    </div> -->

    <div class="col-md-3 mb-3">

        <div class="card bg-danger text-white shadow border-0">

            <div class="card-body text-center">

                <h6>Upcoming Exams</h6>

                <h3>{{ $studentStats['upcoming_exams'] ?? 0 }}</h3>

            </div>

        </div>

    </div>

</div>





    {{-- Attendance --}}

    <div class="card mb-4">

        <div class="card-header">

            Attendance

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Date</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($attendance as $item)

                    <tr>

                        <td>

                            {{ $item->attendance_date }}

                        </td>

                        <td>

                            {{ ucfirst($item->status) }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="2">

                            No Records Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>







    {{-- Fees --}}

    <div class="card mb-4">

        <div class="card-header">

            Fees

        </div>

        <div class="card-body">
           <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Course</th>

                            <th>Fee Type</th>

                            <th>Total Fee</th>

                            <th>Paid Amount</th>

                            <th>Due Amount</th>

                            <th>Payment Date</th>

                            <th>Payment Mode</th>

                            <th>Transaction ID</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($fees as $key => $fee)

                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <td>{{ $fee->course->course_name ?? '-' }}</td>

                            <td>{{ $fee->fee_type ?? '-' }}</td>

                            <td>₹{{ number_format($fee->fee_amount, 2) }}</td>

                            <td>₹{{ number_format($fee->paid_amount, 2) }}</td>

                            <td>₹{{ number_format($fee->due_amount, 2) }}</td>

                            <td>{{ $fee->payment_date ?? '-' }}</td>

                            <td>{{ ucfirst($fee->payment_mode ?? '-') }}</td>

                            <td>{{ $fee->transaction_id ?? '-' }}</td>

                            <td>

                                @if($fee->status == 'paid')

                                    <span class="badge bg-success">Paid</span>

                                @elseif($fee->status == 'pending')

                                    <span class="badge bg-warning text-dark">Pending</span>

                                @elseif($fee->status == 'partial')

                                    <span class="badge bg-info">Partial</span>

                                @else

                                    <span class="badge bg-danger">

                                        {{ ucfirst($fee->status) }}

                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="10" class="text-center">

                                No fee records found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

           </div>
        </div>

    </div>

    {{-- Study Material --}}

    <div class="card mb-4">

        <div class="card-header">

            Study Material

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Title</th>

                        <th>Material Code</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($studyMaterials as $material)

                    <tr>

                        <td>

                            {{ $material->title }}

                        </td>

                        <td>

                            {{ $material->material_code ?? '-' }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="2">

                            No Study Material

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>







    {{-- Upcoming Exams --}}

    <div class="card mb-4">

        <div class="card-header">

            Upcoming Exams

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>Course</th>
                        <th>Exam Name</th>
                       
                        <th>Exam Code</th>
                        <th>Exam Type</th>
                        <th>Exam Date</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($upcomingExams as $exam)

                    <tr>
                        <td>{{ $exam->course->course_name }}</td>

                        <td>

                            {{ $exam->exam_name }}

                        </td>
                        <td>

                            {{ $exam->exam_code }}

                        </td>
                        <td>

                            {{ $exam->exam_type}}

                        </td>

                        <td>

                            {{ $exam->exam_date }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="2">

                            No Upcoming Exams

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>







    {{-- Results --}}

    <div class="card mb-4">

        <div class="card-header">

            Results

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Exam</th>

                        <th>Marks Obtained</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($results as $result)

                    <tr>

                        <td>

                            {{ $result->exam->exam_name }}

                        </td>

                        <td>

                            {{ $result->marks_obtained }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="2">

                            No Result Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection