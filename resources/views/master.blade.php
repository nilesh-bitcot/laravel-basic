<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ URL::asset('/css/app.css') }}" rel="stylesheet">        
    </head>
    <body>
        <div class="container-fluid p-5 bg-primary text-white text-center">
            <h1>@yield('title')</h1>
            <p>@yield('subtitle')</p>            
        </div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link active" href="/logout">Log out</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link active" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/register">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="container mt-5">
            @yield('content')
        </div>
        <div class="mt-5 p-4 bg-dark text-white text-center">
            <p>Footer</p>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>