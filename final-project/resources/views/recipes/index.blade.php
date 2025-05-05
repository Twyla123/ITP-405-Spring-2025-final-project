@extends('layout')

@section('title', 'All Recipes')

@section('content')
    <h1>All Recipes</h1>

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

    @if (count($recipes) > 0)
        <ul class="list-group">
            @foreach ($recipes as $recipe)
                <li class="list-group-item">
                    <a href="{{ route('recipes.show', ['id' => $recipe->id]) }}">
                        {{ $recipe->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>You haven't created any recipes. 
           <a href="{{ route('recipes.create') }}">Create one now</a>.
        </p>
    @endif
@endsection