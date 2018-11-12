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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
        <link href="/css/pickadate/default.css" rel="stylesheet">
        <link href="/css/pickadate/default.date.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
        <script src="/js/pickadate/picker.js"></script>
        <script src="/js/pickadate/picker.date.js"></script>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a  href="{{ route('userProfile') }}">{{ $user->firstName }} {{ $user->lastName }}</a>
                        <a  href="{{ route('myProperties') }}">Мое жилье</a>
                        <a  href="{{ route('requests') }}">Заявки</a>
                        <a href="http://inotravel.local/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    @else
                        <a href="{{ route('login') }}">Войти</a>
                        <a href="{{ route('register') }}">Регистрация</a>
                        <a href="{{ route('create') }}">Принять гостей</a>
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    InoTravel
                </div>
                <form method="get" action="/properties" enctype="multipart/form-data" style="max-width: 510px">
                    <div class="row mb-3">
                        <div class="flat-input col-md-12">
                            <select class="selectpicker" data-live-search="true" data-style="btn-primary" name="town" id="town">
                                @foreach ($towns as $town)
                                    <option value="{{ $town->id }}">{{ $town->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="flat-input col-md-6">
                            <input class="datepicker flat-input__input" name="startDate" placeholder="Заезд" type="text">
                        </div>
                        <div class="flat-input col-md-6">
                            <input class="datepicker flat-input__input" name="endDate" placeholder="Выезд" type="text">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="flat-input col-md-12">
                            <input class="flat-input__input" name="guests" placeholder="Гости" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg" type="submit">Начать поиск</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>$('.datepicker').pickadate({
                monthsFull: [ 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря' ],
                monthsShort: [ 'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек' ],
                weekdaysFull: [ 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' ],
                weekdaysShort: [ 'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб' ],
                today: 'сегодня',
                clear: 'удалить',
                close: 'закрыть',
                firstDay: 1,
                format: 'dd/mm/yyyy',
                selectYears: true,
                selectMonths: true
            })
        </script>
        <style>
            .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
                width: 100%;
            }
        </style>
    </body>
</html>
