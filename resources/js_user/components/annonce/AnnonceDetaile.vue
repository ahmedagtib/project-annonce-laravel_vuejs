<template>
    <div class="bg">
        <div class="container card_annonce_ui">
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
            <h1 class="card__title">{{ annonce.title }}</h1>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div v-for="(image, index) in annonce.images" :key="index" class="carousel-item"
                        :class="(index === 0) ? 'active':''">
                        <img class="d-block w-100" :src="imgone(image.name)" alt="First slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Slide -->
            <div class="row">
                <div class="col-md-3">
                    <div class="mt-2">
                        <span>Annonceur :</span><br>
                        <span>{{ annonce.user }}</span>
                    </div>
                    <table class="table mt-4">
                        <tr>
                            <td>ville</td>
                            <td>category</td>
                        </tr>
                        <tr>
                            <td v-if="annonce.ville !== undefined">{{ annonce.ville.name }}</td>
                            <td v-if="annonce.categorie !== undefined">{{ annonce.categorie.name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-9">
                    <h5 class="mt-2">description</h5>
                    <p class="load">
                        {{ annonce.description }}
                    </p>
                    <h5 class="mt-2">detaille</h5>
                    <p class="load">
                        {{ annonce.detaille }}
                    </p>
                </div>
            </div>
            <hr>
            <div>
                <commentmain />
            </div>

            <hr>

        </div>
    </div>
</template>
<script type="text/javascript">
    import {
        Carousel3d,
        Slide
    } from 'vue-carousel-3d';

    import commentmain from '../comments/commentmain.vue'
    export default {
        components: {
            commentmain,
            Carousel3d,
            Slide
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
                axios.get('/api/Annoncebyslug/' + this.slug)
                    .then((res) => {
                        if (res.data.stuts === 'ok') {
                            this.$data.annonce = res.data.data[0];
                            this.annonce = res.data.data[0];
                            this.idannonce = res.data.data[0].id;
                        } else {
                            console.log('no')
                        }
                    })
            },



        },
        mounted() {
            const slugr = this.$route.params.slug;
            this.slug = slugr;
            this.getAnnonce()
        },
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
<style scoped>
    .bg {

        background: linear-gradient(to top right, #2C3E50, rgba(222, 185, 224, 0), rgba(44, 62, 80, 0));
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

    /* Slide */

</style>
