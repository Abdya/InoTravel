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
                <a class="nav-link" href="#">{{$user->firstName}} {{$user->lastName}}</a>
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
        <div class="col-md-3">
            <img src="{{ $property->photo }}" width="100%" height="auto" alt="room">
            <div class="text-center mb-3 mt-3">
                <button type="button" class="btn btn-outline-primary">Загрузить фото</button>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-outline-primary">Удалить фото</button>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Название:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="houseName" name="title" value="{{ $property->title }}" placeholder="Название">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Спальных мест:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="beds" value="{{ $property->beds }}" placeholder="Спальных мест">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Удобства:</div>
                        <div class="col-sm-10">
                            @foreach($features as $feature)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="feature_{{ $feature->id }}" name="features[]" @if ($property->features->contains($feature->id)) checked @endif>
                                    <label class="form-check-label" for="feature_{{ $feature->id }}">
                                        {{ $feature->title }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="form-group row">
                            <label for="town" class="col-sm-5 col-form-label">Город:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="town" id="town">
                                    @foreach ($towns as $town)
                                        <option @if ($property->townId == $town->id) selected @endif value="{{ $town->id }}">{{ $town->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-5 col-form-label">Адрес:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" value="{{ $property->address }}" placeholder="Адрес">
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
                                <textarea class="form-control mb-4" id="houseName" placeholder="Расскажите о себе или жилье!">{{ $property->extraInformation }}</textarea>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-lg">Обновить профиль</button>
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