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
                    Регистрация
                </div>
                <form method="post" class="reg-form" data-vv-scope="register" enctype="multipart/form-data" @submit.prevent="register" style="max-width: 500px" novalidate>
                    <div class="row mb-5">
                        <div class="flat-input col-md-12 mb-3">
                            <input class="form-control" v-validate="'required|alpha_spaces|min:2|max:60'" v-model="firstName" name="firstName" placeholder="Имя" type="text">
                            <p v-if="errorsBack['firstName']">{{errorsBack["firstName"][0]}}</p>
                            <span style="color: tomato">{{ errors.first('register.firstName') }}</span>
                        </div>
                        <div class="flat-input col-md-12 mb-3">
                            <input class="form-control" v-validate="'required|alpha_spaces|min:2|max:60'" v-model="lastName" name="lastName" placeholder="Фамилия" type="text">
                            <p v-if="errorsBack['lastName']">{{errorsBack["lastName"][0]}}</p>
                            <span style="color: tomato">{{ errors.first('register.lastName') }}</span>
                        </div>
                        <div class="flat-input col-md-12 mb-3">
                            <input class="form-control" v-validate="'required|email'" v-model="email" name="email" placeholder="Email" type="email">
                            <p v-if="errorsBack['email']">{{errorsBack["email"][0]}}</p>
                            <span style="color: tomato">{{ errors.first('register.email') }}</span>
                        </div>
                        <div class="flat-input col-md-12 mb-3">
                            <input class="form-control" v-validate="'required|min:6'" v-model="password" name="password" placeholder="Пароль" type="password" ref="password">
                            <p v-if="errorsBack['password']">{{errorsBack["password"][0]}}</p>
                            <span style="color: tomato">{{ errors.first('register.password') }}</span>
                        </div>
                        <div class="flat-input col-md-12">
                            <input class="form-control" v-validate="'required|min:6|confirmed:password'" name="password_confirmation" placeholder="Повторите пароль" type="password">
                            <p v-if="errorsBack['password']">{{errorsBack["password"][0]}}</p>
                            <span style="color: tomato">{{ errors.first('register.password_confirmation') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary btn-lg">Зарегистрироваться!</button>
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
            firstName:'',
            lastName: '',
            email: '',
            password: '',
            errorsBack: {}
        };
    },

    methods: {
        register() {
            let data = {
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email,
                password: this.password
            };
            this.$validator.validateAll('register').then(result => {
                if (result) {
                    axios.post('/api/register', data)
                        .then(({data}) => {
                            axios.post('/api/login', {
                                username: this.email,
                                password: this.password
                            })
                                .then(({data}) => {
                                    auth.login(data.token, data.user);

                                    this.$router.push('/');
                                })
                                .catch(({response}) => {
                                    alert(response.data.message)
                                })
                        })
                        .catch(({response}) => {
                            this.errorsBack = response.data.errors;
                            console.log(response);
                        });
                    }
                })
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