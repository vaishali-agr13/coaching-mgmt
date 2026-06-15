@extends('layouts.app')

@section('content')

<h3>Admission Report</h3>

<div class="row">

    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                Total : {{ $total }}
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                Pending : {{ $pending }}
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                Approved : {{ $approved }}
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                Rejected : {{ $rejected }}
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                Waitlist : {{ $waitlist }}
            </div>
        </div>
    </div>

</div>

@endsection