@extends('layouts.app')

@section('title', 'Student Fees')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Fee Details - {{ $student->user->name }}</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">

                <div class="col-md-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>₹{{ number_format($totalFee, 2) }}</h3>
                            <p>Total Fee</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>₹{{ number_format($totalPaid, 2) }}</h3>
                            <p>Total Paid</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>₹{{ number_format($pending, 2) }}</h3>
                            <p>Pending Fee</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fee Records</h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Fee Type</th>
                                <th>Total Fee</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($fees as $fee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $fee->course->course_name ?? 'N/A' }}</td>
                                <td>{{ ucfirst($fee->fee_type) }}</td>
                                <td>₹{{ number_format($fee->fee_amount, 2) }}</td>
                                <td>₹{{ number_format($fee->payments->sum('amount_paid'), 2) }}</td>
                                <td>₹{{ number_format($fee->due_amount, 2) }}</td>
                                <td>
                                    @if($fee->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($fee->status == 'partial')
                                        <span class="badge bg-warning text-dark">Partial</span>
                                    @else
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    No Fee Records Found
                                </td>
                            </tr>
                        @endforelse

                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection