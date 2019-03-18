import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';
import Login from '@/js/components/Login';
import PasswordReset from '@/js/components/PasswordReset';
import PasswordChange from '@/js/components/PasswordChange';
import Registration from '@/js/components/Registration';
import MyProperties from '@/js/components/MyProperties';
import SearchResults from '@/js/components/SearchResults';
import Requests from '@/js/components/Requests';
import SingleProperty from '@/js/components/SingleProperty';
import UserProfile from '@/js/components/UserProfile'

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
        },
        {
            path: '/myproperties',
            name: 'myproperties',
            component: MyProperties
        },
        {
            path: '/search',
            name: 'searchresults',
            component: SearchResults
        },
        {
            path: '/requests',
            name: 'requests',
            component: Requests
        },
        {
            path: '/property',
            name: 'property',
            component: SingleProperty
        },
        {
            path: '/profile',
            name: 'profile',
            component: UserProfile
        },
    ]
});

export default router;