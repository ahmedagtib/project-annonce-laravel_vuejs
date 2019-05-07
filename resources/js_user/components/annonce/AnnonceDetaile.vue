<template>
    <div class="content_wrapper">
        <div class="container details">

            <div id="map" style="height:/* 45*/0px"></div>


            <div class="row pv-50">
                <div class="col-md-8">

                    <div class="detail-header clearfix">

                        <div class="detail-header-name">
                            <h3 class="mb-0">{{ annonce.title }}</h3>
                            <span class="location"><i class="fa fa-map-marker mr-1 text-danger">
                                </i>{{ annonce.ville.name }}</span>
                        </div>
                        <div class="detail-header-price">
                            <span class="price">{{ annonce.prix }}<span>DH</span></span>
                        </div>
                        <!-- <div class="detail-header-review">
                            <i class="fa fa-bookmark-o"></i>
                            <span><i class="fa fa-eye"></i>234</span>
                        </div> -->
                    </div>
                    <!-- End details slider
               
          -->
                    <Slider>

                        <!-- Indecator -->
                        <template v-slot:indecator>
                            <li v-for="(image, index) in annonce.images" :key="index"
                                data-target="#carouselExampleIndicators" :class="index == 0 ? 'active' : ''"
                                :data-slide-to="index">
                                <img :src="imgone(image.name)" alt="Detailts">
                            </li>
                        </template>

                        <!-- Images -->
                        <template v-slot:inner>
                            <div v-for="(image, index) in annonce.images" :key="index" class="carousel-item"
                                :class="index == 0 ? 'active' : ''">
                                <img class="d-block w-100 active" :src="imgone(image.name)">
                            </div>
                        </template>
                    </Slider>
                    <!-- End details slider -->
                    <ul class="nav nav-tabs mt-20" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab"
                                aria-controls="Reviews" aria-selected="false">Commentaire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false"><i class="fa fa-map-marker"></i> Map</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <p>{{ annonce.detaille }}</p>

                            <p>{{ annonce.description }}</p>
                        </div>
                        <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                            <h3>Commnontaire</h3>

                            <commentmain />
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div id="demoMap" class="mx-auto" style="height: 450px; width:100%; "></div>
                        </div>
                    </div><!-- End tab-content -->
                </div>
                <div class="col-md-4 mt-10">
                    <div class="sidebar">
                        <!-- <div class="sidebar-item mb-20">
								<div class="lp-box">
									<i class="text-info fa fa-quote-left"></i>
									<p class="no-mb">Excited him now natural saw passage offices you minuter. At by asked being court hopes. Farther so friends am to detract. Forbade concern do private be.</p>
									<cite class="text-info"><strong>Robert Johnson</strong> from Canada</cite>
								</div>
							</div> -->

                        <div class="sidebar-item mb-20">
                            <div class="lp-box">
                                <i class="text-info fa fa-phone-square"></i>
                                <h4>Need Assistance?</h4>
                                <p>Our team is 24/7 at your service to help you with your booking issues or answer any
                                    related questions
                                </p>
                                <span class="text-info font24">+1900 12 213 21</span>
                            </div>
                        </div>

                        <div class="sidebar-item listing mb-20">
                            <div class="row">
                                <div class="col-12 ph-5">
                                    <div class="list-group mb-10">
                                        <a href="" class="list-group-item list-group-item-action ">
                                            <div class="list-img">
                                                <img src="/assets/images/sliders/list.jpg" alt="Card image cap">
                                                <div class="image-overlay">
                                                    <div class="overlay-content">
                                                        <div class="overlay-icon"><i class="fa fa-camera"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-content">
                                                <h4 class="list-item-title">Tite</h4>
                                                <span class="list-item-date text-muted">Titre </span>
                                                <span class="list-item-price">200<span>DH</span></span>
                                                <span class="list-item-view"><i class="fa fa-eye"></i>267</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 ph-5">
                                    <div class="list-group mb-10">
                                        <a href="" class="list-group-item list-group-item-action ">
                                            <div class="list-img">
                                                <img src="/assets/images/sliders/list1.jpg" alt="Card image cap">
                                                <div class="image-overlay">
                                                    <div class="overlay-content">
                                                        <div class="overlay-icon"><i class="fa fa-camera"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-content">
                                                <h4 class="list-item-title">Titre 2</h4>
                                                <span class="list-item-date text-muted">Titre </span>
                                                <span class="list-item-price">200<span>DH</span></span>
                                                <span class="list-item-view"><i class="fa fa-eye"></i>267</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- end content_wrapper -->
</template>
<script type="text/javascript">
    import commentmain from '../comments/commentmain.vue'
    import Slider from '../Slider'
    export default {
        components: {
            commentmain,
            Slider
        },
        data() {
            return {
                annonce: {},
                slug: '',
                idannonce: ''
            }
        },
        methods: {
            imgone(imageName) {
                return '/image/annonce/' + imageName
            },

            getAnnonce() {

                this.$Progress.start()
                axios.get('/api/Annoncebyslug/' + this.slug)
                    .then((res) => {
                        if (res.data.stuts === 'ok') {
                            this.$data.annonce = res.data.data[0];
                            this.annonce = res.data.data[0];
                            this.idannonce = res.data.data[0].id;
                            console.log('Images Null ?', this.annonce.images === null)
                            console.log('Images undefined ?', this.annonce.images === undefined)
                            console.log('Images Lenght', this.annonce.images.length)
                            console.log('Images [', this.annonce.images === [])
                            this.$Progress.finish()
                        } else {
                            console.log('no')

                            this.$Progress.fail()
                        }
                    }).catch(() => {
                        this.$Progress.fail()

                    })
            },



        },
        mounted() {
            const slugr = this.$route.params.slug;
            this.slug = slugr;
            this.getAnnonce()
        },
        updated() {
        }
        /*
       computed:{
         currentUser(){
              this.commentpost.user_id=this.$store.getters.currentUser.id;
              return this.$store.getters.currentUser;  
         },
         
      getcomment(){
           axios.get('/api/commentuser/'+this.idannonce).then((res)=>{
            if(res.data.state==='yes'){
                   this.comments=res.data.data;
                   console.log(res.data.data);
             }  
           })
                        
          }
       }
       */
    }

</script>
<style lang="scss" scoped>
    @import 'annoncesStore';
    .carousel-control-next {
        height: 100% !important;
    }
</style>
