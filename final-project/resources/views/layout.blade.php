<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>@yield('title')</title>
</head>
<body>
  <div class="container">

    <ul class="nav d-flex justify-content-end mt-3">
      @if (Auth::check())
        <li class="nav-item">
          <a href="/recipes" class="nav-link">All Recipes</a>
        </li>
        <li class="nav-item">
          <a href="/recipes/create" class="nav-link">New Recipe</a>
        </li>
        <li class="nav-item">
          <a href="/favorites" class="nav-link">Favorites</a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link nav-link">Logout</button>
          </form>
        </li>
      @else
        <li class="nav-item">
          <a href="/register" class="nav-link">Register</a>
        </li>
        <li class="nav-item">
          <a href="/login" class="nav-link">Login</a>
        </li>
      @endif
    </ul>

    @yield('content')
  </div>
</body>
</html>