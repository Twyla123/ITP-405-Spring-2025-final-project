@extends('layout')

@section('title', 'Your Favorites')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4">Your Favorite Recipes</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if (count($favorites) > 0)
        <ul class="list-group shadow-sm">
            @foreach ($favorites as $favorite)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('recipes.show', ['id' => $favorite->recipe_id]) }}" class="fw-bold text-decoration-none">
                        @if ($favorite->recipe && $favorite->recipe->title)
                            {{ $favorite->recipe->title }}
                        @else
                            Deleted Recipe
                        @endif
                    </a>
                    <form method="POST" action="{{ route('favorites.delete', ['id' => $favorite->id]) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center">You haven't added any favorites yet.</div>
    @endif
</div>
@endsection