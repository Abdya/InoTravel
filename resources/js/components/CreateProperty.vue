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
        <form  method="post" @submit.prevent="createProperty" enctype="multipart/form-data" class="container" style="width: 1400px;  max-width: 1400px">
            <div class="row">
                <div class="col-md-3 mt-4">
                    <img v-if="image" :src="image" width="100%" height="auto" alt="room" class="mb-4">
                    <input type="file" v-on:change="onImageChange" class="mb-3">
                    <button type="button" class="btn btn-success btn-block" @click="uploadImage">Upload image</button>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="title" class="col-sm-5 col-form-label">Название:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="propertyInfo.title" placeholder="Название">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="beds" class="col-md-12 col-form-label">Количество cпальных мест:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="propertyInfo.beds" placeholder="Количество спальных мест">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 mb-2">Удобства:<br></div>
                                <div :key="feature.id" v-for="feature in features" class="col-md-12">
                                        <input :value="feature.id" :id="feature.id" v-model="propertyInfo.features" type="checkbox">
                                        <label :for="feature.id">{{ feature.title }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div>
                                <div class="form-group row">
                                    <label for="town" class="col-sm-5 col-form-label">Город:</label>
                                    <div class="col-sm-10">
                                        <selectpicker class="select-list-item" :search="true" :list="towns" v-model="propertyInfo.townId"></selectpicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-md-7 col-form-label">Адрес:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="propertyInfo.address" placeholder="Улица, дом, квартира">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div>
                                <div class="form row">
                                    <label for="extraInformation" class="col-sm-5 col-form-label">Дополнительная информация:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control mb-4" v-model="propertyInfo.extraInformation" placeholder="Расскажите о себе или жилье!"></textarea>
                                        <div class="text-right">
                                            <button  class="btn btn-primary btn-lg">Создать профиль</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            towns: [],
            features: [],
            propertyInfo: {
                title: '',
                beds: '',
                address: '',
                townId: '',
                extraInformation: '',
                features: []
            },
            image: '',
            imagePath: '',
            authUser: ''
        }
    },
    mounted: function() {
        this.getFeatures();
        this.getTowns();
        this.getAuthUser();
    },
    methods: {
        getFeatures() {
            axios
                .get('/api/get-features')
                .then(({data}) => {
                    this.features = data.features
                });
        },
        getTowns() {
            axios
                .get('/api/get-towns')
                .then(({data}) => {
                    this.towns = data.towns.map((town) => {
                        return {
                            id: town.id,
                            name: town.title
                        };
                    });
                });
        },
        createProperty() {

            let data = {
                'title': this.propertyInfo.title,
                'beds': this.propertyInfo.beds,
                'address': this.propertyInfo.address,
                'townId': this.propertyInfo.townId,
                'extraInformation': this.propertyInfo.extraInformation,
                'features': this.propertyInfo.features,
                'photo': this.imagePath
            };
            axios
                .post('/api/create', data)
                .then(({data}) => {
                    this.$router.push({name: 'property', params: { id: data.propertyId}});
                });
        },
        onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        uploadImage(e){
            e.preventDefault();
            axios
                .post('/api/image/store',{image: this.image})
                .then(({data}) => {
                    this.imagePath = data.path;
                });
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

