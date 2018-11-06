<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Requests</title>


    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/a_links.css">
    <link href="/css/properties.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="navbar-brand">
        <a  href="{{ route('welcome') }}">InoTravel</a> / <span >Заявки</span>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="top-right links">
                <a  href="{{ route('userProfile') }}">{{ $user->firstName }} {{ $user->lastName }}</a>
                <a  href="{{ route('myProperties') }}">Мое жилье @countReq</a>
                <a  href="{{ route('requests') }}"><ins>Заявки</ins></a>
                <a href="http://inotravel.local/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </div>
        </ul>
    </div>
</nav>
<div class="container float-left mb-5">
    <h2>Отправленные</h2>
    <div class="container float-left mb-5">
        @foreach($bookings as $booking)
            <div class="row mt-4 mb-5">
                <div class="col-md-5">
                    <img src="{{ $booking->property->photo }}" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-6">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-6 property-description">
                                <p>{{ $booking->property->title }}</p>
                                <p>{{ $booking->property->town->title }}</p>
                                <p>{{ $booking->property->owner->firstName }} {{ $booking->property->owner->lastName }}</p>
                                <p>{{ \Carbon\Carbon::parse($booking->startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($booking->endDate)->format('d/m/Y') }}</p>
                                <p>Людей: <span>{{ $booking->quantityGuests }}</span></p>
                                @if ($booking->status === 2)
                                    <p><span class="badge badge-success">Заявка принята</span></p>
                                @endif
                                @if ($booking->status === 0)
                                    <p><span class="badge badge-danger">Заявка отклонена!</span></p>
                                @endif
                                @if ($booking->status === 1)
                                    <p><span class="badge badge-warning">Заявка на рассмотрении</span></p>
                                @endif
                                <p>Отправлено: {{ \Carbon\Carbon::parse($booking->sendDate)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="container float-left mb-5">
    <h2>Полученные</h2>
    <div class="container float-left mb-5">
        @foreach($recievedRequests as $recievedReq)
            <div class="row mt-4 mb-5">
                <div class="col-md-5">
                    <img src="{{ $recievedReq->property->photo }}" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-6">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-6 property-description">
                                <p>{{ $recievedReq->property->title }}</p>
                                <p>{{ $recievedReq->property->town->title }}</p>
                                <p>{{ $recievedReq->user->firstName }} {{ $booking->user->lastName }}</p>
                                <p>{{ \Carbon\Carbon::parse($recievedReq->startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($recievedReq->endDate)->format('d/m/Y') }}</p>
                                <p>Людей: <span>{{ $recievedReq->quantityGuests }}</span></p>
                                @if ($booking->status === 2)
                                    <p style="color: green">Заявка принята</p>
                                @endif
                                @if ($booking->status === 0)
                                    <p style="color: red">Заявка отклонена!</p>
                                @endif
                                @if ($booking->status === 1)
                                    <p style="color: yellow">Заявка на рассмотрении</p>
                                @endif
                                <p>Отправлено: {{ \Carbon\Carbon::parse($recievedReq->sendDate)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<style>
    p {
        color: #000000;
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        font-weight: 400;
    }
</style>
</body>
</html>