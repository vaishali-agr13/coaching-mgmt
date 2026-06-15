@extends('layouts.app')

@section('title','Comments')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">
    <h4>Comments - {{ $post->title }}</h4>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
    <th>User</th>
    <th>Comment</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($comments as $comment)

<tr>

    <td>
        {{ $comment->user->name ?? 'Guest' }}
    </td>

    <td>
        {{ $comment->comment }}
    </td>

    <td>
        {{ $comment->status }}
    </td>

    <td>

        @if($comment->status!='approved')

        <form action="{{ route('admin.blog.approveComment',$comment->id) }}"
              method="POST"
              style="display:inline">

            @csrf

            <button class="btn btn-success btn-sm">
                Approve
            </button>

        </form>

        @endif

        <form action="{{ route('admin.blog.deleteComment',$comment->id) }}"
              method="POST"
              style="display:inline">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm">
                Delete
            </button>

        </form>

    </td>

</tr>

@endforeach

</tbody>

</table>

{{ $comments->links() }}

</div>
</div>

</div>

@endsection