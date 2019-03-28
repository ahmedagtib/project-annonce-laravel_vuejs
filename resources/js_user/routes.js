import VueRoute from 'vue-router';
window.Vue = require('vue');


const routes=[
               

              ];

 Vue.use(VueRoute);
 
 const router =new VueRoute({
     routes,
    mode:'history'
}); 


export default  router;                