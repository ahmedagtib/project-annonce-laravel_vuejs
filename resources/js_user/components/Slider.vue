<template>

    <div class="detail-slider">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">

              <slot name="indecator"></slot>

            </ol>
            <div class="carousel-inner">

              <slot name="inner"></slot>
                
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <i class="fa fa-chevron-left text-primary"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <i class="fa fa-chevron-right text-primary"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- End details slider -->
</template>

<script>
    import $ from 'jquery'
    export default {
        props: {
          
        }
    }

    $(function () {
        console.log('I\'m Jquery I\'m')
    })

</script>


<style lang="scss" scoped>
  @import './annonce/annoncesStore';
  .carousel-control-next,
  .carousel-control-prev {
    height: 100%;
    background: none
  }
  .detail-slider {      
    padding-bottom: 70px !important;
  }
  .carousel-indicators {
      bottom: -72px !important;
  }
</style>
