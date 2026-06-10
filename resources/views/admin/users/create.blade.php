@extends('layouts.app')

@section('title', 'Create User')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">

    <h4>Add User</h4>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>

                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>

                <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                
                <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>

                <select name="role" class="form-control mb-2" required>
                    <!-- <option value="student">Student</option> -->
                    <option value="faculty">Faculty</option>
                    <!-- <option value="admin">Admin</option> -->
                </select>

                <button class="btn btn-primary">Save</button>

            </form>

        </div>
    </div>

</div>

@endsection