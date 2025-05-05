@extends('layout')

@section('title', 'Edit Recipe')

@section('content')
    <h1>Edit Recipe</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/recipes/{{ $recipe->id }}/update">
        @csrf

        <div class="mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $recipe->title) }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ingredients">Ingredients:</label>
            <textarea name="ingredients" id="ingredients" class="form-control">{{ old('ingredients', $recipe->ingredients) }}</textarea>
            @error('ingredients')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="instructions">Instructions:</label>
            <textarea name="instructions" id="instructions" class="form-control">{{ old('instructions', $recipe->instructions) }}</textarea>
            @error('instructions')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $recipe->category) }}">
            @error('category')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image">Image URL:</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $recipe->image) }}">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Recipe</button>
    </form>
@endsection