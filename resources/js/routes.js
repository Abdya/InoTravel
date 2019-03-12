import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';
import Login from '@/js/components/Login';
import PasswordReset from '@/js/components/PasswordReset';
import PasswordChange from '@/js/components/PasswordChange';
import Registration from '@/js/components/Registration'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/reset',
            name: 'passReset',
            component: PasswordReset
        },
        {
            path: '/change-pass',
            name: 'passChange',
            component: PasswordChange
        },
        {
            path: '/registration',
            name: 'registration',
            component: Registration
        }
    ]
});

export default router;