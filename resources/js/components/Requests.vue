<template>
    <div>
        <navbar></navbar>
        <div class="container jumbotron mt-5 float-left mb-5">
            <h2>Отправленные</h2>
            <div v-if="submittedReq.length > 0">
                <div :key="request.id" v-for="request in submittedReq" class="container float-left mb-5">
                    <div class="media mb-4 bg-light">
                        <img v-if="request.photo" :src="request.photo" class="media-left mr-3" width="400" height="auto" alt="room">
                        <img v-else src="/picture/placeholder.png" class="media-left" width="400" height="auto" alt="room">
                        <div class="media-body">
                            <p class="card-text">{{request.title}}</p>
                            <p class="card-text">{{request.town.title}}</p>
                            <p class="card-text">{{request.owner.firstName}} {{request.owner.lastName}}</p>
                            <p class="card-text">{{ request.startDate | moment("DD/MM/YYYY")}} - {{ request.endDate | moment("DD/MM/YYYY")}}</p>
                            <p class="card-text">Людей: <span>{{request.quantityGuests}}</span></p>
                            <p class="card-text" v-if="request.status == 2"><span class="badge txt badge-success">Заявка принята!</span></p>
                            <p class="card-text" v-if="request.status == 0"><span class="badge txt badge-danger">Заявка отклонена!</span></p>
                            <p class="card-text" v-if="request.status == 1"><span class="badge txt badge-warning">Заявка на рассмотрении!</span></p>
                            <p class="card-text">Отправлено: {{ request.sendDate | moment("DD/MM/YYYY")}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <h4>У вас нет отправленных заявок!</h4>
            </div>
        </div>
        <div class="container jumbotron float-left mb-5">
            <h2>Полученные</h2>
            <div v-if="receivedReq.length > 0">
                <div :key="request.id" v-for="request in receivedReq" class="container float-left mb-5">
                    <div class="media mb-4 bg-light">
                        <img v-if="request.photo" :src="request.photo" class="media-left mr-3" width="400" height="auto" alt="room">
                        <img v-else src="/picture/placeholder.png" class="media-left" width="100%" height="auto" alt="room">
                        <div class="media-body">
                            <p class="card-text">{{request.title}}</p>
                            <p class="card-text">{{request.town.title}}</p>
                            <p class="card-text">{{request.user.firstName}} {{request.user.lastName}}</p>
                            <p class="card-text">{{ request.startDate | moment("DD/MM/YYYY")}} - {{ request.endDate | moment("DD/MM/YYYY")}}</p>
                            <p class="card-text">Людей: <span>{{request.quantityGuests}}</span></p>
                            <p class="card-text" v-if="request.status == 2"><span class="badge txt badge-success">Заявка принята!</span></p>
                            <p class="card-text" v-if="request.status == 0"><span class="badge txt badge-danger">Заявка отклонена!</span></p>
                            <p class="card-text" v-if="request.status == 1"><span class="badge txt badge-warning">Заявка на рассмотрении!</span></p>
                            <p class="card-text">Отправлено: {{ request.sendDate | moment("DD/MM/YYYY")}}</p>
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
    .card-text {
        line-height: 1.3;
    }
    span.txt {
        color: white;
        font-size: 13px;
    }
</style>