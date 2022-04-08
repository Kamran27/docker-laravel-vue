import Vue from "vue";
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import ThesesList from '../components/ThesesList.vue';
import AdminThesesList from '../components/AdminThesesList.vue';
import Home from '../components/Home.vue';
import ThesisDetail from '../components/ThesisDetail.vue';
import TagsList from '../components/TagsList.vue';
import AdminUserList from '../components/AdminUserList.vue';
import UserLogin from '../components/UserLogin.vue';
import UserRegistration from '../components/UserRegistration.vue';
import Admin from '../components/Admin.vue';

const routes = [
    {
        name: '/',
        path: '/',
        component: Home
    },
    {
        name: '/login',
        path: '/login',
        component: UserLogin
    },
    {
        name: '/registration',
        path: '/registration',
        component: UserRegistration
    },
    {
        name: '/theses',
        path: '/theses',
        component: ThesesList
    },
    {
        name: '/admin',
        path: '/admin',
        component: Admin,
        beforeEnter: (to, from, next) => {
            let currentUser = JSON.parse(window.localStorage.currentUser);
            if(currentUser && currentUser.admin) {
                next();
            } else {
                next("/");
            }
          },
          children: [
            {
                name: 'theses',
                path: 'theses',
                component: AdminThesesList
            },
            {
                name: 'users',
                path: 'users',
                component: AdminUserList
            },
          ],
    },
    {
        name: '/get_thesis',
        path: '/get_thesis/:id?',
        component: ThesisDetail
    },
    {
        name: '/get_tag',
        path: '/get_tag/:id?',
        component: TagsList
    },
   
];

 const router = new VueRouter({
     mode: 'history', 
     routes: routes
 });

 export default router;