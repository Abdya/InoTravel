<template>
    <nav class="mt-2">
        <ul v-if="authUser == null" class="nav justify-content-end">
            <li class="nav-item">
                <router-link class="nav-link" to="/login">Войти</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/registration">Регистрация</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'login', query: { backUrl: '/create' }}">Принять гостей</router-link>
            </li>
        </ul> 
        <ul v-else class="nav justify-content-end">
            <li class="nav-item">
                <router-link class="nav-link" to="/profile">{{authUser.firstName}} {{authUser.lastName}}</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/myproperties">Мое жилье</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/requests">Заявки <span v-if="requestQuantity > 0" class="badge badge-light">{{requestQuantity}}</span></router-link>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="logout">Выйти</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            authUser: null,
            requestQuantity: ''
        }
    },
    mounted: function() {
        this.getAuthUser();
        this.getRequestQuantity();
    },
    methods: {
        getAuthUser() {
            axios
                .get('/api/get-auth-user')
                .then(({data}) => {
                    this.authUser = data.authUser;
                })
        },
        logout() {
            auth.logout()
                .then(() => {
                    this.authUser = null;
                    this.$router.push({name: 'home'})
                })
        },
        getRequestQuantity() {
            axios
                .get('/api/get-requests')
                .then(({data}) => {
                    this.requestQuantity = (data.requests).length;
                    console.log(this.requestQuantity)
                })
        }
    }
}
</script>