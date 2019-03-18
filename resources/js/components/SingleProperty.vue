<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
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
        <form method="post" action="" enctype="multipart/form-data" class="container">
            <div class="row">
                <div class="col-md-4">
                    <img v-if="true" src="/picture/300.jpg" width="100%" height="auto" alt="room">
                    <img v-if="false" src="" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-8">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-8">
                                <p style="word-break: break-all; max-width: 100%">Awdawdawdd</p>
                                <p>Taganrog</p>
                                <p>Спальных мест: <span>5</span></p>
                            </div>
                            <div class="col-md-4">
                                <h3 class="mb-3">Бронирование</h3>
                                <div class="flat-input mb-3">
                                    <input class="datepicker flat-input__input" name="startDate" placeholder="Заезд" type="text">
                                </div>
                                <div class="flat-input mb-3">
                                    <input class="datepicker flat-input__input" name="endDate" placeholder="Выезд" type="text">
                                </div>
                                <div class="flat-input mb-3">
                                    <input class="flat-input__input" name="guests" placeholder="Гости" type="text">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Забронировать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Есть:</p>
                    <div class="feature-list">
                        <div class="feature-list__item feature-list-item">
                            <div class="feature-list-item__icon-wrap">
                                <img src="" alt="abdya" height="32" width="32">
                            </div>
                            <div class="feature-list-item__description">TV</div>
                        </div>
                    </div>
                    <p class="mt-2">Дополнительная информация:</p>
                    <p>Не указана</p>
                </div>
            </div>
        </form>
    </div>
</template>
