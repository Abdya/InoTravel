<template>
    <div>
        <main role="main">
            <navbar></navbar>
            <section class="jumbotron text-center mt-4">
                <div class="container">
                    <form method="get" @submit.prevent="getSearchResultsFromPage" style="max-width: 1080px">
                        <div class="row">
                            <div v-if="towns.length" class="col-md-3">
                                <selectpicker 
                                class="select-list-item" 
                                :search="true" 
                                :list="towns"
                                placeholder="Куда едем?"
                                v-model="townId"
                                ></selectpicker>
                            </div>
                            <div class="flat-input col">
                                <HotelDatePicker :i18n="i18n" format="DD/MM/YYYY" @check-in-changed="onCheckInChanged" @check-out-changed="onCheckOutChanged" ></HotelDatePicker>
                            </div>
                            <div class="flat-input col-md-3">
                                <v-select class="select-list-item" placeholder="Сколько гостей?" v-model="guests" :options="guestsForSelect"></v-select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg">Начать поиск</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <div class="album py-5 bg-light">
                <div class="container">
                    <div v-if="results.length == 0">
                        <h2> Ничего не найдено!</h2>
                    </div>
                    <div v-else class="card-deck">
                        <div :key="property.id" v-for="property in results">
                            <div class="card mb-4 shadow-sm">
                                <router-link :to="{ name: 'property', params: {id: property.id}}">
                                    <img v-if="property.photo" class="card-img-top" :src="property.photo" width="339px" height="200px" alt="room">
                                    <img v-else src="/picture/placeholder.png" class="card-img-top" width="339px" height="200px" alt="room placeholder">
                                </router-link>
                                <div class="card-body">
                                    <h5 class="card-title"><router-link :to="{ name: 'property', params: {id: property.id}}">{{property.title}}</router-link></h5>
                                    <p class="card-text">{{townForShow.title}}</p>
                                    <p class="card-text">{{property.owner.firstName}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <router-link class="btn btn-primary" :to="{ name: 'property', params: {id: property.id}}">Посмотреть</router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                    <a href="#">Вверх</a>
                </p>
            </div>
        </footer>
    </div>
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import * as moment from 'moment-timezone';
import Navbar from './Navbar.vue'

export default {
    components: {HotelDatePicker, Navbar},
    data() {
        return {
            towns: [],
            results: [],
            townForShow: [],
            authUser: '',
            i18n: {
                night: 'Ночь',
                nights: 'Ночей',
                'day-names': ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
                'check-in': 'Заезд',
                'check-out': 'Выезд',
                'month-names': ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            },
            townId: this.$route.query.townId,
            startDate: '',
            endDate: '',
            guests: this.$route.query.guests,
            guestsForSelect: Array.from(Array(20), (x, index) => index + 1)
        };
    },
    mounted: function() {
        this.getTowns();
        this.getSearchResults();
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
        getSearchResults() {
            console.log(this.$route);
            let data = {
                townId: this.$route.query.townId,
                guests: this.$route.query.guests,
                startDate: this.$route.query.startDate,
                endDate: this.$route.query.endDate,
            };
            axios
                .post('/api/search', data)
                .then(({data}) => {
                    this.results = data.properties;
                    this.townForShow = data.town;
                    console.log(data);
                })
        },
        getSearchResultsFromPage() {
            let data = {
                townId: this.townId,
                startDate: this.startDate,
                endDate: this.endDate,
                guests: this.guests
            }

            this.$router.push({name: 'searchresults', query: {
                townId: data.townId,
                guests: data.guests,
                startDate: data.startDate,
                endDate: data.endDate
            }});
            this.getSearchResults();
        },
        onCheckInChanged(checkIn) {
            this.startDate = moment(checkIn).unix();
        },
        onCheckOutChanged(checkOut) {
            this.endDate = moment(checkOut).unix();
        }
    }
}
</script>
<style scoped>
    h2, p {
        color: black;
    }
    .select-list-item {
        color: black;
        background-color: white;
    }
</style>
