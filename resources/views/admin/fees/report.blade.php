@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h4 class="mb-4">Monthly Collection Report</h4>

    <div class="row">

        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6>Total Fee</h6>
                    <h3>₹{{ number_format($totalFee,2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Total Collected</h6>
                    <h3>₹{{ number_format($totalCollected,2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h6>Pending Fee</h6>
                    <h3>₹{{ number_format($pendingFee,2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-body">
                    <h6>Collection %</h6>
                    <h3>{{ $percentage }}%</h3>
                </div>
            </div>
        </div>

    </div>

   

</div>

@endsection