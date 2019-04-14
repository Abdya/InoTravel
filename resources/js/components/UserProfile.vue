<template>
    <div>
        <navbar></navbar>
        <div class="container mt-5 jumbotron">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <form method="post" @submit.prevent="changeInfo" class="container col-md-6" data-vv-scope="info" style="width: 1400px;  max-width: 1400px">
                            <div>
                                <h2 class="mb-4">Редактировать данные</h2>
                            </div>
                            <div v-if="mainMsg" class="mt-3 alert alert-success col-sm-10" role="alert">
                                    {{mainMsg}}
                            </div>
                            <div class="form-group row">
                                <label for="firstName" class="col-sm-5 col-form-label">Имя</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required|alpha'" type="text" name="firstName" class="form-control" v-model="formData.firstName" placeholder="Имя">
                                    <span>{{ errors.first('info.firstName') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" class="col-sm-5 col-form-label">Фамилия</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required|alpha'" type="text" name="lastName" class="form-control" v-model="formData.lastName" placeholder="Фамилия">
                                    <span>{{ errors.first('info.lastName') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-5 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input v-validate="'email'" type="text" class="form-control" name="email" v-model="formData.email" placeholder="Email">
                                    <span v-show="errors.has('info.email')" class="help is-danger">{{ errors.first('info.email') }}</span>
                                    <p v-if="errorsBack['email']">{{errorsBack["email"][0]}}</p>
                                </div>
                            </div>
                            <div class="text-left mb-3 mt-3">
                                <button class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                        <form method="post" @submit.prevent="changePass" class="container col-md-6" data-vv-scope="password" style="margin-letf:auto; margin-right:0">
                            <div>
                                <h2 class="mb-4">Сменить пароль</h2>
                            </div>
                            <div v-if="mainPassMsg" class="mt-3 alert alert-success col-sm-10" role="alert">
                                    {{mainMsg}}
                            </div>
                            <div class="form-group row">
                                <label for="old_password" class="col-sm-5 col-form-label">Текущий пароль</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required'" v-model="changePassData.oldPassword" type="password" class="form-control" name="old_password">
                                </div>
                                <span v-show="errors.has('old_password')" class="help is-danger">{{ errors.first('password.old_password') }}</span>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-5 col-form-label">Новый пароль</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required|min:6|max:1024'" v-model="changePassData.password" type="password" class="form-control" name="password" ref="password">
                                    <span v-show="errors.has('password.password')" class="help is-danger">{{ errors.first('password.password') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-5 col-form-label">Повторите пароль</label>
                                <div class="col-sm-10">
                                    <input v-validate="'required|confirmed:password'" v-model="changePassData.repeatPassword" type="password" class="form-control" name="password_confirmation">
                                </div>
                                <span v-show="errors.has('password.password_confirmation')" class="help is-danger">{{ errors.first('password.password_confirmation') }}</span>
                            </div>
                            <div class="text-left mb-3 mt-3">
                                <button class="btn btn-primary">Сохранить</button>
                            </div>
                            <p v-if="msg">{{msg}}</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import VeeValidate from 'vee-validate';
import Navbar from './Navbar.vue';

export default {
    components: {Navbar, VeeValidate},
    data() {
        return {
            user: {},
            formData: {},
            changePassData: {},
            authUser: '',
            errorsBack: {},
            msg: '',
            mainMsg: '',
            mainPassMsg: ''
        };
    },
    mounted: function() {
        this.takeUserData();
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
                });
        },
        changeInfo() {
            this.$validator.validateAll('info').then(result => {
                if (result) {
                    axios
                        .post('/api/profile/change-info', this.formData)
                        .then(({data}) => {
                            console.log(data.response);
                            this.mainMsg = 'Данные успешно сохранены!'
                        })
                        .catch(({response}) => {
                            this.errorsBack = response.data.errors;
                        });
                    }
            })  
        },
        changePass() {
            let changePass = {
                'oldPassword': this.changePassData.oldPassword,
                'password': this.changePassData.password,
                'repeatPassword': this.changePassData.repeatPassword
            };
            this.$validator.validateAll('password').then(result => {
                if (result) {
                    axios
                        .post('/api/profile/change-pass', changePass)
                        .then(
                            this.changePassData.oldPassword = '',
                            this.changePassData.password = '',
                            this.changePassData.repeatPassword = '',
                            this.mainPassMsg = 'Данные успешно сохранены!'
                        )
                        .catch(({response}) => {
                            if (response.data.statement == false) {
                                this.msg = 'Введен неверный текущий пароль!'
                            }
                        });
                }
            })
        },
        show () {
            this.$modal.show('hello-world');
        },
        hide () {
            this.$modal.hide('hello-world');
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
