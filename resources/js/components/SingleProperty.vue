<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <router-link class="navbar-brand" to="/">InoTravel</router-link>
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
        <form v-if="1 == 2" method="post" action="" enctype="multipart/form-data" class="container">
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
        <form  method="post" action="/profile/properties/create" enctype="multipart/form-data" class="container" style="width: 1400px;  max-width: 1400px">
            <div class="row">
                <div class="col-md-2">
                    <img src="/picture/300.jpg" width="100%" height="auto" alt="room" class="mb-4">
                    <input type="file" name="photo">
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="title" class="col-sm-5 col-form-label">Название:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Название">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="beds" class="col-sm-5 col-form-label">Количество cпальных мест:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="beds" name="beds" placeholder="Количество спальных мест">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Удобства:</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <div class="form-group row">
                                    <label for="town" class="col-sm-5 col-form-label">Город:</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" data-live-search="true" name="town" id="town">
                                            <option value="431">awdawdawd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-5 col-form-label">Адрес:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Улица, дом, квартира">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="form row">
                                    <label for="extraInformation" class="col-sm-5 col-form-label">Дополнительная информация:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control mb-4" id="houseName" name="extraInformation" placeholder="Расскажите о себе или жилье!"></textarea>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary btn-lg">Создать профиль</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
