@extends('layout')

@section('title', 'All Recipes')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4">All Recipes</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    @if (count($recipes) > 0)
        <ul class="list-group">
            @foreach ($recipes as $recipe)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('recipes.show', ['id' => $recipe->id]) }}" class="text-decoration-none fw-bold fs-5">
                        {{ $recipe->title }}
                    </a>
                    <span class="badge bg-secondary">#{{ $recipe->id }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center mt-4">
            You haven't created any recipes yet.
            <a href="{{ route('recipes.create') }}" class="btn btn-sm btn-outline-primary ms-2">Create one now</a>
        </div>
    @endif
</div>
@endsection