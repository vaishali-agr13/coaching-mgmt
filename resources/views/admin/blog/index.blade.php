@extends('layouts.app')

@section('title','Blog Posts')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Blog Posts</h4>

            <a href="{{ route('admin.blog.create') }}"
               class="btn btn-primary float-right">
                Add Blog
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
                               placeholder="Search Blog">
                    </div>

                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
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
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th width="250">Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($posts as $post)
                    <tr>

                        <td>{{ $post->id }}</td>

                        <td>
                            @if($post->featured_image)
                                <img src="{{ asset('storage/'.$post->featured_image) }}"
                                     width="70">
                            @endif
                        </td>

                        <td>{{ $post->title }}</td>

                        <td>{{ $post->category }}</td>

                        <td>
                            @if($post->status == 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($post->status == 'draft')
                                <span class="badge bg-warning">Draft</span>
                            @else
                                <span class="badge bg-danger">Archived</span>
                            @endif
                        </td>

                        <td>
                            {{ $post->published_at }}
                        </td>

                        <td>

                            <a href="{{ route('admin.blog.show',$post->id) }}"
                               class="btn btn-info btn-sm">
                                View
                            </a>

                            <a href="{{ route('admin.blog.edit',$post->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="{{ route('admin.blog.comments',$post->id) }}"
                               class="btn btn-secondary btn-sm">
                                Comments
                            </a>

                            @if($post->status!='published')
                                <form action="{{ route('admin.blog.publish',$post->id) }}"
                                      method="POST"
                                      style="display:inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        Publish
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.blog.unpublish',$post->id) }}"
                                      method="POST"
                                      style="display:inline">
                                    @csrf
                                    <button class="btn btn-dark btn-sm">
                                        Unpublish
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.blog.destroy',$post->id) }}"
                                  method="POST"
                                  style="display:inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete?')">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>

            {{ $posts->links() }}

        </div>
    </div>

</div>
@endsection