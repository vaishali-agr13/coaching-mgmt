@extends('layouts.app')

@section('title', 'Edit Fee')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Edit Fee Record</h1>
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

    <section class="content">

        <div class="container-fluid">

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
                        Update Fee Details
                    </h3>
                </div>

                <form action="{{ route('admin.fees.update', $fee->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row">

                            {{-- Student --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student <span class="text-danger">*</span></label>

                                    <select name="student_id"
                                            class="form-control"
                                            required>

                                        <option value="">Select Student</option>

                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}"
                                                {{ $fee->student_id == $student->id ? 'selected' : '' }}>

                                                {{ $student->user->name ?? '' }}
                                                ({{ $student->roll_number ?? '' }})

                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            {{-- Course --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Course <span class="text-danger">*</span></label>

                                    <select name="course_id"
                                            class="form-control"
                                            required>

                                        <option value="">Select Course</option>

                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ $fee->course_id == $course->id ? 'selected' : '' }}>

                                                {{ $course->course_name }}

                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            {{-- Fee Type --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Fee Type</label>

                                    <select name="fee_type"
                                            class="form-control">

                                        <option value="tuition"
                                            {{ $fee->fee_type=='tuition' ? 'selected':'' }}>
                                            Tuition Fee
                                        </option>

                                        <option value="exam"
                                            {{ $fee->fee_type=='exam' ? 'selected':'' }}>
                                            Exam Fee
                                        </option>

                                        <option value="library"
                                            {{ $fee->fee_type=='library' ? 'selected':'' }}>
                                            Library Fee
                                        </option>

                                        <option value="lab"
                                            {{ $fee->fee_type=='lab' ? 'selected':'' }}>
                                            Lab Fee
                                        </option>

                                        <option value="activity"
                                            {{ $fee->fee_type=='activity' ? 'selected':'' }}>
                                            Activity Fee
                                        </option>

                                        <option value="other"
                                            {{ $fee->fee_type=='other' ? 'selected':'' }}>
                                            Other
                                        </option>

                                    </select>

                                </div>
                            </div>

                            {{-- Payment Date --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Payment Date</label>

                                    <input type="date"
                                           name="payment_date"
                                           class="form-control"
                                           value="{{ $fee->payment_date ? date('Y-m-d', strtotime($fee->payment_date)) : '' }}">

                                </div>
                            </div>

                            {{-- Fee Amount --}}
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label>Total Fee Amount</label>

                                    <input type="number"
                                           step="0.01"
                                           name="fee_amount"
                                           id="fee_amount"
                                           class="form-control"
                                           value="{{ $fee->fee_amount }}">

                                </div>
                            </div>

                            {{-- Paid Amount --}}
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label>Paid Amount</label>

                                    <input type="number"
                                           step="0.01"
                                           name="paid_amount"
                                           id="paid_amount"
                                           class="form-control"
                                           value="{{ $fee->paid_amount }}">

                                </div>
                            </div>

                            {{-- Due Amount --}}
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label>Due Amount</label>

                                    <input type="number"
                                           step="0.01"
                                           name="due_amount"
                                           id="due_amount"
                                           class="form-control"
                                           value="{{ $fee->due_amount }}"
                                           readonly>

                                </div>
                            </div>

                            {{-- Payment Mode --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Payment Mode</label>

                                    <select name="payment_mode"
                                            class="form-control">

                                        <option value="Cash" {{ $fee->payment_mode=='Cash' ? 'selected':'' }}>Cash</option>

                                        <option value="UPI" {{ $fee->payment_mode=='UPI' ? 'selected':'' }}>UPI</option>

                                        <option value="Bank Transfer" {{ $fee->payment_mode=='Bank Transfer' ? 'selected':'' }}>Bank Transfer</option>

                                        <option value="Cheque" {{ $fee->payment_mode=='Cheque' ? 'selected':'' }}>Cheque</option>

                                    </select>

                                </div>
                            </div>

                            {{-- Transaction ID --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Transaction ID</label>

                                    <input type="text"
                                           name="transaction_id"
                                           class="form-control"
                                           value="{{ $fee->transaction_id }}">

                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Status</label>

                                    <select name="status"
                                            class="form-control">

                                        <option value="paid"
                                            {{ $fee->status=='paid' ? 'selected':'' }}>
                                            Paid
                                        </option>

                                        <option value="partial"
                                            {{ $fee->status=='partial' ? 'selected':'' }}>
                                            Partial
                                        </option>

                                        <option value="pending"
                                            {{ $fee->status=='pending' ? 'selected':'' }}>
                                            Pending
                                        </option>

                                    </select>

                                </div>
                            </div>

                            {{-- Remarks --}}
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>Remarks</label>

                                    <textarea name="remarks"
                                              rows="4"
                                              class="form-control">{{ $fee->remarks }}</textarea>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Fee
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

function calculateDue()
{
    let fee = parseFloat(document.getElementById('fee_amount').value) || 0;
    let paid = parseFloat(document.getElementById('paid_amount').value) || 0;

    document.getElementById('due_amount').value = (fee - paid).toFixed(2);
}

document.getElementById('fee_amount').addEventListener('keyup', calculateDue);
document.getElementById('paid_amount').addEventListener('keyup', calculateDue);

document.getElementById('fee_amount').addEventListener('change', calculateDue);
document.getElementById('paid_amount').addEventListener('change', calculateDue);

</script>

@endsection