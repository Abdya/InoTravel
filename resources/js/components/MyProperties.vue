<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
            <router-link class="navbar-brand" to="/">InoTravel</router-link>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <div class="top-right links">
                        <router-link to="/profile"></router-link>
                        <router-link to="/myproperties"><ins>Мое жилье</ins></router-link>
                        <router-link to="/requests">Заявки</router-link>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                    </div>
                </ul>
            </div>
        </nav>
        <h2>Вы еще не создали ни одного профиля жилья!</h2>
        <div class="text-center">
            <router-link to="/property/create" type="button" class="btn btn-primary mb-5">Добавить жилье</router-link>
        </div>
        <div class="container float-left mb-5">
            <h2>Заявки</h2>
            <div class="container float-left mb-5">
                <div v-for="request in incomeRequests" class="row mb-5">
                    <div class="col-md-5">
                        <img v-if="true" src="/picture/300.jpg" width="100%" height="auto" alt="room">
                        <img v-if="false" src="" width="100%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <p class="word-break: break-all; max-width: 100%">{{request.title}}</p>
                                    <p>{{request.property.town.title}}</p>
                                    <p>Заявка от: {{request.user.firstName}}</p>
                                    <p>{{request.startDate}} {{request.endDate}}</p>
                                    <p>Людей: <span>{{request.quantityGuests}}</span></p>
                                    <div>
                                        <div class="row">
                                            <form method="post" action="/profile/properties/approve" enctype="multipart/form-data">
                                                <button type="submit" name="approve" value="" class="btn btn-success mr-1">Одобрить</button>
                                            </form>
                                            <form method="post" action="/profile/properties/reject" enctype="multipart/form-data">
                                                <button type="submit"  name="reject" value="" class="btn btn-danger">Отклонить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container float-left mb-5">
            <h2>Жилье</h2>
            <a href="#" type="submit" class="btn btn-primary mb-5" style="padding-left: 15px">Добавить жилье</a>
            <div class="container float-left mb-5">
                <div v-for="property in propertiesList" class="row mb-5">
                    <div class="col-md-5">
                        <img src="/picture/300.jpg" width="100%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <a href="#" class="word-break: break-all; max-width: 100%" style="color: black"><ins><p>{{property.title}}</p></ins></a>
                                    <p>{{property.town.title}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            incomeRequests: [],
            propertiesList: []
        }
    },
    mounted: function() {
        this.takeUserRequestsAndProperties();
    },
    methods: {
        takeUserRequestsAndProperties() {
            axios
                .get('/api/myproperties')
                .then(({data}) => {
                    this.incomeRequests = data.incomeRequests;
                    this.propertiesList = data.properties;
                    console.log(this.propertiesList);
                });
        }
    }
}
</script>