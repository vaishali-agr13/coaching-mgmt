@extends('layouts.app')

@section('title','Faculty Performance')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Faculty Performance Report</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Faculty Name</th>
                            <th>Email</th>
                            <th>Total Courses</th>
                            <th>Status</th>
                            <th>Performance Details</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($faculty as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $item->user->name ?? '-' }}</strong>
                            </td>

                            <td>
                                {{ $item->user->email ?? '-' }}
                            </td>

                            <td>
                                <span class="badge bg-info">
                                    {{ $item->courses->count() }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.reports.facultyPerformanceDetails',$item->id) }}"
                                   class="btn btn-primary btn-sm">
                                    View Details
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No Faculty Records Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $faculty->links() }}
            </div>

        </div>
    </div>

</div>

@endsection