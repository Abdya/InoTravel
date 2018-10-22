<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>InoTravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/welcome.css" rel="stylesheet">
        <link href="/css/searchBar.css" rel="stylesheet">
        <link href="/css/pickadate/classic.css" rel="stylesheet">
        <link href="/css/pickadate/classic.date.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="/js/pickadate/picker.js"></script>
        <script src="/js/pickadate/picker.date.js"></script>

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
                        <a href="{{ route('login') }}">Принять гостей</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    InoTravel
                </div>
                <div style="max-width: 510px">
                    <div class="row mb-3">
                        <div class="flat-input col-md-12">
                            <input class="flat-input__input" placeholder="Куда?" type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="flat-input col-md-6">
                            <input class="datepicker flat-input__input" placeholder="Заезд" type="text">
                        </div>
                        <div class="flat-input col-md-6">
                            <input class="datepicker flat-input__input" placeholder="Выезд" type="text">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="flat-input col-md-12">
                            <input class="flat-input__input" placeholder="Гости" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg" type="submit">Начать поиск</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>$('.datepicker').pickadate({
            format: 'dd/mm/yy'
        })</script>
    </body>
</html>
