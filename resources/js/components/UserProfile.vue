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
            changePassData: {},
            authUser: ''
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