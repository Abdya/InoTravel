import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';

import Routes from '@/js/routes.js';

import App from '@/js/views/App';

import auth from '@/js/auth.js';

Vue.use(Vuetify);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

window.auth = auth;

window.Event = new Vue;

const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App),
});

export default app;