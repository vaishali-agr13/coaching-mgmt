@extends('layouts.app')

@section('title','Edit Album')

@section('content')

<form action="{{ route('admin.gallery.update',$album->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="card">

        <div class="card-header">
            <h4>Edit Album</h4>
        </div>

        <div class="card-body">

            <input type="text"
                   name="album_name"
                   value="{{ $album->album_name }}"
                   class="form-control mb-3">

            <textarea name="description"
                      class="form-control mb-3">{{ $album->description }}</textarea>

            <input type="date"
                   name="album_date"
                   value="{{ $album->album_date }}"
                   class="form-control mb-3">

            <select name="visibility"
                    class="form-control mb-3">

                <option value="public" {{ $album->visibility=='public'?'selected':'' }}>
                    Public
                </option>

                <option value="private" {{ $album->visibility=='private'?'selected':'' }}>
                    Private
                </option>

                <option value="members_only" {{ $album->visibility=='members_only'?'selected':'' }}>
                    Members Only
                </option>

            </select>

            <input type="file"
                   name="cover_image"
                   class="form-control mb-3">

            <button class="btn btn-success">
                Update Album
            </button>

        </div>

    </div>

</form>

@endsection