<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- bootstrap 3.3 --}}
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <title>Laravel Saldo</title>

    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <ul class="nav navbar-nav">
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ route('admin.home') }}">Home</a></li>
                        <li><a href="{{ route('perfil') }}">Meu Perfil</a></li>
                    @else
                        <li><a href="#">Laravel Saldo</a></li>
                        <li><a href="#">Quem somos</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                @endif
                </ul>
            </div>
        </nav>
    </div>
    </body>
</html>
