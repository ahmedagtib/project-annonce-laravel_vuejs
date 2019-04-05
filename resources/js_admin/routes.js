import VueRoute from 'vue-router';
window.Vue = require('vue');
import Admin from './components/admin/Admin.vue';
import AdminEdit from './components/admin/AdminEdit.vue';
import User from  './components/user/User.vue';
import UserEdit from  './components/user/UserEdit.vue';
import Ville from  './components/ville/Ville.vue';
import EditVille from './components/ville/EditVille.vue';

import Category from  './components/Category/Category.vue';
import EditCategory from  './components/Category/CategoryEdit.vue';

import Annonce from  './components/annonce/annonce.vue';

import Comment from  './components/comment/comment.vue';

import Dashbord from  './components/dashbord/Dashbord.vue';

import Notfound from  './components/Notfound.vue';
import addAnnonce from './components/annonce/Model.vue'
import EditAnnonce from './components/annonce/Edite.vue'

const routes=[
              {path:'/admin/dashbord',component:Dashbord},
              {path:'/admin/admin',component:Admin},
               {path:"/admin/admin/edit/:id",component:AdminEdit},
              {path: '/admin/user',component:User},
              {path:"/admin/user/edit/:id",component:UserEdit},
              {path:'/admin/ville',component:Ville},
              {path:"/admin/ville/edit/:id",component:EditVille},

              {path:'/admin/categorie',component:Category},
              {path:"/admin/categorie/edit/:id",component:EditCategory},
               //start annonce
              {path:'/admin/annonce',component:Annonce},
              {path:'/admin/addAnnonce',component:addAnnonce},
              {path:'/admin/annonce/edit/:id',component:EditAnnonce},
               
              //end annonce

              {path:'/admin/comment',component:Comment},

              {path:"*",component:Notfound},

              
              
            ];



            
 Vue.use(VueRoute);
 
 const router =new VueRoute({
     routes,
    mode:'history'
}); 


export default  router;         