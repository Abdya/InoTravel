<template>
    <div>
        <navbar></navbar>
        <div v-if="propertiesList.length == 0" class="text-center">
            <h2>Вы еще не создали ни одного профиля жилья!</h2>
            <router-link to="/create" type="button" class="btn btn-primary mb-5">Добавить жилье</router-link>
        </div>
        <div class="container float-left mb-5">
            <h2 class="mt-5 mb-5">Заявки</h2>
            <div v-if="incomingRequests.length == 0" class="text-center">
                <h3>У вас нет входящих заявок!</h3>
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
        <div class="container float-left mb-5">
            <h2 class="mb-3">Жилье</h2>
            <router-link to="/create" type="button" class="btn btn-primary mb-5">Добавить жилье</router-link>
            <div class="container float-left mb-5">
                <div :key="property.id" v-for="property in propertiesList" class="row mb-5">
                    <div class="col-md-5">
                        <img v-if="property.photo == null" src="/picture/300.jpg" width="100%" height="auto" alt="room">
                        <img v-else :src="property.photo" width="75%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <router-link :to="{ name: 'property', params: {id: property.id}}"><p>{{property.title}}</p></router-link>
                                    <p>{{property.town.title}}</p>
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
import Navbar from './Navbar.vue'
export default {
    components: {Navbar},
    data() {
        return {
            incomingRequests: [],
            propertiesList: [],
            authUser: ''
        }
    },
    mounted: function() {
        this.loadIncomingRequests();
        this.loadUserProperties();
        this.getAuthUser();
    },
    methods: {
        loadIncomingRequests() {
            axios
                .get('/api/myproperties/requests')
                .then(({data}) => {
                    this.incomingRequests = data.incomingRequests;
                    console.log(this.incomingRequests);
                });
        },
        loadUserProperties() {
            axios
                .get('/api/myproperties')
                .then(({data}) => {
                    this.propertiesList = data.properties;
                    console.log(this.propertiesList)
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
        getAuthUser() {
            axios
                .get('/api/get-auth-user')
                .then(({data}) => {
                    this.authUser = data.authUser;
                    console.log(this.authUser);
                })
        },
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
        color: white;
    }
</style>