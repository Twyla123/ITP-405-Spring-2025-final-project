@extends('layout')

@section('title', 'Create Recipe')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center fw-bold fs-2">Create a New Recipe</h1>

            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('recipes.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label fw-bold fs-5">Title</label>
                    <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ingredients" class="form-label fw-bold fs-5">Ingredients</label>
                    <textarea id="ingredients" name="ingredients" class="form-control" rows="3">{{ old('ingredients') }}</textarea>
                    @error('ingredients')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="instructions" class="form-label fw-bold fs-5">Instructions</label>
                    <textarea id="instructions" name="instructions" class="form-control" rows="3">{{ old('instructions') }}</textarea>
                    @error('instructions')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label fw-bold fs-5">Category</label>
                    <input id="category" name="category" type="text" class="form-control" value="{{ old('category') }}">
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold fs-5">Image URL</label>
                    <input id="image" name="image" type="text" class="form-control" value="{{ old('image') }}">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2 fs-5">Create Recipe</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection