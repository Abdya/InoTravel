<template>
    <div>
        <main role="main">
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
            <section class="jumbotron text-center">
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
                    <div v-else class="row">
                        <div :key="property.id" v-for="property in results">
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <router-link :to="{ name: 'property', params: {id: property.id}}">
                                        <img v-if="property.photo" class="card-img-top" :src="property.photo" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                                        <img v-else src="/picture/placeholder.png" class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="room placeholder">
                                        </router-link>
                                    <div class="card-body">
                                        <p class="card-text"><router-link :to="{ name: 'property', params: {id: property.id}}"><b>{{property.title}}</b></router-link></p>
                                        <p class="card-text">{{townForShow.title}}</p>
                                        <p class="card-text">{{property.owner.firstName}}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <router-link :to="{ name: 'property', params: {id: property.id}}">Посмотреть</router-link>
                                            </div>
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

export default {
    components: {HotelDatePicker},
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
            guestsForSelect: Array.apply(null, {length: 20}).map(Number.call, Number)
        };
    },
    mounted: function() {
        this.getTowns();
        this.getSearchResults();
        console.log(this.townId);
    },
    methods: {
        getTowns() {
            axios
                .get('/api/get-towns')
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
