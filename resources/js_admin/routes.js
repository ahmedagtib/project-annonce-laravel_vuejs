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
               {path:'/admin',component:Dashbord,meta:{requiresAuth:true}},
              {path:'/admin/dashbord',component:Dashbord,meta:{requiresAuth:true}},
              {path:'/admin/admin',component:Admin,meta:{requiresAuth:true}},
               {path:"/admin/admin/edit/:id",component:AdminEdit,meta:{requiresAuth:true}},
              {path: '/admin/user',component:User,meta:{requiresAuth:true}},
              {path:"/admin/user/edit/:id",component:UserEdit,meta:{requiresAuth:true}},
              {path:'/admin/ville',component:Ville,meta:{requiresAuth:true}},
              {path:"/admin/ville/edit/:id",component:EditVille,meta:{requiresAuth:true}},

              {path:'/admin/categorie',component:Category,meta:{requiresAuth:true}},
              {path:"/admin/categorie/edit/:id",component:EditCategory,meta:{requiresAuth:true}},
               //start annonce
              {path:'/admin/annonce',component:Annonce,meta:{requiresAuth:true}},
              {path:'/admin/addAnnonce',component:addAnnonce,meta:{requiresAuth:true}},
              {path:'/admin/annonce/edit/:id',component:EditAnnonce,meta:{requiresAuth:true}},
               
              //end annonce

              {path:'/admin/comment',component:Comment,meta:{requiresAuth:true}},

              {path:"*",component:Notfound,meta:{requiresAuth:true}},

              
              
            ];



            
 Vue.use(VueRoute);
 
 const router =new VueRoute({
     routes,
    mode:'history'
}); 


export default  router;         