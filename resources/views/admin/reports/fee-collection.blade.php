@extends('layouts.app')

@section('content')

<h3>Fee Collection Report</h3>

<div class="row">

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                Total Fee<br>
                ₹{{ $totalFee }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                Collected<br>
                ₹{{ $totalCollected }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                Pending<br>
                ₹{{ $pendingFee }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                Collection %<br>
                {{ $collectionPercentage }}%
            </div>
        </div>
    </div>

</div>

@endsection