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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a class="nav-link" href="#">Мое жилье</a>
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
        <div class="col-md-2">
            <img src="/picture/300.jpg" width="100%" height="auto" alt="room">
            <div class="text-center mb-3 mt-3">
                <button type="button" class="btn btn-outline-primary">Загрузить фото</button>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-outline-primary">Удалить фото</button>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Название:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="houseName" placeholder="Однушка в Москве">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Спальных мест:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="beds" placeholder="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Удобства:</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Интернет
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Wi-Fi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Кабельное ТВ
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Кондиционер
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Стиральная машина
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Город:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="city" placeholder="Москва">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-5 col-form-label">Адрес:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" placeholder="Ул.Пушкина">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Ограничения:</div>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Животные
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Комнатные растения
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Нельзя курить
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Нельзя пить
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <div class="form row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Дополнительная информация:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control mb-4" id="houseName" placeholder="Добро пожаловать!"></textarea>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-lg">Создать профиль</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
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