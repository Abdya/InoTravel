<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>InoTravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/welcome.css" rel="stylesheet">
        <link href="/css/searchBar.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">

    </head>
    <body>


        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Моё жилье</a>
                        <a href="{{ url('/home') }}">Заявки</a>
                    @else
                        <a href="{{ route('login') }}">Войти</a>
                        <a href="{{ route('register') }}">Регистрация</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    InoTravel
                </div>
                <div style="position: relative">
                    <form class="search">
                        <div class="search__wrapper">
                            <input type="text" name="" placeholder="Куда?" class="search__field">
                            <button type="submit" style="font-size: 30px" class="fa fa-search search__icon "></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
