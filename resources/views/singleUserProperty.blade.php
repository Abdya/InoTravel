<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Album example for Bootstrap</title>


    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/properties.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/a_links.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <a class="navbar-brand" href="{{ route('welcome') }}">InoTravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="top-right links">
                <a  href="{{ route('userProfile') }}"><ins>{{ $user->firstName }} {{ $user->lastName }}</ins></a>
                <a  href="{{ route('myProperties') }}">Мое жилье <span class="badge badge-danger">1</span></a>
                <a  href="{{ route('requests') }}">Заявки</a>
                <a href="http://inotravel.local/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </div>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $property->photo }}" width="100%" height="auto" alt="room">
        </div>
        <div class="col-md-6">
            <div class="clearfix">
                <div class="row">
                    <div class="col-md-6 property-description">
                        <p>{{ $property->title }}</p>
                        <p>{{ $town->title }}, {{ $property->address }}</p>
                        <p>Спальных мест: <span>{{ $property->beds }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{ route('edit', ['id' => $property->id]) }}" class="btn btn-primary mb-3">Редактировать</a>
                                <button class="btn btn-primary">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p>Есть:</p>
            <div class="feature-list mb-3">
                @foreach($property->features as $feature)
                    <div class="feature-list__item feature-list-item">
                        <div class="feature-list-item__icon-wrap">
                            <img src="{{ $feature->image }}" alt="{{ $feature->title }}" height="32" width="32">
                        </div>
                        <div class="feature-list-item__description">{{ $feature->title }}</div>
                    </div>
                @endforeach
            </div>
            <p>Дополнительная информация:</p>
            <p>{{ $property->extraInformation }}</p>
        </div>
    </div>
</div>
<style>
    .feature-list {
        display: flex;
        flex-direction: row;
    }

    .feature-list__item {
        width: 100px
    }

    .feature-list-item {
        text-align: center;
    }

    .feature-list-item__description {
        margin-top: 5px
    }
</style>
</body>
</html>