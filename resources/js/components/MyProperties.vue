<template>
    <div>
        <navbar></navbar>
        <div class="vld-parent">
            <loading 
            :active.sync="isLoading"
            :color="'#007bff'"
            :backgrounColor="'#c0c0c0'"
            :loader="'bars'">
            </loading>
        </div>
        <div v-if="propertiesList.length == 0" class=" mt-5 text-center">
            <h2>Вы еще не создали ни одного профиля жилья!</h2>
            <router-link to="/create" type="button" class="btn btn-primary mb-5">Добавить жилье</router-link>
        </div>
        <div class="container mt-4 jumbotron float-left mb-5">
            <h2 class="mb-5">Заявки</h2>
            <div v-if="incomingRequests.length == 0" class="text-center">
                <h2>У вас нет входящих заявок!</h2>
            </div>
            <div class="container float-left mb-5">
                <div :key="request.id" v-for="request in incomingRequests" class="row mb-5">
                    <div class="col-md-5">
                        <img v-if="request.property.photo" :src="request.property.photo" width="100%" height="auto" alt="room">
                        <img v-else src="/picture/300.jpg" width="100%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <p class="word-break: break-all; max-width: 100%">{{request.title}}</p>
                                    <p>{{request.property.town.title}}</p>
                                    <p>Заявка от: {{request.user.firstName}}</p>
                                    <p>{{ request.startDate | moment("DD/MM/YYYY")}} - {{ request.endDate | moment("DD/MM/YYYY")}}</p>
                                    <p>Людей: <span>{{request.quantityGuests}}</span></p>
                                    <div>
                                        <div class="row">
                                            <button type="submit" @click="approveRequest(request)" class="btn btn-success mr-1">Одобрить</button>
                                            <button type="submit" @click="rejectRequest(request)" class="btn btn-danger">Отклонить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="propertiesList.length != 0" class="container jumbotron float-left mb-5">
            <h2 class="mb-3">Жилье</h2>
            <router-link to="/create" type="button" class="btn btn-primary mb-5">Добавить жилье</router-link>
            <div class="container float-left mb-5">
                <div :key="property.id" v-for="property in propertiesList" class="row mb-5">
                    <div class="col-md-5">
                        <img v-if="property.photo == null" src="/picture/placeholder.png" width="75%" height="auto" alt="room">
                        <img v-else :src="property.photo" width="75%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <router-link :to="{ name: 'property', params: {id: property.id}}"><p style="color: black">{{property.title}}</p></router-link>
                                    <p style="color: black">{{property.town.title}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from './Navbar.vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    components: {Navbar, Loading},
    data() {
        return {
            incomingRequests: [],
            propertiesList: [],
            isLoading: false
        }
    },
    mounted: function() {
        this.doAjax();
    },
    methods: {
        loadIncomingRequests() {
            axios
                .get('/api/myproperties/requests')
                .then(({data}) => {
                    this.incomingRequests = data.incomingRequests;
                });
        },
        loadUserProperties() {
            axios
                .get('/api/myproperties')
                .then(({data}) => {
                    this.propertiesList = data.properties;
                    this.isLoading = false;
                });
        },
        rejectRequest(booking) {
            axios
                .post('/api/myproperties/reject', {
                    'bookingId': booking.id
                })
                .then(this.loadIncomingRequests);
        },
        approveRequest(booking) {
            axios
                .post('/api/myproperties/approve', {
                    'bookingId': booking.id
                })
                .then(this.loadIncomingRequests);
        },
        doAjax() {
            this.isLoading = true;
            setTimeout(() => {}, 5000)
            this.loadIncomingRequests();
            this.loadUserProperties();
        }
    }
}
</script>
<style scoped>
    .select-list-item {
        color: black;
    }
    .nav-link {
        color: white;
    }
    p {
        font-size: 20px;
        color: black;
    }
</style>