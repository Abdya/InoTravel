<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>InoTravel</title>


    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/searchResults.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/a_links.css">
    <link href="/css/pickadate/default.css" rel="stylesheet">
    <link href="/css/pickadate/default.date.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
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

<main role="main">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <a class="navbar-brand" href="{{ route('welcome') }}">InoTravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
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
                        <a href="{{ route('login') }}">Принять гостей</a>
                    @endauth
                </div>
            </ul>
        </div>
    </nav>
    <section class="jumbotron text-center">
        <div class="container">
            <form method="get" action="/properties" style="max-width: 1080px">
                <div class="row">
                    <div class="col">
                        <select class="selectpicker" data-live-search="true" name="town" id="town">
                            @foreach ($townsForRes as $town)
                                <option @if ($currentTown == $town->id) selected @endif value="{{ $town->id }}">{{ $town->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flat-input col">
                        <input class="datepicker form-control" value="{{ $startDate }}" name="startDate" placeholder="Заезд" type="text">
                    </div>
                    <div class="flat-input col">
                        <input class="datepicker form-control" name="endDate" value="{{ $endDate }}" placeholder="Выезд" type="text">
                    </div>
                    <div class="flat-input col">
                        <input class="form-control mb-4" name="guests" value="{{ $guests }}"placeholder="Гости" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg" type="submit">Начать поиск</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            @if(count($properties) === 0)
                <h2> Ничего не найдено!</h2>
            @endif
            <div class="row">
                @foreach($properties as $property)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <a href="/properties/{{ $property->id }}"><img class="card-img-top"  src="{{ $property->photo }}" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text"><a style="word-break: break-all; max-width: 100%" href="/properties/{{ $property->id }}">{{ $property->title }}</a></p>
                            <p class="card-text">{{ $property->town->title }}</p>
                            <p class="card-text">{{ $property->owner->firstName }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/properties/{{ $property->id }}" class="btn btn-sm btn-outline-secondary">Посмотреть</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Вверх</a>
        </p>
    </div>
</footer>
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
</body>
</html>