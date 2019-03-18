<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            <router-link to="/login">Войти</router-link>
            <router-link to="/registration">Регистрация</router-link>
            <router-link to="/">Принять гостей</router-link>
        </div>
        <div class="content">
            <div class="title m-b-md">
                Регистрация
            </div>
            <form method="post" class="reg-form" enctype="multipart/form-data" style="max-width: 500px">
                <div class="row mb-5">
                    <div class="flat-input col-md-12 mb-3">
                        <input class="flat-input__input" name="firstName" placeholder="Имя" type="text">
                    </div>
                    <div class="flat-input col-md-12 mb-3">
                        <input class="flat-input__input" name="lastName" placeholder="Фамилия" type="text">
                    </div>
                    <div class="flat-input col-md-12 mb-3">
                        <input class="flat-input__input" name="email" placeholder="Email" type="email">
                    </div>
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" name="password" placeholder="Пароль" type="password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg" type="submit">Зарегистрироваться!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
