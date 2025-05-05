@extends('layout')

@section('title', 'Your Favorites')

@section('main')
    <h1>Your Favorite Recipes</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (count($favorites) > 0)
        <ul class="list-group">
            @foreach ($favorites as $favorite)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('recipes.show', ['id' => $favorite->recipe_id]) }}">
                            @if ($favorite->recipe)
                                {{ $favorite->recipe->title }}
                            @else
                                Deleted Recipe
                            @endif
                        </a>
                    </div>

                    <form method="POST" action="{{ route('favorites.delete', ['id' => $favorite->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>You haven't added any favorites yet.</p>
    @endif
@endsection