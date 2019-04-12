<template>
	 <div class="bg">
	 	 <div class="card_annonce_ui">
          <div class="row">
             <div class="col-md">
                 <div class="text-left">
                     <span class="text-danger"><i class="fa fa-heart fa-2x"></i><br>123</span>
                 </div>
             </div>
              <div class="col-md">
                 <div class="text-right">
                    <span class="text-primary"><i class="fa fa-comment fa-2x"></i><br>120 Dh</span>
                 </div>
             </div>
          </div>               
             <h1 class="card__title">awsome cloths</h1>
             <img :src="imgone('smart.jpg')" width="100%">
             <div class="row">
                <div class="col-md-3">
                  <div class="mt-2">
                      <span>Annonceur :</span><br>
                      <span>ali ali</span>
                  </div>
                  <table class="table mt-4">
                      <tr>
                        <td>ville</td>
                        <td>category</td>
                      </tr>
                      <tr>
                        <td>safi</td>
                        <td>teack</td>
                      </tr>
                  </table>
                </div>
                <div class="col-md-9">
                     <h5 class="mt-2">description</h5>
                     <p class="load">
                       Working in Vuejs, Laravel and Quasar all together, i made a dashboard for Admin. now i want to find the number of current products, users and orders are saved in a separate table each in mySQL database. i was not able to do so, and what i understood is that we can do it via. is there anyway to do that? this is where i want to show to show the number of elements:
                     </p>
                      <h5 class="mt-2">detaille</h5>
                     <p class="load">
                       Working in Vuejs, Laravel and Quasar all together, i made a dashboard for Admin. now i want to find the number of current products, users and orders are saved in a separate table each in mySQL database. i was not able to do so, and what i understood is that we can do it via. is there anyway to do that? this is where i want to show to show the number of elements:
                     </p>
                </div>
             </div>
               <hr>
               
               <div>
                     <span>jack=>></span><span>wow nice prudact!!!</span>
               </div>
                <div>
                  <textarea class="form-control"></textarea>
                   <div class="mt-2">
                      <a href="#"class="btn btn-primary">send</a>
                     <a href="#" class="btn btn-warning">clear</a>
                   </div>
               </div>

       </div>
	 </div>
</template>
<script type="text/javascript">
	
	export default{
         methods:{
        imgone(imageName){
            return '/image/slider/'+ imageName
         }
      
	     }
	}
</script>
<style scoped>
     .bg{
       
        background: linear-gradient(to top right,#2C3E50 ,rgba(222, 185, 224, 0) ,rgba(44, 62, 80, 0));
        height: 100%;
        width: 100%;
         padding-bottom: 2%;

       }
       .text-primary {
           color: #2c3e50 !important;
       }
       .btn-primary {
          color: #fff;
         background-color: #2c3e50;
        border-color: #2c3e50;
        }



.card_annonce_ui {
  width: 60%;
  margin: 2% auto;
  margin-bottom: 0;
  padding: 2% 5%;
  border-radius: 10px;
  box-shadow: 2px 2px 6px rgba(0, 0, 0, .4);
  background-color: #ffffff;
  font-family: sans-serif;
   opacity: 0.8;
   
}

</style>