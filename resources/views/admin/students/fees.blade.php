@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Fee Records</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($student->fees as $fee)

                <tr>
                    <td>{{ $fee->fee_type }}</td>
                    <td>₹ {{ $fee->amount }}</td>
                    <td>₹ {{ $fee->paid_amount }}</td>
                    <td>{{ ucfirst($fee->status) }}</td>
                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center">
                        No Fee Record Found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection