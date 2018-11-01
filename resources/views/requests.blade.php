<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Requests</title>


    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-brand">
        <a  href="#">InoTravel</a> / <span >Заявки</span>
    </div>
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
<div class="container float-left">
    @foreach($bookings as $booking)
        <div class="row">
            <div class="col-md-5">
                <img src="{{ $booking->property->photo }}" width="100%" height="auto" alt="room">
            </div>
            <div class="col-md-6">
                <div class="clearfix">
                    <div class="row">
                        <div class="col-md-6">
                            <p>{{ $booking->property->title }}</p>
                            <p>{{ $booking->property->town->title }}</p>
                            <p>{{ $booking->user->firstName }}</p>
                            <p>{{ \Carbon\Carbon::parse($booking->startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($booking->endDate)->format('d/m/Y') }}</p>
                            <p>Людей: <span>{{ $booking->quantityGuests }}</span></p>
                            @if ($booking->status === 2)
                                <p style="color: green">Заявка принята</p>
                            @endif
                            @if ($booking->status === 0)
                                <p style="color: red">Заявка отклонена!</p>
                            @endif
                            @if ($booking->status === 1)
                                <p style="color: yellow">Заявка на рассмотрении</p>
                            @endif
                            <p>Отправлено: {{ \Carbon\Carbon::parse($booking->sendDate)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>