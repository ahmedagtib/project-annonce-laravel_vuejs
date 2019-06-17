<template>
    <div>
        <div>
            <div class="text-center mt-4 z-index-1">
                <h2 class="text-dark heading mx-auto w-md-25">Sponsorisé</h2>
                <div class="line-hr"></div>
            </div>
            <div class="clearfix"></div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-3 col-md-6 annonce mb-4" v-for="ads in adspayhome">
                        <div class="card mb-2 fadeInDown">
                            <img v-if="ads.imageAnnonce !== null" :src="imgone(ads.imageAnnonce.name)">
                            <div class="card-link">
                                <a href="#">{{ads.annonce.title}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============== -->
        <div>
            <div class="text-center mt-4 z-index-1">
                <h2 class="text-dark heading mx-auto w-md-25">Suggestion</h2>
                <div class="line-hr"></div>
            </div>
            <div class="clearfix"></div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-3 col-md-6 annonce mb-4" v-for="ads in adsfreehome">
                        <div class="card mb-2 fadeInDown">
                            <img v-if="ads.imageAnnonce !== null" :src="imgone(ads.imageAnnonce.name)">
                            <div class="card-link">
                                <a href="#">{{ads.annonce.title}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import {
        mapGetters,
        mapActions
    } from "vuex";
    export default {
        methods: {
            ...mapActions(['getadspay', 'getadsfree']),
            imgone(imageName) {
                return '/image/annonce/' + imageName
            },


        },
        computed: mapGetters(['adspayhome', 'adsfreehome']),
        created() {
            this.getadspay();
            this.getadsfree();

        },

    }

</script>
<style lang="scss" scoped>
    $margin: 40px;
    .annonce {
        height: 350px;
    }

    .card {
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 20px rgba(25, 29, 50, 0.23);
        transition: all 0.3s linear;
        height: 100%;
        border-radius: 0;
    }

    .card .card-link a {
        text-decoration: none;
        color: #fff;
    }

    .card .card-link {
        position: absolute;
        bottom: 50px;
        color: #fff;
        text-align: center;
        right: 100%;
        width: 100%;
        /*background-color:rgba(255, 165, 0, 0.19);*/
        background-color: rgba(44, 62, 80, 0.52);
        transition: all 0.3s linear;
        padding: 10px 10px;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .card:hover .card-link {
        right: 0;
    }

    .card img {
        height: 100%;
        transition: all 0.3s linear;
    }

    .card:hover img {
        transform: scale(1.2);
    }

    .z-index-1 {
        position: relative;
        z-index: 1;
    }

    .w-md-50 {
        @media (min-width: 768px) {
            width: 50%;
        }
    }

    .w-md-25 {
        @media (min-width: 768px) {
            width: 25%;
        }
    }

    .line-hr {

      border-bottom: 2px solid #140028;
      margin: 0 auto $margin auto;
      width: 30%;

    }

    .heading {
      margin: {
        top: $margin;
        bottom: $margin;
      }
    }

</style>
