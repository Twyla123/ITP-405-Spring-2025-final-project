<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css"> 
  <title>@yield('title')</title>
</head>
<body>

  <div id="header">
    <h1>My Recipe Book</h1>
  </div>


  <div id="nav-wrapper">
    <div id="nav">
      @if (Auth::check())
        <div class="nav-links">
          <a href="/recipes">All Recipes</a>
          <a href="/recipes/create">New Recipe</a>
          <a href="/favorites">Favorites</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
          </form>
        </div>
      @else
        <div class="nav-links">
          <a href="/register">Register</a>
          <a href="/login">Login</a>
        </div>
      @endif
    </div>
  </div>

  <!-- Flash Messages -->
  <div class="container p-4 mt-3 mb-5 rounded">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
  </div>

  <div id="footer">
    <p>&copy; 2025 My Recipe App. All rights reserved.</p>
  </div>

</body>
</html>