<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            <router-link to="/login">Войти</router-link>
            <router-link to="/registration">Регистрация</router-link>
            <router-link to="/">Принять гостей</router-link>
        </div>
        <div class="content">
        <div class="title m-b-md">
            Войти
        </div>
        <form method="post" action="/properties" enctype="multipart/form-data" style="max-width: 620px">
            <div class="row mb-5">
                <div class="flat-input col-md-12">
                    <input class="flat-input__input" name="guests" placeholder="Email" type="email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="flat-input col-md-12">
                    <input class="flat-input__input" name="guests" placeholder="Пароль" type="password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-left">
                    <router-link to="/reset" class="forget-pass">Забыли пароль?</router-link>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg" type="submit">Зарегистрироваться</button>
                    ИЛИ
                    <button class="btn btn-primary btn-lg" type="submit">Войти</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</template>
