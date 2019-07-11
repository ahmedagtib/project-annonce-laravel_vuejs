<template>
  <div>
    <form @submit.prevent="search" class="form-inline justify-content-center">
      <div class="form-group">
        <input v-model="filters.query" type="search" class="form-control input-custom" placeholder="Rechércher" aria-describedby="helpId">
        <button class="btn btn-primary ml-sm-2 mt-2 mt-sm-0 btn-custom" type="sublit">Rechercher</button>
      </div>
    </form>
  </div>
</template>

<script>
  import Search from '../Models/Search';
  import { bus } from '../app';
  export default {
    data() {
      return {
        filters: {
          query: '',
          ville_id: -1,
          categorie_id: -1,
          min_prix: 0,
          max_prix: 0
        }
      }
    },
    methods: {

      search() {
        // Init the search object
        bus.search = new Search(this.filters);

        // Load the route result
        this.$router.push('/store');

      }

    },
    created() {

    } 
  }
</script>

<style lang="scss">
  .input-custom{
    border-radius: 0;
    &:focus {
      box-shadow: 0 0 0 0.2rem #14002848;
    }
  }
</style>
