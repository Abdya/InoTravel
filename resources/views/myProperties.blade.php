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
    <a class="navbar-brand" href="#">InoTravel</a>
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
<div class="container float-left mb-5">
    <h2>Заявки</h2>
    <div class="container float-left mb-5">
        @foreach($requests as $request)
            <div class="row mb-5">
                <div class="col-md-5">
                    <img src="/picture/room.jpg" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-6">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-6 property-description">
                                <p class="word-break: break-all; max-width: 100%">{{ $request->property->title }}</p>
                                <p>{{ $request->property->town->title }}</p>
                                <p>Заявка от: {{ $request->user->firstName }}</p>
                                <p>{{ \Carbon\Carbon::parse($request->startDate)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($request->endDate)->format('d/m/Y')}}</p>
                                <p>Людей: <span>{{ $request->quantityGuests }}</span></p>
                                <div>
                                    <div class="row">
                                        <form method="post" action="/profile/properties" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-success mr-1">Одобрить</button>
                                        </form>
                                        <form method="post" action="/profile/properties" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Отклонить</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="container float-left mb-5">
    <h2>Жилье</h2>
    <a href="{{ route('create') }}" type="submit" class="btn btn-primary" style="padding-left: 15px">Добавить жилье</a>
    <div class="container float-left mb-5">
        @foreach($properties as $property)
            <div class="row mb-5">
                <div class="col-md-5">
                    <img src="{{ $property->photo }}" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-6">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-6 property-description">
                                <p class="word-break: break-all; max-width: 100%">{{ $property->title }}</p>
                                <p>{{ $property->town->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>