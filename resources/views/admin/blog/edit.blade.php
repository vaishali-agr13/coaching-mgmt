@extends('layouts.app')

@section('title','Edit Blog')

@section('content')
<div class="container">

<div class="card">
<div class="card-header">
    <h4>Edit Blog</h4>
</div>

<div class="card-body">

<form action="{{ route('admin.blog.update',$post->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="form-group">
    <label>Title</label>
    <input type="text"
           name="title"
           value="{{ $post->title }}"
           class="form-control">
</div>

<div class="form-group">
    <label>Excerpt</label>
    <textarea name="excerpt"
              class="form-control">{{ $post->excerpt }}</textarea>
</div>

<div class="form-group">
    <label>Content</label>
    <textarea name="content"
              rows="10"
              class="form-control">{{ $post->content }}</textarea>
</div>

<div class="form-group">
    <label>Category</label>
    <input type="text"
           name="category"
           value="{{ $post->category }}"
           class="form-control">
</div>

@if($post->featured_image)
<img src="{{ asset('storage/'.$post->featured_image) }}"
     width="120"
     class="mb-3">
@endif

<div class="form-group">
    <label>Change Image</label>
    <input type="file"
           name="featured_image"
           class="form-control">
</div>

<div class="form-group">
    <label>Status</label>

    <select name="status"
            class="form-control">

        <option value="draft" {{ $post->status=='draft'?'selected':'' }}>Draft</option>

        <option value="published" {{ $post->status=='published'?'selected':'' }}>Published</option>

        <option value="archived" {{ $post->status=='archived'?'selected':'' }}>Archived</option>

    </select>
</div>

<button class="btn btn-success">
    Update Blog
</button>

</form>

</div>
</div>

</div>
@endsection