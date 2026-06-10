@extends('layouts.app')

@section('title', 'Fee Management')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Fee Management</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.fees.create') }}"
                       class="btn btn-primary">
                        <i class="fas fa-plus"></i> Collect Fee
                    </a>
                </div>

            </div>

        </div>
    </section>

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

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Fee Records</h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Fee Type</th>
                                <th>Total Fee</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($fees as $fee)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $fee->student->user->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $fee->course->course_name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ ucfirst($fee->fee_type) }}
                                </td>

                                <td>
                                    ₹{{ number_format($fee->fee_amount, 2) }}
                                </td>

                                <td>
                                    ₹{{ number_format($fee->paid_amount, 2) }}
                                </td>

                                <td>
                                    ₹{{ number_format($fee->due_amount, 2) }}
                                </td>

                                <td>
                                    {{ $fee->payment_date }}
                                </td>

                                <td>
                                    @if($fee->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($fee->status == 'partial')
                                        <span class="badge bg-warning text-dark">Partial</span>
                                    @else
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('admin.fees.show', $fee->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.fees.edit', $fee->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.fees.destroy', $fee->id) }}"
                                          method="POST"
                                          style="display:inline-block">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this record?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="10" class="text-center text-danger">
                                    No Fee Records Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="card-footer clearfix">
                    {{ $fees->links() }}
                </div>

            </div>

        </div>

    </section>

</div>

@endsection