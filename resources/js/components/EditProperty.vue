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
        <form v-if="updatedPropertyInfo.townId && towns.length && features.length" method="post" @submit.prevent="editProperty" enctype="multipart/form-data" class="container" style="width: 1400px;  max-width: 1400px">
            <div class="row">
                <div class="col-md-2 mt-4">
                    <img v-if="image" :src="image" width="100%" height="auto" alt="room" class="mb-4">
                    <img v-else :src="updatedPropertyInfo.photo" alt="room" width="100%" height="auto" class="mb-4">
                    <input type="file" v-on:change="onImageChange" class="form-control mb-3">
                    <button type="button" class="btn btn-success btn-block" @click="uploadImage">Upload image</button>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label for="title" class="col-sm-5 col-form-label">Название:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="updatedPropertyInfo.title" placeholder="Название">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="beds" class="col-md-12 col-form-label">Количество cпальных мест:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="updatedPropertyInfo.beds" placeholder="Количество спальных мест">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 mb-2">Удобства:<br></div>
                                <div :key="feature.id" v-for="feature in features" class="col-sm-10">
                                    <input :value="feature.id" :id="feature.id" v-model="updatedPropertyInfo.features" type="checkbox">
                                    <label :for="feature.id">{{ feature.title }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div>
                                <div class="form-group row">
                                    <label for="town" class="col-sm-5 col-form-label">Город:</label>
                                    <div class="col-sm-10">
                                        <selectpicker class="select-list-item" :search="true" :list="towns" v-model="updatedPropertyInfo.townId"></selectpicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-5 col-form-label">Адрес:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="updatedPropertyInfo.address" placeholder="Улица, дом, квартира">
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
                                        <textarea class="form-control mb-4" v-model="updatedPropertyInfo.extraInformation" placeholder="Расскажите о себе или жилье!"></textarea>
                                        <div class="text-right">
                                            <button  class="btn btn-primary btn-lg">Обновить</button>
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
            updatedPropertyInfo: {
                title: '',
                beds: '',
                address: '',
                townId: '',
                extraInformation: '',
                features: [],
                photo: ''
            },
            image: '',
            imagePath: '',
            authUser: ''
        }
    },
    mounted: function() {
        this.getFeatures();
        this.getTowns();
        this.getPropertyInfo();
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
        showSelectedFeatures() {
            console.log(this.updatedPropertyInfo.features);
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
        getPropertyInfo() {
            axios
                .get('/api/properties/' + this.$route.params.id)
                .then(({data}) => {
                    this.updatedPropertyInfo.title = data.property.title;
                    this.updatedPropertyInfo.beds = data.property.beds;
                    this.updatedPropertyInfo.townId = data.property.townId;
                    this.updatedPropertyInfo.address = data.property.address;
                    this.updatedPropertyInfo.extraInformation = data.property.extraInformation;
                    this.updatedPropertyInfo.features = data.property.features.map((feature) => {
                        return feature.id;
                    });
                    this.updatedPropertyInfo.photo = data.property.photo;
                    console.log(this.updatedPropertyInfo.features);
                });
        },
        editProperty() {
            let data = {
                'title': this.updatedPropertyInfo.title,
                'beds': this.updatedPropertyInfo.beds,
                'address': this.updatedPropertyInfo.address,
                'townId': this.updatedPropertyInfo.townId,
                'extraInformation': this.updatedPropertyInfo.extraInformation,
                'features': this.updatedPropertyInfo.features,
                'photo': this.imagePath != null ? this.imagePath : this.updatedPropertyInfo.photo,
                'propertyId': this.$route.params.id
            };
            axios
                .post('/api/edit', data)
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