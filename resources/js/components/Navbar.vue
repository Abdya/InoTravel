<template>
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
            authUser: null
        }
    },
    mounted: function() {
        this.getAuthUser();
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
            axios
                .post('/api/logout')
                .then(
                    this.$router.push({name: 'home'})
                );
        }
    }
}
</script>
<style>
.nav-link {
        color: white;
    }
</style>
