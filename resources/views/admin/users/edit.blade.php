@extends('layouts.app')

@section('title', 'Students')

@section('content')

<div class="container">

    <h4>Edit User</h4>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="text" name="name" value="{{ $user->name }}" class="form-control mb-2" required>

                <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-2" required>
                
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control mb-2" required>


                <select name="role" class="form-control mb-2">
                    <!-- <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option> -->
                    <option value="faculty" {{ $user->role == 'faculty' ? 'selected' : '' }}>Faculty</option>
                    <!-- <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option> -->
                </select>

                <button class="btn btn-success">Update</button>

            </form>

        </div>
    </div>

</div>

@endsection