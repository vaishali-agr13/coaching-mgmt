@extends('layouts.app')

@section('content')

<table class="table">

    <thead>
        <tr>
            <th>Student Name</th>
            <th>Course Name</th>

            <th>Fee Amount</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
             <th>Payment Date</th>
              <th>Payment Mode</th>
            <th>Fee Type</th>
            <th>Transaction Id</th>
             <th>Status</th>

        </tr>
    </thead>

    <tbody>

    @forelse($fees as $fee)

        <tr>

            <td>
                {{ $fee->student->user->name ?? 'N/A' }}
            </td>
            <td>{{ $fee->course->course_name ?? 'N/A' }}</td>

            <td>{{ $fee->fee_amount }}</td>

            <td>{{ $fee->paid_amount }}</td>

            <td>{{ $fee->due_amount }}</td>

            <td>{{ $fee->payment_date }}</td>

            <td>{{ $fee->payment_mode }}</td>

             <td>{{ $fee->fee_type }}</td>
               <td>{{ $fee->transaction_id }}</td>

            <td>{{ ucfirst($fee->status) }}</td>

        </tr>

    @empty

        <tr>
            <td colspan="4">No fees found</td>
        </tr>

    @endforelse

    </tbody>

</table>
@endsection