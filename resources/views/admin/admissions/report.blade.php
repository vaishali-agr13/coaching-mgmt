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

       

    </div>

</div>

<div class="card mt-4">

    <div class="card-header">
        <h5 class="mb-0">Admission List</h5>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Application No.</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Course</th>

                        <th>Application Date</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($admissions as $admission)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $admission->application_number }}</td>

                        <td>{{ $admission->first_name }} {{ $admission->last_name }}</td>

                        <td>{{ $admission->email }}</td>

                        <td>{{ $admission->phone }}</td>

                        <td>{{ $admission->applied_course->course_name ?? '-' }}</td>

                        <td>{{ \Carbon\Carbon::parse($admission->application_date)->format('d M Y') }}</td>

                        <td>

                            <form action="{{ route('admin.admissions.status',$admission->id) }}"
                                method="POST">

                                @csrf

                                <select name="application_status"
                                        onchange="this.form.submit()">

                                    <option value="pending"

                                    {{ $admission->application_status == 'pending' ? 'selected' : '' }}>

                                        Pending

                                    </option>

                                    <option value="approved"

                                    {{ $admission->application_status == 'approved' ? 'selected' : '' }}>

                                        Approved

                                    </option>

                                    <option value="rejected"

                                    {{ $admission->application_status == 'rejected' ? 'selected' : '' }}>

                                        Rejected

                                    </option>

                                </select>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            No admissions found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection