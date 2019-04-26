<template>
  <div class="contanier">
     <div class="row justify-content-center">
       <div class="col-md-8">
         <div class="card card-primary">
           <div class="card-header">
            mettre à jour d'un administrator
           </div>
           <div class="card-body">
              <form @submit.prevent="updateuser">
                 <div class="form-group">
                            <label>Nom</label>
                            <input v-model="form.name" type="text" name="name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                          </div>
                           <div class="form-group">
                            <label>Email</label>
                            <input v-model="form.email" type="email" name="email"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                          </div>

                          <div class="form-group">
                            <label>Mot de pass</label>
                            <input v-model="form.password" type="password" name="password"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                          </div>
                           <input type="submit" class="btn btn-primary float-right" value="update"/>
              </form>
           </div>
         </div>
       </div>
     </div>
  </div>
</template>
<script type="text/javascript">
  export default{
        data(){
      return {
                      form:new Form({
                        name:'',
                        email:'',
                        password:''
                      })
                      
                      
             }
          },
   methods:{
    updateuser:function(){
             const id=this.$route.params.id;
             this.form.put('/admin/admin/update/'+id).then((response)=>{

             }).catch((err)=>{

             });
         }
       }      
  }
</script>
<style>
</style>