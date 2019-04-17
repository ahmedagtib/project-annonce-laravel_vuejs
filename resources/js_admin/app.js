require('./bootstrap');
window.Vue = require('vue');

import router from './routes.js';
import axios from 'axios';
import { Form, HasError, AlertError,AlertSuccess } from 'vform'
import VueProgressBar from 'vue-progressbar'

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'left',
    inverse: false
}

window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name,AlertSuccess)
Vue.use(VueProgressBar, options)

const app = new Vue({
    el: '#app',
    router
});
