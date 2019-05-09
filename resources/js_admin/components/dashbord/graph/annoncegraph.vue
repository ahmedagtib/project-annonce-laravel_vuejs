<template>
	<div>
		<chartjs-doughnut
         v-bind:labels="labels"
         v-bind:name="name"
         v-bind:datasets="datasets"
         v-bind:option="option"
  		></chartjs-doughnut>
	</div>
</template>
<script type="text/javascript">
	export default{
       
        data(){
        	return {
             name: 'my-line-chart',
        		labels:["blocked","published","pandding"],
        		datasets:[
        		{
        			data:[0,12,23],
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
                    this.datasets[0].data[0]=res.data.annonceblocked;
                    this.datasets[0].data[1]=res.data.annoncepublished;
                   this.datasets[0].data[2]=res.data.annoncepandding;
                   this.my-line-chart.update();
                  })

                 
              }
        },
        mounted(){
            this.getnumberannonce();
           this._chart.destroy()
      this.renderChart(this.data, this.options)
            //console.log(this.datasets[0].data)
            
        },
        watch: {
         datasets : {
          handler (newData, oldData) {
          this._chart.destroy()
      this.renderChart(this.data, this.options)

         },
         deep: true
       }
         
        }
	}
</script>
<style scoped>

</style>