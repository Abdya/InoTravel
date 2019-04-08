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
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <form method="post" @submit.prevent="changeInfo" class="container col-md-6" data-vv-scope="info" style="width: 1400px;  max-width: 1400px">
                            <div>
                                <h2 class="mb-4">Редактировать данные</h2>
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
                                    <span>{{ errors.first('info.email') }}</span>
                                    <p v-if="errorsBack['email']">{{errorsBack["email"][0]}}</p>
                                </div>
                            </div>
                            <div class="text-left mb-3 mt-3">
                                <button class="btn btn-outline-primary">Сохранить</button>
                            </div>
                        </form>
                        <form method="post" @submit.prevent="changePass" class="container col-md-6" data-vv-scope="password" style="margin-letf:auto; margin-right:0">
                            <div>
                                <h2 class="mb-4">Сменить пароль</h2>
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
                                <button class="btn btn-outline-primary">Сохранить</button>
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
export default {
    data() {
        return {
            user: {},
            formData: {},
            changePassData: {},
            authUser: '',
            errorsBack: {},
            msg: ''
        };
    },
    mounted: function() {
        this.takeUserData();
        this.getAuthUser();
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
                            this.changePassData.repeatPassword = ''
                        )
                        .catch(({response}) => {
                            if (response.data.statement == false) {
                                this.msg = 'Введен неверный текущий пароль!'
                            }
                        });
                }
            })
        },
        getAuthUser() {
            axios
                .get('/api/get-auth-user')
                .then(({data}) => {
                    this.authUser = data.authUser;
                    console.log(this.authUser);
                })
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