<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            <router-link to="/login">Войти</router-link>
            <router-link to="/registration">Регистрация</router-link>
            <router-link to="/">Принять гостей</router-link>
        </div>
        <div class="content">
            <div class="title m-b-md">
                Password Reset
            </div>
            <form method="post" @submit.prevent="reset" enctype="multipart/form-data" style="max-width: 620px">
                <div class="row mb-5">
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" v-model="email" name="email" placeholder="Email" type="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg">Сбросить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            email: ''
        };
    },

    methods: {
        reset() {
            let data = {
                email: this.email
            };

            axios.post('/api/password-reset/request', data);
        }
    }
}
</script>