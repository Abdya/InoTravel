<template>
    <div>
        <main role="main">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
                <router-link class="navbar-brand" to="/">InoTravel</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <div class="top-right links">
                            <router-link to="/profile">Nikita Orobenko</router-link>
                            <router-link to="/myproperties"><ins>Мое жилье</ins></router-link>
                            <router-link to="/requests">Заявки</router-link>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                        </div>
                    </ul>
                </div>
            </nav>
            <section class="jumbotron text-center">
                <div class="container">
                    <form method="get" action="/properties" style="max-width: 1080px">
                        <div class="row">
                            <div class="col">
                                <select class="selectpicker" data-live-search="true" name="town" id="town">
                                        <option selected>14651456</option>
                                </select>
                            </div>
                            <div class="flat-input col">
                                <input class="datepicker form-control" value="" name="startDate" placeholder="Заезд" type="text">
                            </div>
                            <div class="flat-input col">
                                <input class="datepicker form-control" name="endDate" value="" placeholder="Выезд" type="text">
                            </div>
                            <div class="flat-input col">
                                <input class="form-control mb-4" name="guests" value="" placeholder="Гости" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg" type="submit">Начать поиск</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <a href="#"><img class="card-img-top"  src="" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap"></a>
                                <div class="card-body">
                                    <p class="card-text"><a style="word-break: break-all; max-width: 100%" href="#">Kukushkino</a></p>
                                    <p class="card-text">Taganrog</p>
                                    <p class="card-text">Owner Nikita</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <router-link to="/property" class="btn btn-sm btn-outline-secondary">Посмотреть</router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                    <a href="#">Вверх</a>
                </p>
            </div>
        </footer>
    </div>
</template>
