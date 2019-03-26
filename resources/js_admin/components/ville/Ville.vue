<template>
<div>
	<div class="container">
		 <div class="row justify-content-center">
      <alert-success :form="form">city created Done</alert-success>
		 	 <div class="col-md-12">
		 	 	<div class="card card-light">
		 	 		<div class="card-header">
		 	 			Manage villes
		 	 			<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                          Add ville
            </button>
		 	 		</div>
		 	 		<div class="card-body pd-0">
		 	 			 <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">created at</th>
                        <th scope="col">action</th>
                    </tr>
                    <tr v-for="ville in villes">
                      <td scope="row">{{ville.id}}</td>
                      <td>{{ville.name}}</td>
                      <td>{{ville.created_at}}</td>
                      <td>
                        <router-link :to="'/admin/ville/edit/'+ville.id" class="btn btn-warning"><i class="fa fa-edit"></i></router-link>
                        <a  @click="onDelete(ville.id,ville.name)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                </thead>
             </table>
		 	 		</div>
		 	 	</div>
		 	 </div>
		 </div>
	</div>
	<!-- Modal -->
  <form @submit.prevent="createville">
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
                       
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <input type="submit" class="btn btn-primary" value="add new"/>
                   </div>
                 </div>
               </div>
           </div>
          </form>
  
</div>
</template>
<script type="text/javascript">
	export default{
		 data(){
		 	return {
                      form:new Form({
                      	name:'',
                      }),
                      villes:{}
		 	       }
		        },
		methods:{
			createville:function(){
             this.form.post('/admin/ville/all').then((response)=>{

             }).catch((err)=>{

             });
			},
      getville:function(){
            axios.get('/admin/ville/all').then((response)=>{
                 this.villes=response.data.data;
            }).catch((err)=>{

            });
      },
      onDelete:function(id,name){
          if(confirm('do you want delete'+name)){
            axios.delete('/admin/ville/delete/'+id).then((response)=>{
                  this.getville();
            }).
            catch((err)=>{

            })
          }
      }
		},
    created(){
      this.getville();
    }        
	}
</script>
<style type="text/css">
	
</style>