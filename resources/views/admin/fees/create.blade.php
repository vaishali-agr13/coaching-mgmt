@extends('layouts.app')

@section('title', 'Collect Fee')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Collect Student Fee</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.fees.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-money-bill-wave"></i>
                        Fee Collection Form
                    </h3>
                </div>

                <form action="{{ route('admin.fees.store') }}" method="POST">

                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <!-- Student -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Student <span class="text-danger">*</span>
                                    </label>

                                    <select name="student_id"
                                            class="form-control"
                                            required>

                                        <option value="">
                                            Select Student
                                        </option>

                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}"
                                                {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                                {{ $student->user->name ?? '' }}
                                                ({{ $student->roll_number ?? 'N/A' }})

                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <!-- Course -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Course <span class="text-danger">*</span>
                                    </label>

                                    <select name="course_id"
                                            class="form-control"
                                            required>

                                        <option value="">
                                            Select Course
                                        </option>

                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ old('course_id') == $course->id ? 'selected' : '' }}>

                                                {{ $course->course_name }}

                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <!-- Fee Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fee Type</label>

                                    <select name="fee_type" class="form-control">

                                        <option value="tuition">
                                            Tuition Fee
                                        </option>

                                        <option value="exam">
                                            Exam Fee
                                        </option>

                                        <option value="activity">
                                            Activity Fee
                                        </option>

                                        <option value="library">
                                            Library Fee
                                        </option>
                                              <option value="other">
                                            Other Fee
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <!-- Payment Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Date</label>

                                    <input type="date"
                                           name="payment_date"
                                           class="form-control"
                                           value="{{ old('payment_date', date('Y-m-d')) }}">
                                </div>
                            </div>

                            <!-- Total Amount -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        Total Fee Amount
                                    </label>

                                    <input type="number"
                                           step="0.01"
                                           name="fee_amount"
                                           class="form-control"
                                           value="{{ old('fee_amount') }}"
                                           placeholder="Enter Amount">
                                </div>
                            </div>

                            <!-- Paid Amount -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        Paid Amount
                                    </label>

                                    <input type="number"
                                           step="0.01"
                                           name="paid_amount"
                                           class="form-control"
                                           value="{{ old('paid_amount') }}"
                                           placeholder="Enter Paid Amount">
                                </div>
                            </div>

                            <!-- Due Amount -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        Due Amount
                                    </label>

                                    <input type="number"
                                           step="0.01"
                                           id="due_amount"
                                           class="form-control"
                                           name="due_amount"
                                           readonly>
                                </div>
                            </div>

                            <!-- Payment Mode -->
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>
                                        Payment Mode
                                    </label>

                                    <select name="payment_mode"
                                            class="form-control">

                                        <option value="Cash">Cash</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Bank Transfer">
                                            Bank Transfer
                                        </option>
                                        <option value="Cheque">
                                            Cheque
                                        </option>

                                    </select>

                                </div>
                            </div>

                            <!-- Transaction ID -->
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>
                                        Transaction ID
                                    </label>

                                    <input type="text"
                                           name="transaction_id"
                                           class="form-control"
                                           value="{{ old('transaction_id') }}"
                                           placeholder="Enter Transaction ID">

                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Status</label>

                                    <select name="status"
                                            class="form-control">

                                        <option value="paid">
                                            Paid
                                        </option>

                                        <option value="partial">
                                            Partial
                                        </option>

                                        <option value="pending">
                                            Pending
                                        </option>

                                    </select>

                                </div>
                            </div>

                            <!-- Remarks -->
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>Remarks</label>

                                    <textarea name="remarks"
                                              rows="4"
                                              class="form-control"
                                              placeholder="Enter Remarks">{{ old('remarks') }}</textarea>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fas fa-save"></i>
                            Save Fee

                        </button>

                        <a href="{{ route('admin.fees.index') }}"
                           class="btn btn-secondary">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection

@section('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const amount = document.querySelector('[name="fee_amount"]');
    const paid = document.querySelector('[name="paid_amount"]');
    const due = document.getElementById('due_amount');

    function calculateDue()
    {
        let total = parseFloat(amount.value) || 0;
        let paidAmount = parseFloat(paid.value) || 0;

        due.value = (total - paidAmount).toFixed(2);
    }

    amount.addEventListener('keyup', calculateDue);
    paid.addEventListener('keyup', calculateDue);

    amount.addEventListener('change', calculateDue);
    paid.addEventListener('change', calculateDue);

    calculateDue();

});

</script>

@endsection