<template>



    <div class="col-12 ph-5">
        <div class="list-group shadow mb-10">
            <div class="list-group-item list-group-item-action ">
                <router-link :to="'/annonce/' + data.slug">
                    <div class="list-img">
                        <img v-if="data.images[0] !== undefined" :src="imageDirectory(data.images[0].name)"
                            alt="Card image cap">
                        <i class="fa fa-clone cp-i"></i>
                        <span class="cp-img">2</span>

                        <div class="image-overlay">
                            <div class="overlay-content">
                                <div class="overlay-icon"><i class="fa fa-camera"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-content">
                        <h4 class="list-item-title">{{ data.title.substr(0,20) }}</h4>
                        <span class="list-item-date text-muted"></span>
                        <p class="list-item-desc mv-10 text-muted"></p>
                    </div>
                </router-link>

                <div class="list-detail bl">
                    <i class="fa fa-bookmark-o" title="save"></i>
                    <span class="list-item-view">267 <i class="fa fa-eye"></i></span>
                    <span class="list-item-price">{{  }}<span>DH</span></span>
                    <i class="fa fa-briefcase" title="Professionnel"></i>
                    <i class="fa fa-university" title="Boutique"></i>
                </div>
            </div>
        </div>
    </div>



</template>

<script>
    export default {
        data() {
            return {
                annonce: {}
            }
        },
        props: {
            data: Object
        },
        methods: {

            imageDirectory(name) {

                return '/image/annonce/' + name

            },
        },
        mounted() {
            console.log('Data', this.data)
        }
    }

</script>

<style lang="sass" scoped>
    @import './annonce/annoncesStore'
</style>
