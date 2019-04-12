import VueRoute from 'vue-router';
import Homepage from './components/home/homepage';
import annonce from './components/annonce/annonce.vue';
import adsDetailles from './components/annonce/AnnonceDetaile.vue';
import AnnonceStore from './components/annonce/AnnonceStore.vue';
import login from './components/auth/login.vue';
import Register from './components/auth/register.vue';
import profil from './components/auth/profil.vue';
import editpassword from './components/auth/editreg.vue';
window.Vue = require('vue');


const routes=[
                {path:'/',component:Homepage},
                {path:'/annonce',component:annonce,meta:{requiresAuth:true}},
                {path:'/login',component:login},
                {path:'/register',component:Register},
                {path:'/store',component:AnnonceStore},
                {path:'/detaille',component:adsDetailles},
                {path:'/profil',component:profil,meta:{requiresAuth:true}},
                {path:'/edituser',component:editpassword,meta:{requiresAuth:true}}
              ];

 Vue.use(VueRoute);
 
 const router =new VueRoute({
     routes,
    mode:'history'
}); 


export default  router;                