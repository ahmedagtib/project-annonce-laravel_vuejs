<template>
	<div class="container">
		 <div class="row">
            	 <div class="col-md-3 home_stat">
            	 	  <div class="stat pb">
            	 	 	 Total annonces publié
            	 	 	 <span>{{count.annoncepublished}}</span>
            	 	  </div>
            	 </div>
            	 <div class="col-md-3 home_stat">
            	 	  <div class="stat pd">
            	 	 	 Total annonces panddeing
            	 	 	 <span>{{count.annoncepandding}}</span> 
            	 	  </div>
            	 </div>
            	  <div class="col-md-3 home_stat">
            	 	  <div class="stat bk">
            	 	 	 Total annonces bloqué 
            	 	 	 <span>{{count.annonceblocked}}</span>
            	 	  </div>
            	 </div>
            	 <div class="col-md-3 home_stat">
            	 	  <div class="stat com">
            	 	 	 Total commentaires 
            	 	 	 <span>{{count.comment}}</span>
            	 	  </div>
            	 </div>
            </div>  
           <div class="row mt-4">
                 <div class="col-md-6">
                       <div class="card">
                          <div class="card-header">
                            Featured
                          </div>
                          <div class="card-body">
                             <graph></graph>
                          </div>
                        </div>   
                 </div>
                 <div class="col-md-6">
                      <div class="card">
                          <div class="card-header">
                            Featured
                          </div>
                          <div class="card-body">
                             
                          </div>
                        </div>  
                 </div>
           </div>
	</div>

</template>
<script type="text/javascript">
import graph from "./graph/annoncegraph.vue";
	export default{
            components:{
                graph  
            },
            created(){
              this.getnumberannonce();
            },
            data(){
              return{
                count:{}
              }
            },
            methods:{
               getnumberannonce() {
                  axios.get('/admin/getnumberannonce').then((res)=>{
                    this.count=res.data;
                   
                  })
              }
            }

	}
</script>
<style scoped>
	.home_stat{
	text-align: center;
}
.home_stat .stat{
	background-color: #EEE;
	padding: 20px;
	font-size: 15px;
	color: #FFF;
	border-radius: 6px;
} 
.home_stat .stat span{
    display: block;
    font-size:50px;
}
.home_stat .pb{
	background-color: #3498db;
}
.home_stat .bk{
	background-color: #c0392b;
}
.home_stat .pd{
	background-color: #d35400;
}
.home_stat .com{
	background-color: #8e44ac;
}
</style>