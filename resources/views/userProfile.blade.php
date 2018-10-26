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
                <a class="nav-link" href="#"><ins>{{ $user->firstName }} {{ $user->lastName }}</ins></a>
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
<form class="container" style="width: 1400px;  max-width: 1400px">
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <h2 class="mb-4">Редактировать данные</h2>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Имя</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  value="{{ $user->firstName }}" id="firstName" placeholder="Имя">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Фамилия</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastName" value="{{ $user->lastName }}" placeholder="Фамилия">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="{{ $user->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="text-left mb-3 mt-3">
                        <button type="button" class="btn btn-outline-primary">Сохранить</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <h2 class="mb-4">Сменить пароль</h2>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Старый пароль</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="oldPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Новый пароль</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Повторите пароль</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="secondPassword">
                        </div>
                    </div>
                    <div class="text-left mb-3 mt-3">
                        <button type="button" class="btn btn-outline-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>