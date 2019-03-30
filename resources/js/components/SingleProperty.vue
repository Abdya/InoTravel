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
        <form method="post" enctype="multipart/form-data" class="container">
            <div class="row">
                <div class="col-md-4">
                    <img v-if="propertyInfo.photo" :src="propertyInfo.photo" width="100%" height="auto" alt="room">
                    <img v-else src="/picture/300.jpg" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-8">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-8">
                                <p style="word-break: break-all; max-width: 100%">{{propertyInfo.title}}</p>
                                <p>{{town.title}}</p>
                                <p>Спальных мест: <span>{{propertyInfo.beds}}</span></p>
                            </div>
                            <div v-if="propertyInfo.ownerId != authUser.id" class="col-md-4">
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
                    <div :key="feature.id" v-for="feature in propertyInfo.features" class="feature-list">
                        <div class="feature-list__item feature-list-item">
                            <div class="feature-list-item__icon-wrap">
                                <img :src="feature.image" :alt="feature.title" height="32" width="32">
                            </div>
                            <div class="feature-list-item__description">{{feature.title}}</div>
                        </div>
                    </div>
                    <p class="mt-2">Дополнительная информация:</p>
                    <p v-if="propertyInfo.extraInformation">{{ propertyInfo.extraInformation}}</p>
                    <p v-else>Не указана</p>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            propertyId: '',
            propertyInfo: [],
            authUser: [],
            town: []
        }
    },
    mounted: function() {
        this.takePropertyInfo();
    },
    methods: {
        takePropertyId() {
            this.propertyId = this.$route.params.id;
        },
        takePropertyInfo() {
            axios
                .get('/api/properties/' + this.$route.params.id)
                .then(({data}) => {
                    console.log(data);
                    this.propertyInfo = data.property;
                    this.authUser = data.user;
                    this.town = data.town;
                });
        }
    }
}
</script>

<style scoped>
    .feature-list {
        display: inline-block;
    }

    .feature-list__item {
        width: 100px
    }

    .feature-list-item {
        text-align: center;
    }

    .feature-list-item__description {
        margin-top: 5px
    }
    .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
        width: 100%;
    }
    
    
</style>
