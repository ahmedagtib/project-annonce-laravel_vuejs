<template>
    <div class="upper_bar">
        <div class="container">
            <div class="row">
                    <div class="col-sm mt-1">
                        <span><i class="fas fa-envelope"></i> smartove@gmail.com,</span>
                        <span><i class="fa fa-phone"></i> 0600000000</span>
                     </div>
                     <ul class="nav">
                     <div class="col-sm text-right">
                             <ul class="list-inline">
                                 <template v-if="!currentUser">
                                   <li class="list-inline-item">
                                         <router-link class="nav-link" to="/annonce">create your annonce</router-link>
                                  </li>
                                    <li class="list-inline-item">
                                        <router-link  to="/login">login</router-link>
                                     </li>
                                  <li class="list-inline-item">
                                       <router-link  to="/register">register</router-link>
                                  </li>
                                 </template>
                                 <template v-else>
                                     <li class="list-inline-item">
                                         <router-link class="nav-link" to="/annonce">create annonce</router-link>
                                      </li>
                                       <li class="list-inline-item">
                                         <router-link class="nav-link" to="/mystore">My store</router-link>
                                      </li>
                                      <li class="list-inline-item dropdown">
                                         <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                            {{currentUser.name}}<span class="sr-only"></span>
                                         </a>
                                         <div class="dropdown-menu">
                                          <router-link class="dropdown-item" to="/myprofil">profail</router-link>
                                          <router-link class="dropdown-item" to="/edituser">edit password</router-link>
                                          <div class="dropdown-divider"></div>
                                          <a class="nav-link" href="#" @click.prevent="logout">logout</a>
                                        </div>
                                      </li>
                                      
                                 </template>
                             </ul>
                     </div>
                   </ul>    
            </div>         
        </div>
    </div>
</template>

<script>
    export default {
      methods:{
      logout:function(){
          this.$store.commit('logout');
          this.$router.push('/login');
      }

    },
    computed:{
      currentUser(){
        return this.$store.getters.currentUser;
      }
    }
    }
</script>
<style  type="text/css">

</style
