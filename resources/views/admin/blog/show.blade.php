@extends('layouts.app')

@section('title','Blog Details')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">
    <h4>{{ $post->title }}</h4>
</div>

<div class="card-body">

@if($post->featured_image)
<img src="{{ asset('storage/'.$post->featured_image) }}"
     class="img-fluid mb-3">
@endif

<p>
    <strong>Category:</strong>
    {{ $post->category }}
</p>

<p>
    <strong>Status:</strong>
    {{ $post->status }}
</p>

<p>
    <strong>Author:</strong>
    {{ $post->author->name ?? '' }}
</p>

<hr>

{!! nl2br(e($post->content)) !!}

</div>

</div>

</div>

@endsection