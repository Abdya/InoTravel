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
                    <form method="get" style="max-width: 1080px">
                        <div class="row">
                            <div class="col">
                                <selectpicker 
                                class="select-list-item" 
                                :search="true" 
                                :list="towns"
                                placeholder="Куда едем?"
                                ></selectpicker>
                            </div>
                            <div class="flat-input col">
                                <date-picker confirm range :lang="'ru'" value-type="timestamp" :first-day-of-week="1" placeholder="Select"></date-picker>
                            </div>
                            <div class="flat-input col">
                                <input class="form-control mb-4" placeholder="Гости" type="text">
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
                    <div v-else :key="property.id" v-for="property in results" class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <router-link :to="{ name: 'property', params: {id: property.id}}"><img class="card-img-top" :src="property.photo" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap"></router-link>
                                <div class="card-body">
                                    <p class="card-text"><router-link :to="{ name: 'property', params: {id: property.id}}">{{property.title}}</router-link></p>
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
import DatePicker from 'vue2-datepicker';

export default {
    components: {DatePicker},
    data() {
        return {
            towns: [],
            results: [],
            townForShow: [],
            authUser: window.localStorage.getItem('user')
        };
    },
    mounted: function() {
        this.getTowns();
        this.getSearchResults();
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
                startDate: (this.$route.query.startDate)/1000,
                endDate: (this.$route.query.endDate)/1000,
            };
            axios
                .post('/api/search', data)
                .then(({data}) => {
                    this.results = data.properties;
                    this.townForShow = data.town;
                    console.log(data);
                })
        }
    }
}
</script>
<style scoped>
    h2, p {
        color: black;
    }
</style>
