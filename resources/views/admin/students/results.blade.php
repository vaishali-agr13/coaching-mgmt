@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Exam Results</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>

            <tbody>

                @forelse($student->examResults as $result)

                <tr>

                    <td>{{ $result->exam->title ?? '-' }}</td>

                    <td>{{ $result->subject }}</td>

                    <td>{{ $result->marks }}</td>

                    <td>{{ $result->grade }}</td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center">
                        No Result Found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection