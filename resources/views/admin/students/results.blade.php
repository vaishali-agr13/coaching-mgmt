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
                    <th>Exam Name</th>
                    <th>Exam Code</th>
                    <th>Obtained Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>

            <tbody>

                @forelse($student->examResults as $result)

                <tr>

                    <td>{{ $result->exam->exam_name ?? '-' }}</td>
                   
                    <td>{{ $result->exam->exam_code ?? '-' }}</td>

                    <td>{{ $result->marks_obtained }}</td>

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