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
        </ul>
    </nav>
        <div class="flex-center position-ref full-height main-content">
            <div class="content blur-form">
                <div class="title m-b-md">
                    Сброс пароля
                </div>
                <form method="post" class="pass-change-form" @submit.prevent="checkPass" enctype="multipart/form-data" style="max-width: 500px">
                    <div class="row mb-5">
                        <div class="flat-input col-md-12 mb-3">
                            <input class="form-control" v-model="pass1" name="pass1" placeholder="Введите новый пароль" type="password">
                        </div>
                        <div class="flat-input col-md-12">
                            <input class="form-control" v-model="pass2" name="pass2" placeholder="Повторите" type="password">
                        </div>
                        <div v-if="error" class="col-md-12">
                            <p>{{error}}</p>
                        </div>
                        <div v-if="formError" class="alert alert-danger mt-3 col-md-12" role="alert">
                            {{formError}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Обновить пароль</button>
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
                pass1: '',
                pass2: '',
                error: '',
                formError: ''
            };
        },

        methods: {
            checkPass: function () {
                if (this.pass1 == this.pass2) {
                    let data = {
                        pass: this.pass1,
                        user_id: this.$route.query.user_id,
                        token: this.$route.query.token,
                    };
                    console.log(this.$route.query);
                    axios
                        .post('/api/password-reset/confirm', data)
                        .catch(
                            this.formError = 'Отсутствует или указан неверный токен!'
                        );
                    this.$router.push('/login');
                    return true;
                }

                if (this.pass1 !== this.pass2) {
                    this.error = 'Пароли не совпадают!';
                }
            }
        }
    }
</script>