@extends('layouts.app')

@section('title','Create Album')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Create Album</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.gallery.storeAlbum') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label>Album Name</label>
                <input type="text"
                       name="album_name"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description"
                          class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Album Date</label>
                <input type="date"
                       name="album_date"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Visibility</label>

                <select name="visibility"
                        class="form-control">

                    <option value="public">Public</option>
                    <option value="private">Private</option>
                    <option value="members_only">Members Only</option>

                </select>
            </div>

            <div class="mb-3">
                <label>Cover Image</label>
                <input type="file"
                       name="cover_image"
                       class="form-control">
            </div>

            <button class="btn btn-primary">
                Save Album
            </button>

        </form>

    </div>
</div>

@endsection