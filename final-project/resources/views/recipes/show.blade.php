@extends('layout')

@section('title', $recipe->title)

@section('content')
<div class="container mt-5 mb-5 p-4 bg-white rounded shadow-sm">
    <h1 class="mb-4 text-center">{{ $recipe->title }}</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Recipe Details Section --}}
    <div class="p-4 mb-5 border rounded bg-light">
        <h4 class="mb-3">Recipe Details</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <p><span class="fw-bold">Category:</span> {{ $recipe->category }}</p>
            </div>
        </div>

        <div class="mb-3">
            <p class="fw-bold">Ingredients:</p>
            <div class="ps-3">
                <p class="mb-0">{{ $recipe->ingredients }}</p>
            </div>
        </div>

        <div>
            <p class="fw-bold">Instructions:</p>
            <div class="ps-3">
                <p class="mb-0">{{ $recipe->instructions }}</p>
            </div>
        </div>
    </div>

    {{-- Image Section --}}
    @if ($recipe->image)
        <div class="mb-5 text-center">
            <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
        </div>
    @endif

    {{-- Action Buttons --}}
    @if (Auth::check())
        <div class="mb-5 d-flex gap-2">
            @if (Auth::id() === $recipe->user_id)
                <a href="{{ route('recipes.edit', ['id' => $recipe->id]) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                <form method="POST" action="{{ route('recipes.delete', ['id' => $recipe->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            @endif

            <form method="POST" action="{{ route('favorites.store', ['recipeId' => $recipe->id]) }}">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Add to Favorites</button>
            </form>
        </div>

        {{-- Leave a Comment Section --}}
        <div class="border-top pt-4 mt-5 mb-5">
            <h4 class="fw-bold mb-3">Leave a Comment</h4>
            <form method="POST" action="{{ route('comments.store', ['recipeId' => $recipe->id]) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="body" class="form-control" rows="3" placeholder="Write your comment...">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>
    @endif

    {{-- Comments Section --}}
    @if ($recipe->comments->count() > 0)
        <div class="border-top pt-4">
            <h4 class="fw-bold mb-3">Comments</h4>
            <ul class="list-group">
                @foreach ($recipe->comments as $comment)
                    <li class="list-group-item">
                        <p class="mb-1">{{ $comment->body }}</p>
                        <small class="text-muted">— {{ $comment->user->name ?? 'Unknown' }}</small>

                        @if (Auth::check() && Auth::id() === $comment->user_id)
                            <div class="mt-2 d-flex gap-2">
                                <a href="{{ route('comments.edit', ['id' => $comment->id]) }}" class="btn btn-outline-secondary btn-sm">Edit</a>

                                <form method="POST" action="{{ route('comments.delete', ['id' => $comment->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection