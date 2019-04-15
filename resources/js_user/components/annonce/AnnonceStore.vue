<template>
    <div class="container">
        <div class="row mx-auto mb-4">
            <div class="col-md-6">
                <select v-model="filters.categorie_id" class="custom-select mb-2">
                    <option disabled selected :value="-1">category</option>
                    <option v-for="cat in allcategory" :key="cat.id" :value="cat.id">{{cat.name}}</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="custom-select" v-model="filters.ville_id">
                    <option disabled selected value="-1">ville</option>
                    <option v-for="ville in allville" :key="ville.id" :value="ville.id">{{ville.name}}</option>
                </select>
            </div>
        </div>
        <card></card>
        <pagination :limit="3" :data="annonces" @pagination-change-page="getResults"></pagination>
    </div>
</template>
<script type="text/javascript">
    import card from './AnnonceCard.vue'
    import {
        mapGetters,
        mapActions
    } from "vuex";
    export default {
        components: {
            card
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

            }
        },
        methods: {
            ...mapActions(['getville', 'getcategory']),
            getResults(page = 1) {
                axios({
                    method: 'post',
                    url: 'api/all?page=' + page,///
                    data: this.filters
                  })
                    .then((response) => {
                        this.annonces = response.data
                        console.log('fdsf', response)
                    });
            }
        },
        watch: {

            filters: {
              handler (val, oldVal) {

                this.getResults()

              },
              deep:true
            }

        },
        computed: mapGetters(['allville', 'allcategory']),
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

</style>
