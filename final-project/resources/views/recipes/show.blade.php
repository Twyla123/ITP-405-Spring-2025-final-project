@extends('layout')

@section('title', $recipe->title)

@section('content')
    <h1>{{ $recipe->title }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error') && count($recipes) === 0)
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif

    <p><strong>Category:</strong> {{ $recipe->category }}</p>

    <p><strong>Ingredients:</strong></p>
    <p>{{ $recipe->ingredients }}</p>

    <p><strong>Instructions:</strong></p>
    <p>{{ $recipe->instructions }}</p>

    @if ($recipe->image)
        <div class="mb-3">
            <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="img-fluid">
        </div>
    @endif

    @if (Auth::check())
        @if (Auth::id() === $recipe->user_id)
            <a href="{{ route('recipes.edit', ['id' => $recipe->id]) }}" class="btn btn-sm btn-outline-primary">
                Edit
            </a>

            <form method="POST" action="{{ route('recipes.delete', ['id' => $recipe->id]) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    Delete
                </button>
            </form>
        @endif

        <form method="POST" action="{{ route('favorites.store', ['recipeId' => $recipe->id]) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn btn-success">
                Add to Favorites
            </button>
        </form>
    @endif
@endsection