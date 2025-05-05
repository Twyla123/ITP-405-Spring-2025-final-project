@extends('layout')

@section('title', 'Create Recipe')

@section('content')
    <h1>Create a New Recipe</h1>

    @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('recipes.store') }}">
        @csrf

        <label>Title:</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br>
        @error('title')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <label>Ingredients:</label><br>
        <textarea name="ingredients">{{ old('ingredients') }}</textarea><br>
        @error('ingredients')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <label>Instructions:</label><br>
        <textarea name="instructions">{{ old('instructions') }}</textarea><br>
        @error('instructions')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <label>Category:</label><br>
        <input type="text" name="category" value="{{ old('category') }}"><br>
        @error('category')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <label>Image URL:</label><br>
        <input type="text" name="image" value="{{ old('image') }}"><br>
        @error('image')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <br>
        <button type="submit">Create Recipe</button>
    </form>
@endsection