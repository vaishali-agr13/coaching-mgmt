@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header">
            <h4>Student Profile</h4>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">
                    <table class="table table-bordered">

                        <tr>
                            <th>Name</th>
                            <td>{{ $student->user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $student->user->email }}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>{{ $student->user->phone }}</td>
                        </tr>

                        <tr>
                            <th>Roll No</th>
                            <td>{{ $student->roll_number }}</td>
                        </tr>

                        <tr>
                            <th>Registration No</th>
                            <td>{{ $student->registration_number }}</td>
                        </tr>

                    </table>
                </div>

                <div class="col-md-6">

                    <table class="table table-bordered">

                        <tr>
                            <th>Father Name</th>
                            <td>{{ $student->father_name }}</td>
                        </tr>

                        <tr>
                            <th>Mother Name</th>
                            <td>{{ $student->mother_name }}</td>
                        </tr>

                        <tr>
                            <th>DOB</th>
                            <td>{{ $student->date_of_birth }}</td>
                        </tr>

                        <tr>
                            <th>Gender</th>
                            <td>{{ ucfirst($student->gender) }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-success">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection