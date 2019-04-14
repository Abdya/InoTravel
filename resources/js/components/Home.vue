<template>
<div>
    <navlinks></navlinks>
    <div class="flex-center position-ref full-height">
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
                        <v-select class="select-list-item" placeholder="Сколько гостей?" v-model="search.beds" :options="guestsForSelect"></v-select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary btn-lg">Начать поиск</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import * as moment from 'moment-timezone';
import NavLinks from './NavLinks.vue';

export default {
    components: {HotelDatePicker, NavLinks},
    data() {
        return {
            towns: [],
            search: {
                checkIn: '',
                checkOut: '',
                townId: '',
                beds: ''
            },
            authUser: null,
            i18n: {
                night: 'Ночь',
                nights: 'Ночей',
                'day-names': ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
                'check-in': 'Заезд',
                'check-out': 'Выезд',
                'month-names': ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            },
            guestsForSelect: Array.from(Array(20), (x, index) => index + 1)
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
                .catch()
        },
        logout() {
            auth.logout()
                .then(() => {
                    this.authUser = null;
                })
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
        background-color: white;
    }
</style>