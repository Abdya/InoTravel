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
        <form class="main-form blur-form" method="get" action="/properties" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="flat-input col-md-12">
                    <selectpicker class="select-list-item" :search="true" :list="towns"></selectpicker>
                </div>
            </div>
            <div class="row mb-3">
                <div class="flat-input col-md-6">
                    <date-picker v-model="time1" range :lang="'ru'" :first-day-of-week="1"></date-picker>
                </div>
            </div>
            <div class="row mb-5">
                <div class="flat-input col-md-12">
                    <input class="flat-input__input" name="guests" placeholder="Гости" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg" type="submit">Начать поиск</button>
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
            search: [],
            time1: ''
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
    }
}
</script>
<style scoped>
    .select-list-item {
        color: black;
    }
</style>