require('./bootstrap');
window.Vue = require('vue');

import router from './routes.js';
import  axios from 'axios';
import { Form, HasError, AlertError,AlertSuccess } from 'vform'
import upper from './components/upper.vue';

window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name,AlertSuccess)

const app = new Vue({
    el: '#app',
    components:{
       upper:upper
    },
    router
});
