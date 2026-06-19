@extends('layouts.app')

@section('content')


<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Add Parent</h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="{{ route('admin.parents.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>
    </section>


    <!-- Main Content -->

    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title">

                        Parent Information

                    </h3>

                </div>


                <form action="{{ route('admin.parents.store') }}"
                      method="POST">

                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <!-- Name -->

                            <!-- Email -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Email</label>

                                    <input type="email"

                                           name="email"

                                           class="form-control @error('email') is-invalid @enderror"

                                           value="{{ old('email') }}"

                                           placeholder="Enter Email">

                                    @error('email')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>


                            <!-- Password -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Password</label>

                                    <input type="password"

                                           name="password"

                                           class="form-control @error('password') is-invalid @enderror"

                                           placeholder="Enter Password">

                                    @error('password')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>


                            <!-- Father Name -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Father Name</label>

                                    <input type="text"

                                           name="father_name"

                                           class="form-control @error('father_name') is-invalid @enderror"

                                           value="{{ old('father_name') }}"

                                           placeholder="Enter Father Name">

                                    @error('father_name')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>


                            <!-- Mother Name -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Mother Name</label>

                                    <input type="text"

                                           name="mother_name"

                                           class="form-control @error('mother_name') is-invalid @enderror"

                                           value="{{ old('mother_name') }}"

                                           placeholder="Enter Mother Name">

                                    @error('mother_name')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>


                            <!-- Phone -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Phone</label>

                                    <input type="text"

                                           name="phone"

                                           class="form-control @error('phone') is-invalid @enderror"

                                           value="{{ old('phone') }}"

                                           placeholder="Enter Phone Number">

                                    @error('phone')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>


                            <!-- Occupation -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Occupation</label>

                                    <input type="text"

                                           name="occupation"

                                           class="form-control @error('occupation') is-invalid @enderror"

                                           value="{{ old('occupation') }}"

                                           placeholder="Enter Occupation">

                                    @error('occupation')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>


                            <!-- Address -->

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Address</label>

                                    <textarea name="address"

                                              rows="4"

                                              class="form-control @error('address') is-invalid @enderror"

                                              placeholder="Enter Address">{{ old('address') }}</textarea>

                                    @error('address')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="card-footer">

                        <button type="submit"

                                class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Save Parent

                        </button>


                        <a href="{{ route('admin.parents.index') }}"

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