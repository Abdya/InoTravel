<template>

    <div class="flex-center position-ref full-height">
        <header class="top-right">
            <div v-if="authUser == null" class="links">
                <router-link to="/login">Войти</router-link>
                <router-link to="/registration">Регистрация</router-link>
                <router-link to="/login">Принять гостей</router-link>
            </div>
            <div v-else class="links">
                <router-link to="/profile">{{authUser.firstName}} {{authUser.lastName}}</router-link>
                <router-link to="/myproperties">Мое жилье</router-link>
                <router-link to="/requests">Заявки</router-link>
            </div>
        </header>
        <div class="content">
        <div class="title m-b-md">
            InoTravel
        </div>
        <form class="blur-form" @submit.prevent="getSearchInfo" method="get" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="flat-input col-md-12">
                    <selectpicker 
                    v-model="search.townId" 
                    class="select-list-item" 
                    :search="true" 
                    :list="towns"
                    placeholder="Куда едем?"
                    ></selectpicker>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <!-- <date-picker v-model="search.time" confirm range :lang="'ru'" value-type="timestamp" :first-day-of-week="1" placeholder="Select"></date-picker> -->
                    <HotelDatePicker :i18n="i18n" format="DD/MM/YYYY" @check-in-changed="onCheckInChanged" @check-out-changed="onCheckOutChanged" ></HotelDatePicker>
                </div>
                
            </div>
            <div class="row mb-5">
                <div class="flat-input col-md-12">
                    <input v-model="search.beds" class="flat-input__input" placeholder="Гости" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg">Начать поиск</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import * as moment from 'moment-timezone';

export default {
    components: {HotelDatePicker},
    data() {
        return {
            towns: [],
            search: {
                checkIn: '',
                checkOut: '',
                townId: '',
                beds: ''
            },
            authUser: '',
            i18n: {
                night: 'Ночь',
                nights: 'Ночей',
                'day-names': ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
                'check-in': 'Заезд',
                'check-out': 'Выезд',
                'month-names': ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            },
            guestsForSelect: Array.apply(null, {length: 20}).map(Number.call, Number)
        };
    },
    mounted: function() {
        this.getTowns();
        this.getAuthUser();
    },
    methods: {
        getTowns() {
            axios
                .get('/api/get-town')
                .then(({data}) => {
                    this.towns = data.towns.map((town) => {
                        return {
                            id: town.id,
                            name: town.title
                        };
                    });
                });
        },
        getSearchInfo() {
            let data = {
                'guests': this.search.beds,
                'startDate': this.search.checkIn,
                'endDate': this.search.checkOut,
                'townId': this.search.townId
            }
            this.$router.push({name: 'searchresults', query: {
                townId: data.townId,
                guests: data.guests,
                startDate: data.startDate,
                endDate: data.endDate
            }});
        },
        getAuthUser() {
            axios
                .get('/api/get-auth-user')
                .then(({data}) => {
                    this.authUser = data.authUser;
                })
        },
        logout() {
            axios
                .post('/api/logout')
                .then(
                    this.$router.push({name: 'home'})
                )
        },
        onCheckInChanged(checkIn) {
            this.search.checkIn = moment(checkIn).unix();
        },
        onCheckOutChanged(checkOut) {
            this.search.checkOut = moment(checkOut).unix();
        }
        
    }
}
</script>
<style>
    .select-list-item {
        color: black;
    }
    html, body {
        background-image: url("/picture/main_background.jpg");
        background-size: cover;
}
</style>