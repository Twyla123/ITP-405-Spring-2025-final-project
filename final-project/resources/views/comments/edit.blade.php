@extends('layout')

@section('title', 'Edit Comment')

@section('content')
    <h1>Edit Comment</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('comments.update', ['id' => $comment->id]) }}">
        @csrf

        <div class="mb-3">
            <label for="body">Comment</label>
            <textarea id="body" name="body" class="form-control">{{ old('body', $comment->body) }}</textarea>
            @error('body')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection