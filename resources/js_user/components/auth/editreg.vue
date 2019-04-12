<template>
<div class="container">
    <div class="row">
         <div class="col-md-6">
             <div class="row justify-content-center mb-4">
                  <div class="reg fadeInDown">
                        <div id="formContent">
                             <div class="fadeIn first">
                                  
                                  <h1>upadate password</h1>
                             </div>
                             <form  @submit.prevent="register">
                                 <input type="text"      class="fadeIn second"   v-model="formRegister.name"     placeholder="name"/>
                                 </br>
                                 <span class="text-danger" v-if="valdation.name !=''">
                                    <span v-for="val in valdation.name">
                                        {{val}}</br>
                                    </span>
                                 </span>
                                 <input type="text"      class="fadeIn second"   v-model="formRegister.email"     placeholder="email" disabled="disabled" />
                                 </br>
                                 <span class="text-danger" v-if="valdation.email !=''">
                                    <span v-for="val in valdation.email">
                                        {{val}}</br>
                                    </span>
                                 </span>
                                 <input type="password"  class="fadeIn second" v-model="formRegister.password"    placeholder="new password"/>

                                 <input type="password"  class="fadeIn third"    placeholder="confirm password"   v-model="passwordc"/></br>
                                  <span class="text-danger" v-if="confirmation != ''">
                                      {{confirmation}}
                                  </span>
                                   </br>
                                 <span class="text-danger" v-if="valdation.password !=''">
                                    <span v-for="val in valdation.password">
                                        {{val}}</br>
                                    </span>
                                 </span>
                                 

                                <input type="submit"    class="fadeIn fourth" value="sgin in"/>
                             </form>
                             <div id="formFooter">
                            <a class="underlineHover" href="#">Go to the Site</a>
                        </div>
                  </div>
               </div>
           </div>
         </div>
         <div class="col-md-6">
             <svgreg></svgreg>
         </div>
    </div>
</div>
                               
</template>

<script>
import {editreg} from '../../helpers/auth';
import svgreg from './svgreg';
export default {
    components:{
     svgreg
    },
    data(){
        return {
            formRegister: {
            id:'', 
            name: '',
            email: '',
            password: ''
        },
        passwordc:'',
        confirmation:'',
        error:null,
        valdation:{
            name:'',
            email:'',
            password:''
         }
        }
    },
    methods:{
        register(){
                const pass1=this.formRegister.password;
                const pass2=this.passwordc; 
                   if(pass1 != pass2){
                        this.confirmation="le champe des password invalid";
                 
                    }else{
                
                        editreg(this.$data.formRegister)
                        .then((res) => {
                               console.log(res.val);
                         if(res.state=="error"){
                               this.valdation=res.val;
                         }else{
                  
                                 // this.$router.push({path:'/login'});   
                            }
                           })
                             .catch((error) => {
                           //this.$store.commit("registerFailed",{error});
                           })
            }
        }

    },
    mounted(){
      this.formRegister=this.$store.getters.currentUser;
    }
   
}
</script>

<style scoped>
.error{
    text-align: center;
    color: red;
}
</style>
