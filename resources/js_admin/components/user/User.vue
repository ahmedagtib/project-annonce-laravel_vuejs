<template>
<div>
	<div class="container">
		 <div class="row justify-content-center">
		 	 <div class="col-md-12">
		 	 	<div class="card card-light">
		 	 		<div class="card-header">
		 	 			Manage users
		 	 			<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                          Add user
                       </button>
		 	 		</div>
		 	 		<div class="card-body pd-0">
		 	 			    <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                         <th scope="col">email</th>
                        <th scope="col">created at</th>
                        <th scope="col">action</th>
                    </tr>
                    <tr v-for="user in users.data">
                      <td scope="row">{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.created_at}}</td>
                      <td>
                          <router-link :to="'/admin/user/edit/'+user.id" class="btn btn-warning"><i class="fa fa-edit"></i></router-link>
                        <a  @click="onDelete(user.id,user.name)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                </thead>
             </table>
             
              <pagination :data="users" @pagination-change-page="getResult">
              </pagination>
		 	 		</div>
		 	 	</div>
		 	 </div>
		 </div>
	</div>
	<!-- Modal -->
         <form @submit.prevent="createuser">
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
                       
                          <div class="form-group">
                            <label>name</label>
                            <input v-model="form.name" type="text" name="name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                          </div>
                           <div class="form-group">
                            <label>email</label>
                            <input v-model="form.email" type="email" name="email"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                          </div>

                          <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="password" name="password"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                          </div>
                       
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <input type="submit" class="btn btn-primary" value="add new" />
                   </div>
                 </div>
               </div>
           </div>
          </form> 
</div>
</template>
<script type="text/javascript">
	import pagination from 'laravel-vue-pagination'
	export default{
    components: {
      pagination
    },
		 data(){
		 	return {
                      form:new Form({
                      	name:'',
                      	email:'',
                      	password:''
                      }),
                      users:{}
		 	       }
		        },
		methods:{
			createuser:function(){
          this.form.post('/admin/user/all')
			},
      getusers:function(){
         axios.get('/admin/user/all').then((response)=>{
                 this.users=response.data.data;
         })
      },
      getResult:function(page = 1){
         axios.get('/admin/user/all?page=' + page).then((response)=>{
           this.users=response.data.data;
           console.log('this',this.users.data)
         })
      },
      onDelete:function(id,user){
          if(confirm('do you want delete'+user)){
            axios.delete('/admin/user/delete/'+id).then((response)=>{
                  this.getusers();
            }).
            catch((err)=>{

            })
          }
      }
		},
    created(){
      this.getusers();
    }        
	}
</script>
<style type="text/css">
	
</style>