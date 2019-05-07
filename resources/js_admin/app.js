require('./bootstrap');
window.Vue = require('vue');

import router from './routes.js';
import axios from 'axios';
import Vuex from 'vuex';
import { Form, HasError, AlertError,AlertSuccess } from 'vform'
import VueProgressBar from 'vue-progressbar'
import Auth from './components/admin/Auth'
import StoreData from './store'

const location = window.location.href
const r = location.split('/')
// vue-charts package
import 'chart.js';
import 'hchs-vue-charts';
Vue.use(window.VueCharts);
 
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
router.beforeEach((to,from,next)=>{
  const requiresAuth=to.matched.some(record=>record.meta.requiresAuth);
  const currentAdmin=store.state.currentAdmin;
  if(requiresAuth && !currentAdmin && r.pop() != 'login'){
    window.location.replace("admin/login");
  }else if(to.path == 'admin/login' && currentAdmin){
      next('admin');
  }else{
      next();
  }
})
window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name,AlertSuccess)
Vue.use(VueProgressBar, options)
Vue.use(Auth)

Vue.use(Vuex);

const store = new Vuex.Store(StoreData);
const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
      Auth
    },
    methods: {
      logout() {
        axios.get('/admin/logout').then((res) => {
          if(res.data.data === 'logout') {
            this.$store.commit('logout')

            window.location.replace("/admin/login");

            console.log('logout', r.pop())
          }
          console.log(res)
        }).catch(() => {

        })
      }
    }
});
