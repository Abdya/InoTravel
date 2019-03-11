<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
                <a href="/">Войти</a>
                <a href="/">Регистрация</a>
                <a href="/">Принять гостей</a>
        </div>
        <div class="content">
            <div class="title m-b-md">
                Password Reset
            </div>
            <form method="post" action="/properties" enctype="multipart/form-data" style="max-width: 620px">
                <div class="row mb-5">
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" name="email" placeholder="Email" type="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg" type="submit">Сбросить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
