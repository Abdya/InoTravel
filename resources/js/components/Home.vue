<template>

    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            <router-link to="/login">Войти</router-link>
            <router-link to="/registration">Регистрация</router-link>
            <router-link to="/login">Принять гостей</router-link>
        </div>
        <div class="content">
        <div class="title m-b-md">
            InoTravel
        </div>
        <form class="main-form blur-form" @submit.prevent="getSearchInfo" method="get" action="/properties" enctype="multipart/form-data">
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
            authUser: window.localStorage.getItem('user')
        };
    },
    mounted: function() {
        this.getTowns();
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
        }
    }
}
</script>
<style scoped>
    .select-list-item {
        color: black;
    }
</style>