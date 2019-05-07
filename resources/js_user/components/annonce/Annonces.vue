<template>
    <div class="content_wrapper">
        <div class="container">

            <vue-progress-bar></vue-progress-bar>
            <div class="row pv-30">
                <div class="col-md-4 mb-3">
                    <div class="row listing">

                        <div class="sidebar shadow sticky-top">
                            <div class="counting-result mb-20">
                                <span class="counthotel">{{ countResult }}</span> resultats Trouvé.
                            </div>
                            <div class="search-filter">
                                <div class="search-tabs-content">
                                    <form @submit.prevent="Search" role="form" class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="searchHotelWhere">Que recherchez-vous ?</label>
                                                <input type="text" class="form-control" id="searchHotelWhere"
                                                    placeholder="Que recherchez-vous ?">
                                            </div>
                                            <div class="form-group">
                                                <label for="searchHotelWhere">Choisissez une catégorie :</label>
                                                <select v-model="filters.categorie_id" class="form-control"
                                                    id="categorie">
                                                    <option value="-1">Toutes les catégories</option>
                                                    <option v-for="cat in allcategory" :key="cat.id" :value="cat.id">
                                                        {{cat.name}}</option>

                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="searchHotelWhere">Dans quelle ville ?</label>
                                                <select v-model="filters.ville_id" class="form-control mySelectBoxClass"
                                                    id="searchCruisesDestinatiom">
                                                    <option value="-1">Tous les villes</option>
                                                    <option v-for="ville in allville" :key="ville.id" :value="ville.id">
                                                        {{ville.name}}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row mb-10">
                                                <div class="col-3">
                                                    <h4>Prix min</h4>
                                                </div>
                                                <div class="col-9">
                                                    <input v-model="filters.min_prix" type="text"
                                                        class="form-control mySelectBoxClass" />
                                                </div>
                                            </div>
                                            <div class="row mb-10">
                                                <div class="col-3">
                                                    <h4>Prix max</h4>
                                                </div>
                                                <div class="col-9">
                                                    <input v-model="filters.max_prix" type="text"
                                                        class="form-control mySelectBoxClass" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="clear"></div>
                                            <button type="submit" class="btn btn-primary btn-block">Rechercher</button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="sort-by-wrapper mb-20">
                        <div class="row">
                            <div class="col-10 p-0">
                                <div class="sort-by">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                       <!--

                                           Some kind of sort


                                       -->
                                    </ul>
                                </div>
                            </div>
                            <div class="col-2 p-0">
                                <ul class="sort-nav list-inline float-right mb-0">
                                    <li class="list-inline-item" title="Grid"><a href="#"><i
                                                class="fa fa-th-large"></i></a></li>
                                    <li class="list-inline-item" title="List"><a href="#"><i
                                                class="fa fa-th-list"></i></a></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <div class="row listing">
                        <Annonce v-for="annonce in annonces.data" :key="annonce.id" :data="annonce"></Annonce>
                    </div>
                    <pagination :limit="3" :data="annonces" @pagination-change-page="getResults"></pagination>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Annonce from '../Annonce'
    import pagination from 'laravel-vue-pagination'
    import $ from 'jquery'
    import {
        mapGetters,
        mapActions
    } from "vuex";
    export default {
        components: {
            Annonce
        },
        data() {
            return {
                annonces: {},
                filters: {
                    ville_id: -1,
                    categorie_id: -1,
                    min_prix: 0,
                    max_prix: 0
                },
                countResult: 4134
            }
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

                this.$Progress.start()
                axios({
                    method: "post",
                    url: "api/all?page=" + page, ///
                    data: this.filters
                }).then(response => {
                    this.annonces = response.data;
                    this.$Progress.finish()
                }).catch(() => {
                    this.$Progress.fail()
                });
            },
            Search() {
                this.getResults()
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
    $(function () {
        'use strict';
        var upperH = $('.top-header').innerHeight();

        $('.collapse').on('hidden.bs.collapse', function () {

            $(this).parent().find('.fa-minus').addClass('fa-plus').removeClass('fa-minus');

        });

        $('.collapse').on('shown.bs.collapse', function () {

            $(this).parent().find('.fa-plus').addClass('fa-minus').removeClass('fa-plus');

        });


    });

</script>
<style lang="scss" scoped>
    @import 'annoncesStore';
</style>
