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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
    <a class="navbar-brand" href="#">InoTravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Иван Иванов</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Мое жилье <span class="badge badge-danger">1</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Заявки</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Выход</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container float-left mb-5">
    <h2>Заявки</h2>
    <div class="container float-left mb-5">
        @foreach($requests as $request)
            <div class="row">
                <div class="col-md-5">
                    <img src="/picture/room.jpg" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-6">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-6 property-description">
                                <p>Квартира на западном</p>
                                <p>Таганрог</p>
                                <p>Заявка от: {{ $request->user->firstName }}</p>
                                <p>25/11/18 - 25/11/21</p>
                                <p>Людей: <span>1</span></p>
                                <div>
                                    <button type="button" class="btn btn-success mr-1">Success</button>
                                    <button type="button" class="btn btn-danger">Warning</button>
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
    <a href="#" style="padding-left: 15px">Добавить жилье</a>
    <div class="container float-left mb-5">
        <div class="row">
            <div class="col-md-5">
                <img src="/picture/room.jpg" width="100%" height="auto" alt="room">
            </div>
            <div class="col-md-6">
                <div class="clearfix">
                    <div class="row">
                        <div class="col-md-6 property-description">
                            <p>Квартира на западном</p>
                            <p>Таганрог</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>