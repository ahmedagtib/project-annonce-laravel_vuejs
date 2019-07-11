<template>
<div class="container">
	 <div class="row">
	 	 <div class="col-md-4">
	 	   <svgprofil></svgprofil>
	     </div>
	 	 <div class="col-md-8">
	 	 	     <div class="getintouch">
                     <h1 class="title">METTRE À JOUR VOTRE PROFIL</h1>
                   <form class="form row" @submit.prevent="updateprofil">
                    <div class="form-field col-lg-6">
                       <input id="username" v-model="username" class="input-text js-input" type="text" disabled="disabled">
                       
                    </div>
                    <div class="form-field col-lg-6 ">
                       <input id="email"  v-model="email" class="input-text js-input" type="email" disabled="disabled">
                      
                    </div>

                    <div class="form-field col-lg-6">
                       <input id="firstname" class="input-text js-input" type="text" v-model="profil.firstname" />
                       <label class="label" for="firstname">Nom</label>
                       <span class="text-danger" v-if="valdation.firstname !=''">
                                    <span v-for="(val, i) in valdation.firstname" :key="i">
                                        {{val}}<br />
                                    </span>
                        </span>
                    </div>
                    <div class="form-field col-lg-6 ">
                       <input id="lastname" v-model="profil.lastname" class="input-text js-input" type="text" />
                       <label class="label"  for="lastname">Prenom</label>
                        <span class="text-danger" v-if="valdation.lastname !=''">
                                    <span v-for="(val, i) in valdation.lastname" :key="i">
                                        {{val}}<br />
                                    </span>
                        </span>
                    </div>
                    <div class="form-field col-lg-6 ">
                       <input id="adresse"  v-model="profil.adresse"  class="input-text js-input" type="text" />
                       <label class="label" for="adresse">adresse</label>
                        <span class="text-danger" v-if="valdation.adresse !=''">
                                    <span v-for="(val, i) in valdation.adresse" :key="i">
                                        {{val}}<br />
                                    </span>
                        </span>
                    </div>
                     <div class="form-field col-lg-6 ">
                       <input id="phone" v-model="profil.phone"  class="input-text js-input" type="text" />
                       <label class="label" for="phone">Télephone</label>
                        <span class="text-danger" v-if="valdation.phone !=''">
                                    <span v-for="(val, i) in valdation.phone" :key="i">
                                        {{val}}<br />
                                    </span>
                        </span>
                     </div>
                    <div class="form-field col-lg-12">
                       <input id="description"  v-model="profil.description"  class="input-text js-input" type="text" />
                           <label class="label" for="description">description</label>
                           <span class="text-danger" v-if="valdation.description !=''">
                                    <span v-for="(val, i) in valdation.description" :key="i">
                                        {{val}}<br />
                                    </span>
                        </span>
                    </div>
            <!-- start file icon -->
                     <div class="form-field col-lg-6">
                        <input type="file" name="file" id="file"  @change="addpic" class="input-file"/>
                        <label for="file" class="btn btn-tertiary js-labelFile">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">{{text}}</span>
                        </label>
                      </div>

             <!-- end icon -->

                  <div class="form-field col-lg-12">
                      <input class="submit-btn" type="submit" value="update">
                   </div>

                   </form>
                </div>
	 	 </div>
	 </div>
</div>


</template>
<script>
import svgprofil from './svgprofil.vue';
import {updateprofil} from '../../helpers/auth';
 export default{
  created(){
   
  },
 	components:{
      svgprofil
 	},
 	data(){
 		return{
 			profil:{
        firstname:'',
        lastname:'',
        adresse:'',
        phone:'',
        description:'',
        user_id:'',
        pic:''
      },
       text:'choisire une photo',
       valdation:[],
       username:'',
       email:''
 		}
 	 },
   methods:{
     updateprofil(){
       updateprofil(this.$data.profil).
       then((res)=>{
            if(res.state=="error"){
                     this.valdation=res.val;

                }else{
                   this.$store.commit("profilSuccess",res);  
                }   
       })
       .catch((err)=>{
                this.$store.commit("registerFailed",{err});
       })
     },
     addpic(e){
       let file = e.target.files[0]
       if(file != ''){
        this.text=file.name;
       }
       let reader = new FileReader();
       reader.onloadend = () => {
                         this.profil.pic=reader.result;       
                        }
                        console.log('It\'s working...', e.target.value)
                        reader.readAsDataURL(file)
         }
   },
    computed:{
       
      getuser(){
         return  this.$store.getters.currentUser;
      }
    },
    mounted(){
      this.profil.user_id=this.$store.getters.currentUser.id;
      this.username=this.$store.getters.currentUser.name;
      this.email=this.$store.getters.currentUser.email;
      
     }
    
 }
</script>
<style type="text/css">
	

</style>