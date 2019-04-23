<template>
	
		 <div class="media">
                     <img src="" class="mr-3" alt="">
                          <div class="media-body">
                             <h5 class="mt-0">{{comment.comments.user.name}}</h5>
                               {{comment.comments.body}}
                          </div>
           </div>
	
</template>
<script type="text/javascript">
	export default{
		props:['comment'],
         data(){
         	return{
         		
         	}
         }
	}
</script>
<style scoped>
	
</style>