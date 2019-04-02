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
        <form class="blur-form" @submit.prevent="getSearchInfo" method="get" action="/properties" enctype="multipart/form-data">
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
                <div class="col-md-6">
                    <date-picker v-model="search.time" confirm range :lang="'ru'" value-type="timestamp" :first-day-of-week="1" placeholder="Select"></date-picker>
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
import DatePicker from 'vue2-datepicker';

export default {
    components: {DatePicker},
    data() {
        return {
            towns: [],
            search: {
                time: '',
                townId: '',
                beds: ''
            },
            authUser: ''
        };
    },
    mounted: function() {
        this.getTowns();
        this.getAuthUser();
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
        getSearchInfo() {
            let data = {
                'guests': this.search.beds,
                'startDate': this.search.time[0],
                'endDate': this.search.time[1],
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
                    console.log(this.authUser);
                })
        },
        logout() {
            axios
                .post('/api/logout')
                .then(
                    this.$router.push({name: 'home'})
                )
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