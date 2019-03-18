<template>
    <div>
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
        <div class="container float-left mb-5">
            <h2>Отправленные</h2>
            <div class="container float-left mb-5">
                <div class="row mt-4 mb-5">
                    <div class="col-md-5">
                        <img src="" width="100%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <p>Пушкино</p>
                                    <p>Таганрог</p>
                                    <p>Петр Васечкин</p>
                                    <p>12-10-1999 30-11-2018</p>
                                    <p>Людей: <span>45</span></p>
                                    <p><span class="badge badge-warning">Заявка на рассмотрении</span></p>
                                    <p>Отправлено: 15-46-2019</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container float-left mb-5">
            <h2>Полученные</h2>
            <div class="container float-left mb-5">
                <div class="row mt-4 mb-5">
                    <div class="col-md-5">
                        <img src="" width="100%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <p>Кукушкино</p>
                                    <p>Таганрог</p>
                                    <p>Петр Васечкин</p>
                                    <p>12/15/2018 - 46/79/2019</p>
                                    <p>Людей: <span>18</span></p>
                                    <p style="color: green">Заявка принята</p>
                                    <p>Отправлено: 22/55/2018</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
