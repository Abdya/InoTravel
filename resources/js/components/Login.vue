<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
                <a href="/">Войти</a>
                <a href="/">Регистрация</a>
                <a href="/">Принять гостей</a>
        </div>
        <div class="content">
        <div class="title m-b-md">
            InoTravel::Login
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
                    <a class="forget-pass" href="/">Забыли пароль?</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-primary btn-lg" type="submit">Зарегистрироваться</a>
                    ИЛИ
                    <button class="btn btn-primary btn-lg" type="submit">Войти</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</template>
