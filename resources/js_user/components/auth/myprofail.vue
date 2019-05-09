<template>
<div>	
 <div class="addannonce_free" v-if="myprofail.data!=null">
  <div class=" overlay">
       <div class="card_annonce">
       	 <router-link class="btn btn-warning float-right"  to="/profil"><i class="fa fa-edit"></i></router-link>
            <h1 class="card__title">Bienvenu {{getuser.name}} </h1>
            <p class="card__description">{{getuser.email}}</p>
            <hr>
            <div class="container mt-4" >
            	<div class="row">
            		<div class="col-md-4">
            			<img :src="imageDirectory(myprofail.data.image)" width="200" height="200">
            		</div>
            		<div class="col-md-8">
            			 <h4>Nom: {{myprofail.data.last_name}}</h4>
            			 <h4>prenom: {{myprofail.data.first_name}}</h4>
            			 <h5>Télephone: {{myprofail.data.telephone}}</h5>
            			 <h5>Adresse: {{myprofail.data.adresse}}</h5>
            		</div>
            	</div>
            	<h6>description: {{myprofail.data.description}}</h6>
            </div>
            <hr>
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
       </div>
     </div>
 </div>  
 <div class="container" v-else>
   <h1 class="text-center mt-4">tu dois
    	<router-link class="btn btn-primary" to="/profil">Crée votre profil</router-link>
   </h1> 	
  
 </div>

</div>
</template>
<script type="text/javascript">
	
	export default{
	 created(){
       this.user.id=this.$store.getters.currentUser.id;
       this.getprofail();
       this.getcountinfo();

      },
       data(){
       	return{
       		   user:{id:''},
               myprofail:{},
               count:{}
       	     }
       },
       methods:{
            imageDirectory (name) {
                    return '/image/users/' + name
             },
            getprofail(){
               axios({
                   method:"post",
                   url: "/api/auth/getprofail", ///
                   data:this.user
                  }).then(response => {
                        this.myprofail = response.data;
                       
                   });
            },
            getcountinfo(){
              axios.get('/api/auth/getinfo/'+this.$store.getters.currentUser.id).
              then((res)=>{
                this.count=res.data;
              })
            }
        },
        computed:{
           getuser(){
              return  this.$store.getters.currentUser;
           }
        }
	}
</script>
<style scoped>
.fa{
	color: #FFF;
}
.addannonce_free{
  width: 100%;
  height: 100%;
   background: linear-gradient(to top right,#2C3E50 ,rgba(222, 185, 224, 0) ,rgba(44, 62, 80, 0));
  
}

.card_annonce {
        width: 60%;
        margin: 2% auto;
        margin-bottom: 0px;
        margin-top: 0px;
        padding: 2% 5%;
        border-radius: 10px;
        box-shadow: 2px 2px 6px rgba(0, 0, 0, .4);
        background-color: #ffffff;
        font-family: sans-serif;
        opacity: 0.9;

    }
.card__title{
    text-align: center;
}
.card__description{
    text-align: center;
}
.addannonce_free .btn-primary{
    background-color: #324455;
    border-color: #2c3e50;
}
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
 .addannonce_free{
        background-image:url('./imagedoodle.jpg');


    }
     .overlay {
       position: relative;
      background-color:rgba(14, 160, 159, 0.5) !important;
      padding:2% 0;
    }
</style>
