<template>
	<div>
		 <div v-if="currentUser">
                  <form @submit.prevent="postcomment">
                     <textarea class="form-control" v-model="commentpost.body"></textarea>
                       <div class="mt-2">
                         <button type="submit" class="btn btn-primary">send</button>
                       </div>
                 </form>
               </div>
               <div v-else>
                  <p>you need to login if you want make comments</p>
               </div>
	 </div>
</template>
<script type="text/javascript">
import {bus} from '../../app.js';
export default{
	created(){
        const slug=this.$route.params.slug;
         this.commentpost.slug=slug;
        	},	
	data(){
            return {
            	 commentpost:{
                                 slug:'',
                                 body:'',
                                 user_id:''
                              },
             }
	     },	
	 methods:{
           postcomment(){
            axios({
                   method: "post",
                   url: "/api/comment", ///
                   data: this.commentpost
              }).then((res)=>{
              	  bus.$emit('commentadd',res.data)

                   this.commentpost.body='';
              })
          }  
	 },    
     computed:{
         currentUser(){
             this.commentpost.user_id=this.$store.getters.currentUser.id; 
             return this.$store.getters.currentUser.id;
         }
	}
}
</script>
<style scoped>
	
</style>