<template>
	<div>
		<chartjs-doughnut
         v-bind:labels="labels"
         v-bind:datasets="datasets"
         v-bind:option="option"
  		></chartjs-doughnut>
	</div>
</template>
<script type="text/javascript">
	export default{
       
        data(){
        	return {
        		labels:["blocked","published","pandding"],
        		datasets:[
        		{
        			data:[0,12,50],
        			backgroundColor:["red","purple","yellow"]
        		}],
        		option:{
        			title:{
        				display:true,
        				position:"bottom",
        				text:"annonce"
        			}
        		},
                count:{}
        	}
        },
        methods:{
          getnumberannonce() {
            const self=this;
                  axios.get('/admin/getnumberads').then((res)=>{
                    this.count=res.data;
                    //this.datasets[0].data[0]=res.data.annonceblocked;
                    //this.datasets[0].data[1]=res.data.annoncepublished;
                   // this.datasets[0].data[2]=res.data.annoncepandding;
                  })
              }
        },
        mounted(){
            this.getnumberannonce();
            //console.log(this.datasets[0].data)
        }
	}
</script>
<style scoped>

</style>