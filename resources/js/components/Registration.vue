<template>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            <router-link to="/login">Войти</router-link>
            <router-link to="/registration">Регистрация</router-link>
            <router-link to="/">Принять гостей</router-link>
        </div>
        <div class="content">
            <div class="title m-b-md">
                Регистрация
            </div>
            <form method="post" class="reg-form" enctype="multipart/form-data" @submit.prevent="register" style="max-width: 500px">
                <div class="row mb-5">
                    <div class="flat-input col-md-12 mb-3">
                        <input class="flat-input__input" v-model="firstName" name="firstName" placeholder="Имя" type="text">
                        <p v-if="errors['firstName']">{{errors["firstName"][0]}}</p>
                    </div>
                    <div class="flat-input col-md-12 mb-3">
                        <input class="flat-input__input" v-model="lastName" name="lastName" placeholder="Фамилия" type="text">
                        <p v-if="errors['lastName']">{{errors["lastName"][0]}}</p>
                    </div>
                    <div class="flat-input col-md-12 mb-3">
                        <input class="flat-input__input" v-model="email" name="email" placeholder="Email" type="email">
                        <p v-if="errors['email']">{{errors["email"][0]}}</p>
                    </div>
                    <div class="flat-input col-md-12">
                        <input class="flat-input__input" v-model="password" name="password" placeholder="Пароль" type="password">
                        <p v-if="errors['password']">{{errors["password"][0]}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg">Зарегистрироваться!</button>
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
            firstName:'',
            lastName: '',
            email: '',
            password: '',
            errors: {},
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

            axios.post('/api/register', data)
                .then(({data}) => {
                    axios.post('/api/login', {
                        username: this.email,
                        password: this.password
                    })
                        .then(({data}) => {
                            auth.login(data.token, data.user);

                            this.$router.push('/profile');
                        })
                        .catch(({response}) => {
                            alert(response.data.message)
                        })
                })
                .catch(({response}) => {
                    this.errors = response.data.errors;
                    console.log(response);
                })
        }
    }

}
</script>
