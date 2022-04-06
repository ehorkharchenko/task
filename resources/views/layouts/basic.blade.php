<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Task Company </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="h-100 bg-gradient-blue">
        <header class="w-100 p-2 border-bottom d-flex justify-content-between">
            <a class="btn" href="{{ route('home') }}"> Title </a>
            @guest
                <div>
                    <a class="btn" href="{{ route('register') }}"> Зарегистрироватся </a>
                    <a class="btn btn-primary" href="{{ route('login') }}"> войти </a>
                </div>
            @else
                <div class="d-flex justify-content-between">
                    <span class="btn">{{ Auth::user()->name }}</span>
                    <button class="btn btn-danger"
                            onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        "> выйти </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endguest
        </header>
        <div class="bg-gray-dark d-flex flex-wrap justify-content-between">
            @yield('content')
        </div>
    </body>
</html>
