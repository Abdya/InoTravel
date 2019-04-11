<template>
<div>
    <nav class="mt-2">
            <ul class="nav justify-content-end">
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
    </nav>
    <div class="flex-center position-ref full-height">
        <div class="content blur-form">
            <div class="title m-b-md">
                Войти
            </div>
            <form method="post" enctype="multipart/form-data" @submit.prevent="login" style="max-width: 620px">
                <div class="row mb-5">
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" name="username" v-model="username" placeholder="Email" type="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" name="password" v-model="password" placeholder="Пароль" type="password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <router-link to="/registration" class="btn btn-primary btn-lg">Зарегистрироваться</router-link>
                        ИЛИ
                        <button class="btn btn-primary btn-lg">Войти</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-left">
                        <router-link to="/reset" class="forget-pass"><h5>Забыли пароль?</h5></router-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    
</template>

<script>
export default {
    data() {
        return {
            username: '',
            password: '',
        };
    },

    methods: {
        login() {
            let data = {
                username: this.username,
                password: this.password
            };

            axios.post('/api/login', data)
                .then(({data}) => {
                    auth.login(data.token, data.user);

                    this.$router.push('/profile');
                })
                .catch(({response}) => {
                    alert(response.data.message)
                })
        }
    }
}
</script>

