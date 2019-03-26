import VueRoute from 'vue-router';
window.Vue = require('vue');
import Admin from './components/admin/Admin.vue';
import User from  './components/user/User.vue';
import UserEdit from  './components/user/UserEdit.vue';
import Ville from  './components/ville/Ville.vue';
import EditVille from './components/ville/EditVille.vue';

import Category from  './components/Category/Category.vue';
import EditCategory from  './components/Category/CategoryEdit.vue';


const routes=[
             
              {path:'/admin/admin',component:Admin},
              {path: '/admin/user',component:User},
              {path:"/admin/user/edit/:id",component:UserEdit},
              {path:'/admin/ville',component:Ville},
              {path:"/admin/ville/edit/:id",component:EditVille},

              {path:'/admin/categorie',component:Category},
              {path:"/admin/categorie/edit/:id",component:EditCategory},

              
              
            ];



            
 Vue.use(VueRoute);
 
 const router =new VueRoute({
     routes,
    mode:'history'
}); 


export default  router;         