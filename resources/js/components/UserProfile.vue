<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
            <router-link class="navbar-brand" to="/">InoTravel</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <div class="top-right links profile">
                        <router-link to="/profile">Nikita Orobenko</router-link>
                        <router-link to="/myproperties"><ins>Мое жилье</ins></router-link>
                        <router-link to="/requests">Заявки</router-link>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                    </div>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <form method="post" action="" class="container col-md-6" style="width: 1400px;  max-width: 1400px">
                            <div>
                                <h2 class="mb-4">Редактировать данные</h2>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" class="col-sm-5 col-form-label">Имя</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  name="firstName" value="adawwdff" id="firstName" placeholder="Имя">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" class="col-sm-5 col-form-label">Фамилия</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="afawffggbbb" placeholder="Фамилия">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-5 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="awddawgfawf" placeholder="Email">
                                </div>
                            </div>
                            <div class="text-left mb-3 mt-3">
                                <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                            </div>
                        </form>
                        <form method="post" action="" class="container col-md-6" style="width: 1400px;  max-width: 1400px">
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
    </div>
</template>
