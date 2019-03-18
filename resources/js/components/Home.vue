<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            <router-link to="/login">Войти</router-link>
            <router-link to="/registration">Регистрация</router-link>
            <router-link to="/login">Принять гостей</router-link>
        </div>
        <div class="content">
        <div class="title m-b-md">
            InoTravel
        </div>
        <form method="get" action="/properties" enctype="multipart/form-data" style="max-width: 510px">
            <div class="row mb-3">
                <div class="flat-input col-md-12">
                    <select class="selectpicker" data-live-search="true" data-style="btn-primary" name="town" id="town">
                            <option value="2314231423">56456456</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="flat-input col-md-6">
                    <input class="datepicker flat-input__input" name="startDate" placeholder="Заезд" type="text">
                </div>
                <div class="flat-input col-md-6">
                    <input class="datepicker flat-input__input" name="endDate" placeholder="Выезд" type="text">
                </div>
            </div>
            <div class="row mb-5">
                <div class="flat-input col-md-12">
                    <input class="flat-input__input" name="guests" placeholder="Гости" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg" type="submit">Начать поиск</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</template>
