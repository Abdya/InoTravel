<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            <router-link to="/login">Войти</router-link>
            <router-link to="/registration">Регистрация</router-link>
            <router-link to="/">Принять гостей</router-link>
        </div>
        <div class="content">
            <div class="title m-b-md">
                Password Change
            </div>
            <form method="post" class="pass-change-form" @submit.prevent="checkPass" enctype="multipart/form-data" style="max-width: 500px">
                <div class="row mb-5">
                    <div class="flat-input col-md-12 mb-3">
                        <input class="flat-input__input" v-model="pass1" name="pass1" placeholder="Enter new password..." type="password">
                    </div>
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" v-model="pass2" name="pass2" placeholder="Repeat" type="password">
                    </div>
                    <div v-if="error.length" class="col-md-12">
                        <p v-for="err in error">{{err}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg" type="submit">Обновить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                pass1: '',
                pass2: '',
                error: []
            };
        },

        methods: {
            checkPass: function () {
                if (this.pass1 == this.pass2) {
                    console.log(this.$route.query);
                    return false;
                }

                this.error = [];

                if (this.pass1 !== this.pass2) {
                    this.error.push('Пароли не совпадают!')
                }
            }
        }
    }
</script>