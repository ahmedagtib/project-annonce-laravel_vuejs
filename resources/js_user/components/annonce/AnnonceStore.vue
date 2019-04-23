<template>
    <div class="container">
        <div class="row mx-auto mb-4">
            <div class="col-md-3 ">
                <label for="">Choiser category</label>
                <select v-model="filters.categorie_id" class="custom-select mb-sm-2 mb-md-0">
                    <option disabled selected :value="-1">category</option>
                    <option v-for="cat in allcategory" :key="cat.id" :value="cat.id">{{cat.name}}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Choiser ville</label>
                <select class="custom-select" v-model="filters.ville_id">
                    <option disabled selected value="-1">ville</option>
                    <option v-for="ville in allville" :key="ville.id" :value="ville.id">{{ville.name}}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for>Min prix</label>
                <input v-model="filters.min_prix" type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label for>Max prix</label>
                <input v-model="filters.max_prix" type="text" class="form-control">
            </div>
        </div>
        <!-- Start Afficher Annonce -->
        <div class="row">
            <div v-for="annonce in annonces.data" :key="annonce.id" class="col-md-3 mb-4 annonce">
                <div class="card mb-2">
                    <img v-if="annonce.images[0] !== undefined" :src="imageDirectory(annonce.images[0].name)">
                    <div class="card-link mx-2">
                        <router-link :to="'/annonce/' + annonce.slug">{{ annonce.title.substr(0,20) }}</router-link>
                    </div>
                </div>
            </div>
        </div>
        <pagination :limit="3" :data="annonces" @pagination-change-page="getResults"></pagination>
    </div>
</template>
<script type="text/javascript">
    import card from "./AnnonceCard.vue";
    import pagination from 'laravel-vue-pagination'
    import {
        mapGetters,
        mapActions
    } from "vuex";
    export default {
        components: {
            card,
            pagination
        },
        data() {
            return {
                annonces: {},
                filters: {
                    ville_id: -1,
                    categorie_id: -1,
                    min_prix: 0,
                    max_prix: 0
                }
            };
        },
        methods: {

            ...mapActions(["getville", "getcategory"]),
            getResults(page = 1) {
                axios({
                    method: "post",
                    url: "api/all?page=" + page, ///
                    data: this.filters
                }).then(response => {
                    this.annonces = response.data;
                });

            },
            imageDirectory(name) {

                return '/image/annonce/' + name

            },
            ...mapActions(["getville", "getcategory"]),
            getResults(page = 1) {
                axios({
                    method: "post",
                    url: "api/all?page=" + page, ///
                    data: this.filters
                }).then(response => {
                    this.annonces = response.data;
                });
            }
        },
        watch: {
            filters: {
                handler(val, oldVal) {
                    this.getResults();
                },
                deep: true
            }
        },
        computed: mapGetters(["allville", "allcategory"]),
        mounted() {
            this.getResults();
        },
        created() {
            this.getville();
            this.getcategory();
        }
    }

</script>
<style scoped>
    /**/

    .col-md-3.annonce {
        height: 350px;

    }

    .card {
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 20px rgba(25, 29, 50, 0.23);
        transition: all 0.3s linear;
        height: 100%;
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

</style>
