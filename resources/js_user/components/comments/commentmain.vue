<template>
	<div>
	<commentadd></commentadd>
	<div v-for="comment in comments" :key="comment.id">
		<comment :comment="comment"></comment>
	</div>
	</div>
</template>
<script type="text/javascript">
import commentadd from './commentadd.vue'
import comment from './comment.vue'
import {bus} from '../../app.js';
	export default{
		created(){
			bus.$on('commentadd',comment=>this.newcommenthere(comment));
             this.loadcomment();
        	},
		components:{
          commentadd,
          comment
		},
		data(){
			return{
			  comments:[],
			  	
			}
		},
	    methods:{
	    	      newcommenthere(comment){
                  // this.comments.unshift(comment);
                  this.loadcomment();
	    	      },
                  loadcomment(){
                  	axios.get('/api/commentuser/'+this.$route.params.slug).then((res)=>{
                       if(res.data.state==='yes'){
                           this.comments=res.data.data;
                           console.log(res.data.data);
                        }  
                    })
                  }                

	            }	
	}

</script>
<style scoped>
	
</style>