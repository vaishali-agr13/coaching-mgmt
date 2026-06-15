@extends('layouts.app')

@section('title','Exam Results Report')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">Exam Results Report</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                    <tr>
                        <th>#</th>
                        <th>Exam</th>
                        <th>Course</th>
                        <th>Total Students</th>
                        <th>Highest %</th>
                        <th>Average %</th>
                        <th>Pass Count</th>
                        <th>Fail Count</th>
                        <th>Exam Date</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($exams as $exam)

                        @php

                            $totalStudents = $exam->results->count();

                            $highestScore = $exam->results->max('percentage') ?? 0;

                            $averageScore = round(
                                $exam->results->avg('percentage') ?? 0,
                                2
                            );

                            $passed = $exam->results
                                ->where('percentage', '>=', 40)
                                ->count();

                            $failed = $exam->results
                                ->where('percentage', '<', 40)
                                ->count();

                        @endphp

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $exam->exam_name ?? '-' }}
                            </td>

                            <td>
                                {{ $exam->course->course_name ?? '-' }}
                            </td>

                            <td>
                                {{ $totalStudents }}
                            </td>

                            <td>
                                {{ $highestScore }}%
                            </td>

                            <td>
                                {{ $averageScore }}%
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $passed }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-danger">
                                    {{ $failed }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center">
                                No Exam Records Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $exams->links() }}
            </div>

        </div>

    </div>

</div>

@endsection