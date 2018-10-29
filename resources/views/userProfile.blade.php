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
<div class="container">
    <div class="row">

        <div class="col-md-10">
            <div class="row">
                <form method="post" action="/profile" class="container col-md-6" style="width: 1400px;  max-width: 1400px">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div>
                        <h2 class="mb-4">Редактировать данные</h2>
                    </div>
                    <div class="form-group row">
                        <label for="firstName" class="col-sm-5 col-form-label">Имя</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="firstName" value="{{ $user->firstName }}" id="firstName" placeholder="Имя">
                            @if ($errors->has('firstName'))

                                <span class="text-danger">{{ $errors->first('firstName') }}</span>

                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastName" class="col-sm-5 col-form-label">Фамилия</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}" placeholder="Фамилия">
                            @if ($errors->has('lastName'))

                                <span class="text-danger">{{ $errors->first('lastName') }}</span>

                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email">
                            @if ($errors->has('email'))

                                <span class="text-danger">{{ $errors->first('email') }}</span>

                            @endif
                        </div>
                    </div>
                    <div class="text-left mb-3 mt-3">
                        <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                    </div>
                </form>
                <form method="post" action="/profile/updatePassword" class="container col-md-6" style="width: 1400px;  max-width: 1400px">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div>
                        <h2 class="mb-4">Сменить пароль</h2>
                    </div>
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-5 col-form-label">Старый пароль</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="old_password" id="old_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-5 col-form-label">Новый пароль</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-5 col-form-label">Повторите пароль</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password_confirmation" id="password_confirmation">
                            @if ($errors->has('password_confirmation'))

                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

                            @endif
                        </div>
                    </div>
                    <div class="text-left mb-3 mt-3">
                        <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>