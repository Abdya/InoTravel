<template>
    <div>
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
        <div class="container float-left mb-5">
            <h2>Отправленные</h2>
            <div class="container float-left mb-5">
                <div class="row mt-4 mb-5">
                    <div class="col-md-5">
                        <img src="" width="100%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <p>Пушкино</p>
                                    <p>Таганрог</p>
                                    <p>Петр Васечкин</p>
                                    <p>12-10-1999 30-11-2018</p>
                                    <p>Людей: <span>45</span></p>
                                    <p><span class="badge badge-warning">Заявка на рассмотрении</span></p>
                                    <p>Отправлено: 15-46-2019</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container float-left mb-5">
            <h2>Полученные</h2>
            <div class="container float-left mb-5">
                <div class="row mt-4 mb-5">
                    <div class="col-md-5">
                        <img src="" width="100%" height="auto" alt="room">
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-6 property-description">
                                    <p>Кукушкино</p>
                                    <p>Таганрог</p>
                                    <p>Петр Васечкин</p>
                                    <p>12/15/2018 - 46/79/2019</p>
                                    <p>Людей: <span>18</span></p>
                                    <p style="color: green">Заявка принята</p>
                                    <p>Отправлено: 22/55/2018</p>
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
export default {
    data() {
        return {
            
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
</style>