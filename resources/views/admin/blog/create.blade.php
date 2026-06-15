@extends('layouts.app')

@section('title','Create Blog')

@section('content')
<div class="container">

<div class="card">
<div class="card-header">
    <h4>Create Blog</h4>
</div>

<div class="card-body">

<form action="{{ route('admin.blog.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="form-group">
    <label>Title</label>
    <input type="text"
           name="title"
           class="form-control">
</div>

<div class="form-group">
    <label>Excerpt</label>
    <textarea name="excerpt"
              class="form-control"></textarea>
</div>

<div class="form-group">
    <label>Content</label>
    <textarea name="content"
              rows="10"
              class="form-control"></textarea>
</div>

<div class="form-group">
    <label>Category</label>
    <input type="text"
           name="category"
           class="form-control">
</div>

<div class="form-group">
    <label>Featured Image</label>
    <input type="file"
           name="featured_image"
           class="form-control">
</div>

<div class="form-group">
    <label>Status</label>

    <select name="status"
            class="form-control">

        <option value="draft">Draft</option>
        <option value="published">Published</option>
        <option value="archived">Archived</option>

    </select>
</div>

<button class="btn btn-primary">
    Save Blog
</button>

</form>

</div>
</div>

</div>
@endsection