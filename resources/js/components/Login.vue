<template>
<div>
    <nav class="mt-2">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <router-link style="color: white" class="navbar-brand" to="/">InoTravel</router-link>
            </li>
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
    </nav>
    <div class="flex-center position-ref full-height">
        <div class="content blur-form">
            <div class="title m-b-md">
                Войти
            </div>
            <form method="post" enctype="multipart/form-data" @submit.prevent="login" data-vv-scope="login" style="max-width: 620px">
                <div class="row mb-5">
                    <div class="flat-input col-md-12">
                        <input class="form-control" v-validate="'required|email'" name="email" v-model="username" placeholder="Email" type="email">
                        <span style="color: tomato">{{ errors.first('login.email') }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="flat-input col-md-12">
                        <input class="form-control" v-validate="'required'" name="password" v-model="password" placeholder="Пароль" type="password">
                        <span style="color: tomato">{{ errors.first('login.password') }}</span>
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
            this.$validator.validateAll('login').then(result => {
                if (result) {
                    axios.post('/api/login', data)
                        .then(({data}) => {
                            auth.login(data.token, data.user);
                            if (this.$route.query.backUrl == '/create') {
                                this.$router.push(this.$route.query.backUrl);
                                return;
                            }
                            if (this.$route.query.backUrl == '/property') {
                                this.$router.push({name: 'property', params: {id: this.$route.query.id}, query: {
                                    s: this.$route.query.s,
                                    e: this.$route.query.e,
                                    g: this.$route.query.g,
                                }});
                                return;
                            }

                            this.$router.push('/profile');
                        })
                        .catch(({response}) => {
                            alert(response.data.message)
                        })
                    }
            });
        }
    }
}
</script>

<style>
    input:valid {
        border-color: green;
    }

    input:invalid {
        border-color: red;
    }
</style>