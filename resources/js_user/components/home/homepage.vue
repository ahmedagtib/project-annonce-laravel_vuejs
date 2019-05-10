<template>
	<div class="bg-image">
		 <slider></slider>
		 <sectionone></sectionone>
	</div>
</template>
<script type="text/javascript">
import slider from './slider.vue';
import sectionone from './sectionone.vue';
	 export default{
       components:{
         slider,sectionone
       }
	}
</script>

<style>

	.bg-image {
		background-image: url('../annonce/imagedoodle.jpg')
	}

</style>



