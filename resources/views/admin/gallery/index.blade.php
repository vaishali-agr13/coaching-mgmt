@extends('layouts.app')

@section('title','Gallery Albums')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Gallery Albums</h4>

            <a href="{{ route('admin.gallery.createAlbum') }}"
               class="btn btn-primary">
                Create Album
            </a>
        </div>

        <div class="card-body">

            <form method="GET">
                <div class="row mb-3">

                    <div class="col-md-4">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Search Album">
                    </div>

                    <div class="col-md-3">
                        <select name="visibility" class="form-control">
                            <option value="">All Visibility</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                            <option value="members_only">Members Only</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success">
                            Search
                        </button>
                    </div>

                </div>
            </form>

            <table class="table table-bordered">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Cover</th>
                    <th>Album</th>
                    <th>Visibility</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($albums as $album)

                    <tr>

                        <td>{{ $album->id }}</td>

                        <td width="100">
                            @if($album->cover_image)
                                <img src="{{ asset('public/uploads/gallery-covers/'.$album->cover_image) }}"
                                     width="80">
                            @endif
                        </td>

                        <td>{{ $album->album_name }}</td>


                        <td>{{ ucfirst($album->visibility) }}</td>

                        <td>

                            <!-- <a href="{{ route('admin.gallery.show',$album->id) }}"
                               class="btn btn-info btn-sm">
                                View
                            </a> -->

                            <a href="{{ route('admin.gallery.edit',$album->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.gallery.destroy',$album->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete Album?')"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

            {{ $albums->links() }}

        </div>
    </div>

</div>

@endsection