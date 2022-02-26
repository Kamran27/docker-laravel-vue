import Vue from "vue";
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import ThesesList from '../components/ThesesList.vue';
//import ThesesList from "../compone"
import ThesesListAdmin from '../components/ThesesListAdmin.vue';
import Home from '../components/Home.vue';
import ThesisDetail from '../components/ThesisDetail.vue';

const routes = [
    {
        name: '/',
        path: '/',
        component: Home
    },
    {
        name: '/theses',
        path: '/theses',
        component: ThesesList
    },
    {
        name: '/admin',
        path: '/admin',
        component: ThesesListAdmin
    },
    {
        name: '/get_thesis',
        path: '/get_thesis/:id?',
        component: ThesisDetail
    },
];

 const router = new VueRouter({
     mode: 'history', 
     routes: routes
 });

 export default router;