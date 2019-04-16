<template>
    <div class="single-property">
        <navbar></navbar>
        <div class="vld-parent">
            <loading 
            :active.sync="isLoading"
            :color="'#007bff'"
            :backgrounColor="'#c0c0c0'"
            :loader="'bars'">
            </loading>
        </div>
        <form method="post" enctype="multipart/form-data" class="container jumbotron mt-5">
            <div class="row">
                <div class="col-md-3">
                    <img v-if="propertyInfo.photo" :src="propertyInfo.photo" width="100%" height="auto" alt="room">
                    <img v-else src="/picture/placeholder.png" width="100%" height="auto" alt="room">
                </div>
                <div class="col-md-8">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="word-break: break-all; max-width: 100%">{{propertyInfo.title}}</p>
                                <p>{{town.title}}</p>
                                <p>Спальных мест: <span>{{propertyInfo.beds}}</span></p>
                                <p>Есть:</p>
                                <div class="feature-list">
                                    <div :key="feature.id" v-for="feature in propertyInfo.features">
                                        <div class="feature-list__item feature-list-item">
                                            <div class="feature-list-item__icon-wrap">
                                                <img :src="feature.image" :alt="feature.title" height="32" width="32">
                                            </div>
                                            <div class="feature-list-item__description"><span>{{feature.title}}</span></div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-2">Дополнительная информация:</p>
                                <p v-if="propertyInfo.extraInformation">{{ propertyInfo.extraInformation}}</p>
                                <p v-else>Не указана</p>
                            </div>
                            <div v-if="propertyInfo.ownerId == authUser.id" class="col-md-4">
                                <div class="row">
                                    <div class="col-md-2">
                                        <router-link :to="{name: 'editProperty', params: {id: propertyInfo.id}}" class="btn btn-primary mb-3">Редактировать</router-link>
                                        <button @click="deleteProperty" name="delete" class="btn btn-danger">Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <div v-if="propertyInfo.ownerId != authUser.id" class="col-md-5">
                                <h3 class="mb-3">Бронирование</h3>
                                <div v-if="msg" class="mt-4 alert alert-success" role="alert">
                                    {{msg}}
                                </div>
                                <div class="mb-3">
                                    <HotelDatePicker 
                                    :i18n="i18n" 
                                    format="DD/MM/YYYY"
                                    :startingDateValue="booking.startDate"
                                    :endingDateValue="booking.endDate"
                                    @check-in-changed="onCheckInChanged" 
                                    @check-out-changed="onCheckOutChanged">
                                    </HotelDatePicker>
                                </div>
                                <div class="mb-3">
                                    <v-select class="select-list-item" placeholder="Сколько гостей?" v-model="booking.guests" :options="guestsForSelect"></v-select>
                                </div>
                                <div class="text-center">
                                    <button type="button" @click="bookingRequest" class="btn btn-primary">Забронировать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import * as moment from 'moment-timezone';
import Navbar from './Navbar.vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
    components: {HotelDatePicker, Navbar, Loading},
    data() {
        return {
            propertyId: '',
            propertyInfo: [],
            authUser: '',
            town: [],
            booking: {
                startDate: moment.unix(this.$route.query.s).toDate(),
                endDate: moment.unix(this.$route.query.e).toDate(),
                guests: this.$route.query.g
            },
            msg: '',
            guestsForSelect: Array.apply(null, {length: 20}).map(Number.call, Number),
            i18n: {
                night: 'Ночь',
                nights: 'Ночей',
                'day-names': ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
                'check-in': 'Заезд',
                'check-out': 'Выезд',
                'month-names': ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            },
            isLoading: false
        }
    },
    mounted: function() {
        this.doAjax();
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
                    this.town = data.town;
                    this.isLoading = false;
                });
        },
        getAuthUser() {
            axios
                .get('/api/get-auth-user')
                .then(({data}) => {
                    this.authUser = data.authUser;
                })
        },
        deleteProperty() {
            axios
                .get('/api/delete/' + this.$route.params.id)
                .then(
                    this.$router.push({name: 'myproperties'})
                );
        },
        bookingRequest() {
            if (this.authUser == ''){
                this.$router.push({ name: 'login', query: { 
                    backUrl: '/property', 
                    id: this.$route.params.id,
                    s: this.$route.query.s, 
                    e: this.$route.query.e, 
                    g: this.$route.query.g 
                    }});
            }
            let data = {
                'startDate': moment(this.booking.startDate).unix(),
                'endDate': moment(this.booking.endDate).unix(),
                'guests': this.booking.guests,
                'guestId': this.authUser.id
            };
            axios
                .post('/api/book/' + this.$route.params.id, data)
                .then(({data}) => {
                    this.msg = data.msg;
                })
                .catch(({response}) => {
                    this.msg = response.data.msg;
                })
        },
        onCheckInChanged(checkIn) {
            this.booking.startDate = moment(checkIn).unix();
        },
        onCheckOutChanged(checkOut) {
            this.booking.endDate = moment(checkOut).unix();
        },
        doAjax() {
            this.isLoading = true;
            setTimeout(() => {}, 5000);
            this.takePropertyInfo();
            this.getAuthUser();
        }
    }
}
</script>

