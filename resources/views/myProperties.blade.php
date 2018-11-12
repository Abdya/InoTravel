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
    <link href="/css/properties.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/a_links.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">
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
                <a  href="{{ route('userProfile') }}">{{ $user->firstName }} {{ $user->lastName }}</a>
                <a  href="{{ route('myProperties') }}"><ins>Мое жилье @countReq</ins></a>
                <a  href="{{ route('requests') }}">Заявки</a>
                <a href="http://inotravel.local/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </div>
        </ul>
    </div>
</nav>
@if(count($properties) === 0)
    <h2 style="border-bottom: 0px" class="text-center mb-4">Вы еще не создали ни одного профиля жилья!</h2>
    <div class="text-center">
        <a href="{{ route('create') }}" type="button" class="btn btn-primary mb-5">Добавить жилье</a>
    </div>
@else
    <div class="container float-left mb-5">
        <h2>Заявки</h2>
        <div class="container float-left mb-5">
            @foreach($requests as $request)
                <div class="row mb-5">
                    <div class="col-md-5">
                        @if(!$request->property->photo)
                            <img src="/picture/300.jpg" width="100%" height="auto" alt="room">
                        @else
                            <img src="{{ $request->property->photo }}" width="100%" height="auto" alt="room">
                        @endif
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
                                            <form method="post" action="/profile/properties/approve" enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" name="approve" value="{{ $request->id }}" class="btn btn-success mr-1">Одобрить</button>
                                            </form>
                                            <form method="post" action="/profile/properties/reject" enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit"  name="reject" value="{{ $request->id }}" class="btn btn-danger">Отклонить</button>
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
        <a href="{{ route('create') }}" type="submit" class="btn btn-primary mb-5" style="padding-left: 15px">Добавить жилье</a>
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
                                    <a href="{{ route('userProp', $property->id) }}" class="word-break: break-all; max-width: 100%" style="color: black"><ins><p>{{ $property->title }}</p></ins></a>
                                    <p>{{ $property->town->title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
<style>
    p {
        color: #000000;
        font-family: 'Montserrat', sans-serif;
        font-size: 17px;
        font-weight: 400;
    }
</style>
</body>
</html>