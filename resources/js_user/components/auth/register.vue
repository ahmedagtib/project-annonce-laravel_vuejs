<template>
    <!--
    <div class="register row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                   <h3>Register</h3> 
                </div>
                <div class="card-body">
                    <form @submit.prevent="register">
                        <div class="form-group row" v-if="regError">
                            <p class="error">
                               
                            </p>
                        </div>
                        <div class="form-group row">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control"  v-model="formRegister.name" placeholder="Name">
                           
                        </div>
                        <div class="form-group row">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" v-model="formRegister.email" placeholder="Email address">
                            
                        </div>
                        <div class="form-group row">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control"  v-model="formRegister.password" placeholder="password">
                            
                        </div>
                        <div class="form-group row">
                            <input type="submit" value="Register" class="btn btn-outline-primary ml-auto">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
-->
<div class="container">
    <div class="row">
         <div class="col-md-6">
             <svgreg></svgreg>
         </div>
         <div class="col-md-6">
             <div class="row justify-content-center mb-4">
                  <div class="reg fadeInDown">
                        <div id="formContent">
                             <div class="fadeIn first">
                                  <img src="" id="icon" alt="vap logo"/>
                                  <h1>sgin in</h1>
                             </div>
                             <form  @submit.prevent="register">
                                 <input type="text"      class="fadeIn second"   v-model="formRegister.name"     placeholder="name"/>
                                 </br>
                                 <span class="text-danger" v-if="valdation.name !=''">
                                    <span v-for="val in valdation.name">
                                        {{val}}</br>
                                    </span>
                                 </span>
                                 <input type="text"      class="fadeIn second"   v-model="formRegister.email"     placeholder="email"/>
                                 </br>
                                 <span class="text-danger" v-if="valdation.email !=''">
                                    <span v-for="val in valdation.email">
                                        {{val}}</br>
                                    </span>
                                 </span>
                                 <input type="password"  class="fadeIn second" v-model="formRegister.password"    placeholder="password"/>

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
    </div>
</div>

                               
</template>

<script>
import {registerUser} from '../../helpers/auth';
import svgreg from './svgreg';
export default {
    components:{
     svgreg
    },
    data(){
        return {
            formRegister: {
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
                
                registerUser(this.$data.formRegister)
                .then((res) => {
                //console.log(res.val);
                if(res.state=="error"){
                     this.valdation=res.val;

                }else{
                   this.$store.commit("registerSuccess",res);
                   this.$router.push({path:'/login'});   
                 }
               })
               .catch((error) => {
                this.$store.commit("registerFailed",{error});
              })
            }
        }

    },
    computed:{
      regError(){
            return this.$store.getters.regError;
        }
    },
   
    
}
</script>

<style scoped>
.error{
    text-align: center;
    color: red;
}
</style>
