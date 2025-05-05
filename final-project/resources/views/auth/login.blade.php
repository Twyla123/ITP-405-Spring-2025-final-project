@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-md-8 col-lg-6 bg-light p-5 mt-5 rounded shadow-sm">
        <h1 class="text-center mb-4">Login</h1>

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" name="password" type="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 py-2">Login</button>
            </div>
        </form>

        <p class="mt-4 text-center">
            Don't have an account?
            <a href="{{ route('register') }}">Register here</a>.
        </p>
    </div>
</div>
@endsection