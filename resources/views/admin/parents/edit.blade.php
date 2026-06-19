@extends('layouts.app')

@section('title','Edit Album')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Edit Parent</h1>

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


    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title">

                        Update Parent Information

                    </h3>

                </div>


                <form action="{{ route('admin.parents.update',$parent->id) }}"
                      method="POST">

                    @csrf

                    @method('PUT')

                    <div class="card-body">

                        <div class="row">


                            <!-- Name -->

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text"

                                           name="name"

                                           class="form-control @error('name') is-invalid @enderror"

                                           value="{{ old('name',$parent->user->name) }}">

                                    @error('name')

                                    <span class="text-danger">

                                        {{ $message }}

                                    </span>

                                    @enderror

                                </div>

                            </div>


                    

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Email</label>

                                    <input type="email"

                                           name="email"

                                           class="form-control @error('email') is-invalid @enderror"

                                           value="{{ old('email',$parent->user->email) }}">

                                    @error('email')

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

                                           value="{{ old('father_name',$parent->father_name) }}">

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

                                           value="{{ old('mother_name',$parent->mother_name) }}">

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

                                           value="{{ old('phone',$parent->phone) }}">

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

                                           value="{{ old('occupation',$parent->occupation) }}">

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

                                              class="form-control @error('address') is-invalid @enderror">{{ old('address',$parent->address) }}</textarea>

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

                            Update Parent

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