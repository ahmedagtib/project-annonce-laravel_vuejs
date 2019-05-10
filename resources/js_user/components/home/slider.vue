<template>
	<section class="slider">
        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
             <div class="carousel-item active">
                 <div class="mask flex-center">
                   <div class="container">
                     <div class="row align-items-center">
                       <div class="col-md-7 col-12 order-md-1 order-2">
              
                            <h4>Present your <br>
                           awesome product</h4>
                           <p>Lorem ipsum dolor sit amet. Reprehenderit, qui blanditiis quidem rerum <br>
                             necessitatibus praesentium voluptatum deleniti atque corrupti.</p>
                           <a href="#">BUY NOW</a> 
              
                        </div>
                       <div class="col-md-5 col-12 order-md-2 order-1"><img  :src="imgone('one.png')" class="mx-auto" alt=           "slide"></div>
                     </div>
                   </div>
                 </div>
             </div>
            <div class="carousel-item">
                 <div class="mask flex-center">
                   <div class="container">
                     <div class="row align-items-center">
                       <div class="col-md-7 col-12 order-md-1 order-2">
                         <h4>Present your 3<br>
                           awesome product</h4>
                         <p>Lorem ipsum dolor sit amet. Reprehenderit, qui blanditiis quidem rerum <br>
                           necessitatibus praesentium voluptatum deleniti atque corrupti.</p>
                         <a href="#">BUY NOW</a> </div>
                       <div class="col-md-5 col-12 order-md-2 order-1"><img :src="imgone('three.png')" class="mx-auto" alt=           "slide"></div>
                     </div>
                   </div>
                 </div>
            </div>
           <div class="carousel-item">
                <div class="mask flex-center">
                  <div class="container">
                    <div class="row align-items-center">
                      <div class="col-md-7 col-12 order-md-1 order-2">
                        <h4>Present your <br>
                          awesome product</h4>
                        <p>Lorem ipsum dolor sit amet. Reprehenderit, qui blanditiis quidem rerum <br>
                          necessitatibus praesentium voluptatum deleniti atque corrupti.</p>
                        <a href="#">BUY NOW</a> </div>
                      <div class="col-md-5 col-12 order-md-2 order-1"><img :src="imgone('tow.png')" class="mx-auto" alt="slide"></div>
                    </div>
                  </div>
                </div>
           </div>
        </div>
         <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> 
      </div>
</section>
</template>
<script type="text/javascript">
	export default{
    data(){
      return {
           
      }
    },
    methods:{
        imgone(imageName){
            return '/image/slider/'+ imageName
         },
         imeges(imgName) {
           return 'images/' + imgName
         }
      
	     }
    }
</script>