@extends('layouts.app')

@section('title', 'Admission Report')

@section('content')
<div class="container-fluid">

    <h4>Admission Summary</h4>

    <div class="row">

        <div class="col-md-3">
            <div class="card p-3 bg-light">
                <h5>Total</h5>
                <h3>{{ $total }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h5>Pending</h5>
                <h3>{{ $pending }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h5>Approved</h5>
                <h3>{{ $approved }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h5>Rejected</h5>
                <h3>{{ $rejected }}</h3>
            </div>
        </div>

        <div class="col-md-3 mt-3">
            <div class="card p-3">
                <h5>Waitlist</h5>
                <h3>{{ $waitlist }}</h3>
            </div>
        </div>

    </div>

</div>
@endsection