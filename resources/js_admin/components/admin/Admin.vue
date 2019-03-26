<template>
<div>
	<div class="container">
		 <div class="row justify-content-center">
		 	 <div class="col-md-12">
		 	 	<div class="card card-light">
		 	 		<div class="card-header">
		 	 			Manage admins
		 	 			<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                          Add admin
                       </button>
		 	 		</div>
		 	 		<div class="card-body">
		 	 			
		 	 		</div>
		 	 	</div>
		 	 </div>
		 </div>
	</div>
	<!-- Modal -->
           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="  exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                       <form @submit.prevent="createadmin">
                          <div class="form-group">
                            <label>name</label>
                            <input v-model="form.name" type="text" name="name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                            <has-error :form="form" field="username"></has-error>
                          </div>
                           <div class="form-group">
                            <label>email</label>
                            <input v-model="form.email" type="email" name="email"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                            <has-error :form="form" field="username"></has-error>
                          </div>

                          <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="password" name="password"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                          </div>
                       </form>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Add new</button>
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
			createadmin:function(){

			}
		}        
	}
</script>
<style type="text/css">
	
</style>