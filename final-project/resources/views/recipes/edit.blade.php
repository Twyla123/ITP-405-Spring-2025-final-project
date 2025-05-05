@extends('layout')

@section('title', 'Edit Recipe')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center fw-bold fs-2">Edit Recipe</h1>

            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('recipes.update', ['id' => $recipe->id]) }}">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label fw-bold fs-5">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $recipe->title) }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ingredients" class="form-label fw-bold fs-5">Ingredients</label>
                    <textarea name="ingredients" id="ingredients" class="form-control" rows="3">{{ old('ingredients', $recipe->ingredients) }}</textarea>
                    @error('ingredients')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="instructions" class="form-label fw-bold fs-5">Instructions</label>
                    <textarea name="instructions" id="instructions" class="form-control" rows="3">{{ old('instructions', $recipe->instructions) }}</textarea>
                    @error('instructions')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label fw-bold fs-5">Category</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $recipe->category) }}">
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold fs-5">Image URL</label>
                    <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $recipe->image) }}">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2 fs-5">Update Recipe</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection