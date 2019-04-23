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
            <!-- <img :src="imgone('smart.jpg')" width="100%"> -->
            <!-- <Slide v-if="annonce.images !== undefined" :images="annonce.images" /> -->
            <!-- Slide -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div v-for="(image, index) in annonce.images" :key="index" class="carousel-item" :class="(index === 0) ? 'active':''">
                        <img class="d-block w-100" :src="imgone(image.name)"
                            alt="First slide">
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
<!-- 
            <div id="carousel3d">
                <Carousel3d :perspective="0" :space="200" :display="3" :controls-visible="true"
                    :controls-prev-html="'❬'" :controls-next-html="'❭'" :controls-width="30" :controls-height="60"
                    :clickable="true" :autoplay="true" :autoplay-timeout="5000">
                    <Slide v-for="(image, index) in annonce.images" :key="index" :index="index">
                        <img :src="imgone(image.name)" />
                    </Slide>

                </Carousel3d>
            </div> -->

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
                <span>jack=>></span><span>wow nice prudact!!!</span>
            </div>
            <div>
                <textarea class="form-control"></textarea>
                <div class="mt-2">
                    <a href="#" class="btn btn-primary">send</a>
                    <a href="#" class="btn btn-warning">clear</a>
                </div>
            </div>

        </div>
    </div>
</template>
<script type="text/javascript">


    import {
        Carousel3d,
        Slide
    } from 'vue-carousel-3d';

    export default {
        components: {
            Carousel3d,
            Slide
        },
        data() {
            return {
                annonce: {},
                Slides: 7
            }
        },
        methods: {
            imgone(imageName) {
                return '/image/annonce/' + imageName
            },

            getAnnonce() {
                const slug = this.$route.params.slug
                axios.get('/api/annonce/single/' + slug)
                    .then(({
                        data
                    }) => {
                        this.annonce = data[0]
                        console.log(data)
                    })
            }

        },
        mounted() {
            this.getAnnonce()
        }
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
