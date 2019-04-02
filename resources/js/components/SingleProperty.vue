<template>
    <div>
        <nav class="navbar navbar-dark bg-dark">
            <router-link class="navbar-brand" to="/">InoTravel</router-link>
            <ul v-if="authUser == null" class="nav justify-content-center-end">
                <li class="nav-item">
                    <router-link class="nav-link" to="/login">Войти</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/registration">Регистрация</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/login">Принять гостей</router-link>
                </li>
            </ul> 
            <ul v-else class="nav justify-content-center-end">
                <li class="nav-item">
                    <router-link class="nav-link" to="/profile">{{authUser.firstName}} {{authUser.lastName}}</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/myproperties">Мое жилье</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/requests">Заявки</router-link>
                </li>
            </ul>
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
                            <div v-if="propertyInfo.ownerId == authUser.id" class="col-md-4">
                                <div class="row">
                                    <div class="col-md-2">
                                        <router-link :to="{name: 'editProperty', params: {id: propertyInfo.id}}" class="btn btn-primary mb-3">Редактировать</router-link>
                                        <button @click="deleteProperty" name="delete" class="btn btn-danger">Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <div v-if="propertyInfo.ownerId != authUser.id" class="col-md-4">
                                <h3 class="mb-3">Бронирование</h3>
                                <div class="col-md-6 mb-3">
                                    <date-picker v-model="booking.time" confirm range :lang="'ru'" value-type="timestamp" :first-day-of-week="1" placeholder="Select"></date-picker>
                                </div>
                                <div class="flat-input mb-3">
                                    <input class="flat-input__input" v-model="booking.guests" placeholder="Гости" type="text">
                                </div>
                                <div class="text-center">
                                    <button type="button" @click="bookingRequest" class="btn btn-primary">Забронировать</button>
                                    <div v-if="msg != null">
                                        <p>{{msg}}</p>
                                    </div>
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
import DatePicker from 'vue2-datepicker';

export default {
    components: {DatePicker},
    data() {
        return {
            propertyId: '',
            propertyInfo: [],
            authUser: [],
            town: [],
            booking: {
                time: '',
                guests: ''
            },
            msg: ''
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
                    this.propertyInfo = data.property;
                    this.authUser = data.user;
                    this.town = data.town;
                });
        },
        deleteProperty() {
            axios
                .get('/api/delete/' + this.$route.params.id)
                .then(
                    this.$router.push({name: 'myproperties'})
                );
        },
        bookingRequest() {
            if (this.authUser == null){
                this.$router.push({name: 'login'});
            }
            let data = {
                'startDate': (this.booking.time[0])/1000,
                'endDate': (this.booking.time[1])/1000,
                'guests': this.booking.guests,
                'guestId': this.authUser.id
            };
            axios
                .post('/api/book/' + this.$route.params.id, data)
                .then(({data}) => {
                    this.msg = data.msg;
                    console.log(data);
                })
                .catch(({response}) => {
                    this.msg = response.data.msg;
                    console.log(response);
                })
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
    
    .nav-link {
        color: white;
    }
    p {
        font-size: 20px;
        color: white;
    }
</style>
