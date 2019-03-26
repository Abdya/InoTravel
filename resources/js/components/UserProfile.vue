<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
            <router-link class="navbar-brand" to="/">InoTravel</router-link>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <div class="top-right links profile">
                        <router-link to="/profile">Nikita Orobenko</router-link>
                        <router-link to="/myproperties"><ins>Мое жилье</ins></router-link>
                        <router-link to="/requests">Заявки</router-link>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                    </div>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <form method="post" @submit.prevent="changeInfo" class="container blur-form col-md-6" style="width: 1400px;  max-width: 1400px">
                            <div>
                                <h2 class="mb-4">Редактировать данные</h2>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" class="col-sm-5 col-form-label">Имя</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required|alpha'" type="text" class="form-control" v-model="formData.firstName" placeholder="Имя">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" class="col-sm-5 col-form-label">Фамилия</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required|alpha'" type="text" class="form-control" v-model="formData.lastName" placeholder="Фамилия">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-5 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input v-validate="'email'" data-vv-as="email" type="text" class="form-control" v-model="formData.email" placeholder="Email">
                                </div>
                            </div>
                            <div class="text-left mb-3 mt-3">
                                <button class="btn btn-outline-primary">Сохранить</button>
                            </div>
                        </form>
                        <form method="post" @submit.prevent="changePass" class="container blur-form col-md-6" style="width: 1400px;  max-width: 1400px">
                            <div>
                                <h2 class="mb-4">Сменить пароль</h2>
                            </div>
                            <div class="form-group row">
                                <label for="old_password" class="col-sm-5 col-form-label">Старый пароль</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required'" v-model="changePassData.oldPassword" type="password" class="form-control" data-vv-as='"Старый пароль"' name="old_password">
                                </div>
                                <span v-show="errors.has('old_password')" class="help is-danger">{{ errors.first('old_password') }}</span>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-5 col-form-label">Новый пароль</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required'" v-model="changePassData.password" data-vv-as="Новый пароль" type="password" class="form-control" name="password" ref="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-5 col-form-label">Повторите пароль</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required|confirmed:password'" v-model="changePassData.repeatPassword" data-vv-as="Повторите пароль" type="password" class="form-control" name="password_confirmation">
                                </div>
                                <span v-show="errors.has('password_confirmation')" class="help is-danger">{{ errors.first('password_confirmation') }}</span>
                            </div>
                            <div class="text-left mb-3 mt-3">
                                <button class="btn btn-outline-primary">Сохранить</button>
                            </div>
                        </form>
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
            user: {},
            formData: {},
            changePassData: {}
        };
    },
    mounted: function() {
        this.takeUserData()
    },
    methods: {
        takeUserData() {
            axios
                .get('/api/profile')
                .then(({data}) => {
                    this.user = data;
                    this.formData = {
                        'firstName': this.user.firstName,
                        'lastName': this.user.lastName,
                        'email': this.user.email
                    };
                    this.changePassData = {
                        'oldPassword': '',
                        'password': '',
                        'repeatPassword': ''
                    }
                    console.log(data);
                });
        },
        changeInfo() {
            axios
                .post('/api/profile/change-info', this.formData)
                .then(({data}) => {
                    console.log(data.response);
                })
        },
        changePass() {
            let changePass = {
                'oldPassword': this.changePassData.oldPassword,
                'password': this.changePassData.password,
                'repeatPassword': this.changePassData.repeatPassword
            };
            axios
                .post('/api/profile/change-pass', changePass)
                .then(
                    this.changePassData.oldPassword = '',
                    this.changePassData.password = '',
                    this.changePassData.repeatPassword = ''
                )
        }
    }
}
</script>
