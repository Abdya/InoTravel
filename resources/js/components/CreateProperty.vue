<template>
    <div>
        <navbar></navbar>
        <div class="vld-parent">
            <loading 
            :active.sync="isLoading"
            :color="'#007bff'"
            :backgrounColor="'#c0c0c0'"
            :loader="'bars'">
            </loading>
        </div>
        <div class="jumbotron mt-5">
            <form  method="post" @submit.prevent="createProperty" data-vv-scope="create" enctype="multipart/form-data" class="container align-center" style="width: 1110px">
                <div class="row">
                    <div class="col-md-3 mt-4">
                        <img v-if="image" :src="image" width="100%" height="auto" alt="room" class="mb-4">
                        <input type="file" v-on:change="onImageChange" class="mb-3">
                        <button type="button" class="btn btn-success" @click="uploadImage">Загрузить фото</button>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-5 col-form-label">Название:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-validate="'required|min:5|max:80'" name="title" v-model="propertyInfo.title" placeholder="Название">
                                        <span style="color: tomato">{{ errors.first('create.title') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="beds" class="col-md-12 col-form-label">Количество cпальных мест:</label>
                                    <div class="col-sm-10">
                                        <v-select class="select-list-item" placeholder="..." v-model="propertyInfo.beds" :options="guestsForSelect"></v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 mb-2"><label>Удобства:</label><br></div>
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
                                            <input type="text" class="form-control" v-validate="'required|min:5|max:80'" name="address" v-model="propertyInfo.address" placeholder="Улица, дом, квартира">
                                            <span style="color: tomato">{{ errors.first('create.address') }}</span>
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
        
    </div>
</template>
<script>
import Navbar from './Navbar.vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
    components: {Navbar, Loading},
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
            authUser: '',
            guestsForSelect: Array.from(Array(20), (x, index) => index + 1),
            isLoading: false
        }
    },
    mounted: function() {
        this.doAjax();
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
                    this.isLoading = false;
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
        doAjax() {
            this.isLoading = true;
            setTimeout(() => {}, 5000)
            this.getFeatures();
            this.getTowns();
        }
    }
}
</script>
<style scoped>
    .select-list-item {
        color: black;
        background-color: white;
    }
    .nav-link {
        color: white;
    }
    input:valid {
        border-color: green;
    }

    input:invalid {
        border-color: red;
    }
</style>

