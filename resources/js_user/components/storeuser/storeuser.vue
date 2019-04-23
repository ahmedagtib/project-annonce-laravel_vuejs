<template>
	<div class="container">
       <h3 class="text-center">my store</h3>
        <div class="row">
       	      <div v-for="annonce in mystore.data" :key="annonce.id" class="col-md-3 annonce mb-4">
                    <div class="card mb-2">
                      <img v-if="annonce.images[0] !== undefined" :src="imageDirectory(annonce.images[0].name)">
                       <div class="card-link">
                           <router-link :to="'/annonce/' + annonce.slug">{{ annonce.title.substr(0,20) }}</router-link>
                       </div>
                    </div>
                </div>
        </div>
      <pagination :limit="3" :data="mystore" @pagination-change-page="getstoreuser"></pagination>
	</div>
</template>
<script type="text/javascript">
	export default{
     created(){
       this.user.id=this.$store.getters.currentUser.id;
       this.getstoreuser()
      },
      data(){
        return{
                
                user:{id:''},
                mystore:{}   
              }
      },
      methods:{
      imageDirectory (name) {return '/image/annonce/' + name},
      getstoreuser(page = 1){
        axios({
            method:"post",
            url: "/api/auth/userstore?page="+page, ///
            data:this.user
           }).then(response => {
                 this.mystore = response.data;
            });
        },
       


      },
    computed:{
      currentUser(){
        
        return this.$store.getters.currentUser;
      },

    }
	}
</script>
<style scoped>
.col-md-3.annonce {
  height: 350px;
}
.card {
  position: relative;
  overflow: hidden;
  box-shadow: 0 2px 20px rgba(25, 29, 50, 0.23);
  transition: all 0.3s linear;
  height: 100%;
}
.card .card-link a {
  text-decoration: none;
  color: #fff;
}

.card .card-link {
  position: absolute;
  bottom: 50px;
  color: #fff;
  text-align: center;
  right: 100%;
  width: 100%;
  /*background-color:rgba(255, 165, 0, 0.19);*/
  background-color: rgba(44, 62, 80, 0.52);
  transition: all 0.3s linear;
  padding: 10px 10px;
  text-transform: uppercase;
  letter-spacing: 3px;
}
.card:hover .card-link {
  right: 0;
}
.card img {
  height: 100%;
  transition: all 0.3s linear;
}
.card:hover img {
  transform: scale(1.2);
}
</style>
