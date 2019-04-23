import VueRoute from 'vue-router';
import Homepage from './components/home/homepage';
import annonce from './components/annonce/annonce.vue';
import adsDetailles from './components/annonce/AnnonceDetaile.vue';
import AnnonceStore from './components/annonce/AnnonceStore.vue';
import Detaile from './components/annonce/AnnonceDetaile.vue';
import login from './components/auth/login.vue';
import Register from './components/auth/register.vue';
import profil from './components/auth/profil.vue';
import myprofail from './components/auth/myprofail.vue';
import mystore from './components/storeuser/storeuser.vue';
import editpassword from './components/auth/editreg.vue';
import Notfound from './components/notfound/notfound.vue';
window.Vue = require('vue');


const routes=[
                {path:'/',component:Homepage},
                {path:'/annonce',component:annonce,meta:{requiresAuth:true}},
                {path:'/login',component:login},
                {path:'/register',component:Register},
                {path:'/store',component:AnnonceStore},
                {path:'/detaille',component:adsDetailles},
                {path:'/profil',component:profil,meta:{requiresAuth:true}},
                 {path:'/myprofil',component:myprofail,meta:{requiresAuth:true}},
                {path:'/edituser',component:editpassword,meta:{requiresAuth:true}},
                {path:'/mystore',component:mystore,meta:{requiresAuth:true}},
                {path:'/annonce/:slug',component:Detaile},
                {path:"*",component:Notfound},
              ];

 Vue.use(VueRoute);
 
 const router =new VueRoute({
     routes,
    mode:'history'
}); 


export default  router;                