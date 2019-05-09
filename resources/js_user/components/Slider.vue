<template>

    <div class="detail-slider" ref="detail">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators" ref="indecator">

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
    export default {
        data() {
          return {
            slider: {
              padding: 0
            },
            indecator: {
              height: 0
            }
          }
        },
        props: {
          
        },
        methods: {
            matchLayout() {

              // this.slider.padding = window.getComputedStyle(this.$refs.detail).paddingBottom getPropertyValue
              this.slider.padding = this.$refs.indecator.getBoundingClientRect()
              this.$refs.indecator.style.height = this.slider.padding
              this.$refs.indecator.style.bottom = this.slider.padding
              console.log(this.slider)
            }
        },
        mounted() {

            this.matchLayout()

        },
        updated() {

        }
    }

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
    bottom: -60px !important
  }
  .carousel-indicators {
  }
</style>
