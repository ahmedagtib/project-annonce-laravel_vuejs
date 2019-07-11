require('./bootstrap');
window.Vue = require('vue');
import router from './routes.js';
import Vuex from 'vuex';
import upper from './components/header/upper.vue';
import navbar from './components/header/navbar.vue';
import cfooter from './components/footer/cfooter.vue';
import  axios from 'axios';
import StoreData from './store';
import $ from 'jquery'
import { Form, HasError, AlertError,AlertSuccess } from 'vform'
import Search from './Models/Search';
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
    location: 'top',
    inverse: false
}

// require('popper.js')
// require('jquery')
// require('bootstrap')
// require('bootstrap/dist/css/bootstrap.css')


window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name,AlertSuccess)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(VueProgressBar, options)

Vue.use(Vuex);



const store = new Vuex.Store(StoreData);
router.beforeEach((to,from,next)=>{
    const requiresAuth=to.matched.some(record=>record.meta.requiresAuth);
    const currentUser=store.state.currentUser;
    if(requiresAuth && !currentUser){
        next('/login');
    }else if(to.path == '/login' && currentUser){
        next('/');
    }else{
        next();
    }
})
let search = new Search();

Vue.use(search);
export const bus = new Vue();
const app = new Vue({
    el: '#app',
    components:{
       upper,
       navbar,
       cfooter
    },
    router,
    store
});
