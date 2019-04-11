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
                Сброс пароля
            </div>
            <div v-if="message" class="alert alert-primary col-md-12" role="alert">
                {{message}}
            </div>
            <form v-else method="post" @submit.prevent="reset" enctype="multipart/form-data" style="max-width: 620px" novalidate>
                <div class="row mb-5">
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" v-validate="'email'" v-model="email" name="email" placeholder="Email" type="email">
                        <span>{{ errors.first('email') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary btn-lg">Сбросить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data () {
        return {
            email: '',
            message: ''
        };
    },

    methods: {
        reset() {
            let data = {
                email: this.email
            };
            if (this.fields.email.valid) {
                axios
                .post('/api/password-reset/request', data)
                .then(this.message = 'Если существует пользователь с таким email, то проверьте почту');
            }
        }
    }
}
</script>