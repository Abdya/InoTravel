<template>
    <div>
        <navbar></navbar>
        <div class="container mt-5 float-left mb-5">
            <h2>Отправленные</h2>
            <div v-if="submittedReq.length > 0">
                <div :key="request.id" v-for="request in submittedReq" class="container float-left mb-5">
                    <div class="row mt-4 mb-5">
                        <div class="col-md-5">
                            <img v-if="request.photo" :src="request.photo" width="100%" height="auto" alt="room">
                            <img v-else src="/picture/placeholder.png" width="100%" height="auto" alt="room">
                        </div>
                        <div class="col-md-6">
                            <div class="clearfix">
                                <div class="row">
                                    <div class="col-md-6 property-description">
                                        <p>{{request.title}}</p>
                                        <p>{{request.town.title}}</p>
                                        <p>{{request.owner.firstName}} {{request.owner.lastName}}</p>
                                        <p>{{ request.startDate | moment("DD/MM/YYYY")}} - {{ request.endDate | moment("DD/MM/YYYY")}}</p>
                                        <p>Людей: <span>{{request.quantityGuests}}</span></p>
                                        <p v-if="request.status == 2"><span class="badge badge-success">Заявка принята</span></p>
                                        <p v-if="request.status == 0"><span class="badge badge-danger">Заявка отклонена!</span></p>
                                        <p v-if="request.status == 1"><span class="badge badge-warning">Заявка на рассмотрении</span></p>
                                        <p>Отправлено: {{ request.sendDate | moment("DD/MM/YYYY")}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <h4>У вас нет отправленных заявок!</h4>
            </div>
        </div>
        <div class="container float-left mb-5">
            <h2>Полученные</h2>
            <div v-if="receivedReq.length > 0">
                <div :key="request.id" v-for="request in receivedReq" class="container float-left mb-5">
                    <div class="row mt-4 mb-5">
                        <div class="col-md-5">
                            <img v-if="request.photo" :src="request.photo" width="100%" height="auto" alt="room">
                            <img v-else src="/picture/placeholder.png" width="100%" height="auto" alt="room">
                        </div>
                        <div class="col-md-6">
                            <div class="clearfix">
                                <div class="row">
                                    <div class="col-md-6 property-description">
                                        <p>{{request.title}}</p>
                                        <p>{{request.town.title}}</p>
                                        <p>{{request.user.firstName}} {{request.user.lastName}}</p>
                                        <p>{{ request.startDate | moment("DD/MM/YYYY")}} - {{ request.endDate | moment("DD/MM/YYYY")}}</p>
                                        <p>Людей: <span>{{request.quantityGuests}}</span></p>
                                        <p v-if="request.status == 2" style="color: green">Заявка принята</p>
                                        <p v-if="request.status == 0" style="color: red">Заявка отклонена!</p>
                                        <p v-if="request.status == 1" style="color: yellow">Заявка на рассмотрении</p>
                                        <p>Отправлено: {{ request.sendDate | moment("DD/MM/YYYY")}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <h4>У вас нет полученных заявок!</h4>
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
            submittedReq: [],
            receivedReq: []
        }
    },
    mounted: function() {
        this.getUserRequestHistory();
    },
    methods: {
        getUserRequestHistory() {
            axios
                .get('/api/requests')
                .then(({data}) => {
                    this.submittedReq = data.submittedRequests;
                    this.receivedReq = data.receivedRequests;
                })
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
        font-size: 17px;
    }
</style>