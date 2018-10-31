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
    <link href="/css/searchResults.css" rel="stylesheet">
    <link href="/css/pickadate/classic.css" rel="stylesheet">
    <link href="/css/pickadate/classic.date.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/js/pickadate/picker.js"></script>
    <script src="/js/pickadate/picker.date.js"></script>
</head>

<body>

<main role="main">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">InoTravel</a>
    </nav>
    <section class="jumbotron text-center">
        <div class="container">
            <div style="max-width: 1080px">
                <div class="row">
                    <div class="col">
                        <input class="form-control" placeholder="Куда?" type="text">
                    </div>
                    <div class="flat-input col">
                        <input class="datepicker form-control" placeholder="Заезд" type="text">
                    </div>
                    <div class="flat-input col">
                        <input class="datepicker form-control" placeholder="Выезд" type="text">
                    </div>
                    <div class="flat-input col">
                        <input class="form-control mb-4" placeholder="Гости" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg" type="submit">Начать поиск</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($properties as $property)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <a href="/properties/{{ $property->id }}"><img class="card-img-top"  src="{{ $property->photo }}" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text"><a style="word-break: break-all; max-width: 100%" href="/properties/{{ $property->id }}">{{ $property->title }}</a></p>
                            <p class="card-text">{{ $property->town->title }}</p>
                            <p class="card-text">{{ $property->owner->firstName }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/properties/{{ $property->id }}" class="btn btn-sm btn-outline-secondary">Посмотреть</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
    </div>
</footer>
<script>$('.datepicker').pickadate({
        format: 'dd/mm/yy'
    })</script>
</body>
</html>