@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>{{ $album->album_name }}</h4>
    </div>

    <div class="card-body">

        <p>{{ $album->description }}</p>

        <hr>

        <h5>Upload Image</h5>

        <form action="{{ route('admin.gallery.storeImage',$album->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <input type="file"
                   name="image"
                   class="form-control mb-2"
                   required>

            <input type="text"
                   name="image_title"
                   placeholder="Title"
                   class="form-control mb-2">

            <textarea name="image_description"
                      class="form-control mb-2"
                      placeholder="Description"></textarea>

            <button class="btn btn-primary">
                Upload Image
            </button>

        </form>

        <hr>

        <div class="row">

            @foreach($album->images as $image)

                <div class="col-md-3">

                    <div class="card mb-3">

                        <img src="{{ asset('storage/'.$image->image_file_path) }}"
                             class="card-img-top">

                        <div class="card-body">

                            <h6>{{ $image->image_title }}</h6>

                            <a href="{{ route('admin.gallery.editImage',$image->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.gallery.destroyImage',$image->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection