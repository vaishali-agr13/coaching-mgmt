@extends('layouts.app')

@section('title', 'Mark Attendance')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mark Attendance</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
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

            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-check"></i>
                        Student Attendance
                    </h3>
                </div>

                <form action="{{ route('admin.attendance.mark') }}" method="POST">

                    @csrf

                    <div class="card-body">

                        <div class="row mb-4">

                            <div class="col-md-4">
                                <label>
                                    Attendance Date <span class="text-danger">*</span>
                                </label>

                               <input type="date"
                                        name="attendance_date"
                                        class="form-control"
                                        value="{{ date('Y-m-d') }}"
                                        required>
                            </div>

                            <div class="col-md-4">
                                    <label>
                                        Course <span class="text-danger">*</span>
                                    </label>

                                    <select name="course_id" id="course_id" class="form-control" 
                                            required onchange="changeCourse(this.value)">
                                        <option value="">Select Course</option>

                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach

                                    </select>
                             </div>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped">

                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Roll No</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($students as $student)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $student->user->name ?? '-' }}</td>

                                        <td>{{ $student->roll_number ?? '-' }}</td>

                                        <td>


                                            <input type="hidden" name="attendance[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                                           
                                            <select
                                                name="attendance[{{ $student->id }}][status]"
                                                class="form-control">

                                                <option value="present">Present</option>
                                                <option value="absent">Absent</option>
                                                <option value="leave">Leave</option>
                                                <option value="late">Late</option>

                                            </select>
                                        </td>

                                        <td>
                                            <input type="text"
                                                name="attendance[{{ $student->id }}][remarks]"
                                                class="form-control"
                                                placeholder="Remarks">
                                        </td>

                                    </tr>

                                    @empty

                                    <tr>
                                        <td colspan="4" class="text-center text-danger">
                                            No Students Found
                                        </td>
                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Attendance
                        </button>

                        <a href="{{ route('admin.attendance.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection

<script>
function changeCourse(courseId)
{
    if(courseId != '')
    {
        window.location.href =
            "{{ route('admin.attendance.create') }}" +
            "?course_id=" + courseId;
    }
}
</script>