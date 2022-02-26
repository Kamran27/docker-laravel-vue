require('./bootstrap');

import Vue from 'vue';
import vuetify from './plugins/vuetify';

window.Vue = require('vue');

import App from './App.vue';
import store from './store/index';
import router from './router/index';

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount("#app");

