<template>
    <div class="container px-0">
        <div class="card rounded-0 gallery position-relative">
            <div class="carousel slide">
                <a href="#" @click.prevent="incriment" class="carousel-control-next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="sr-only">Next</span>
                </a>
                <a href="#" @click.prevent="decriment" class="carousel-control-prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="sr-only">Prev</span>
                </a>
                <transition name="fadein">
                    <img v-show="visible" class="card-img-top rounded-0" :src="imgone(bigImage.src)" alt>
                </transition>
            </div>
            <div class="row card-body pt-sm-2 pb-sm-2 pt-1 pb-1 thm">
                <div @click="clicked(index)" v-for="(image, index) in images" :key="index" class="col px-1"
                    :class="image.className">
                    <img class="img-fluid" :src="imgone(image.src)" alt>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    /* eslint-disable */
    import Vue from 'vue'
    Vue.directive('visible', {
        bind: (el, binding, vnode) => {
            el.style.visibility = (binding.value) ? 'visible' : 'hidden'
        }
    })

    export default {
        props: {
            images: {
                type: Array,
                required: true
            }
        },
        render(createElemnt) {
            
        },
        data() {
            return {
                // the images data
                visible: true,
                // the big image
                thmImages: {},
                bigImage: {},
                sizing: {
                    width: "100", // 100%
                    marginBetween: "0.5" // margin between images
                },
                indexSelected: 0 // the curent images selected
            }
        },
        methods: {
            initGalery() {
                // Set the image with the current index in bigImage 
                this.bigImage = this.images[this.indexSelected];
                // Set Active class
                this.images[this.indexSelected].className = "selected";
                setTimeout(() => {
                    this.visible = true;
                }, 500)

            },
            resetClass() {
                //reset the class to the defult value
                this.images[this.indexSelected].className = "";
            },
            hide() {
                this.visible = false;
            },
            clicked(index) {
                //reset the perview image
                this.hide();
                this.resetClass();
                //set the clicked image to selected
                this.indexSelected = index;
                //Init the glery
                this.initGalery();
            },
            incriment() {
                //reset the perview image
                this.hide();
                this.resetClass();
                if (this.indexSelected >= this.images.length - 1)
                    // check if this index is not the last one
                    this.indexSelected = 0;
                // Set the selected image to the first one
                else this.indexSelected++; // incriment
                //Init the glery
                this.initGalery();
            },
            decriment() {
                // reset the perview image
                this.hide();
                this.resetClass();
                if (this.indexSelected <= 0)
                    // check if this index is not the first one
                    this.indexSelected = this.images.length - 1;
                // Set the selected image to the last one
                else this.indexSelected--; // Decriment
                // Init the glery
                this.initGalery();
            },
            imgone(imageName) {
                return '/image/annonce/' + imageName
            }
        },
        mounted() {
            this.initGalery(); // Init the glery
            this.thmImages = this.images
        }
    }

</script>
<style scoped>
    #content-slider {
        line-height: 1;
        font-family: "Montserrat", Helvetica, Arial, sans-serif;
        font-size: 10px;
        /* font-size 1em = 10px = 62.5%*/

        /*background: #4e616d;*/
    }


    /* --------------------------------> Responsive images (ensure images don't scale beyond their parents) */
    #content-slider img {
        max-width: 100%;
        width: auto\9;
        height: auto;
        vertical-align: middle;
        border: 0;
        -ms-interpolation-mode: bicubic;
    }

    input#a-1:checked~#control>label:nth-child(2),
    input#a-2:checked~#control>label:nth-child(3),
    input#a-3:checked~#control>label:nth-child(4),
    input#a-4:checked~#control>label:nth-child(1) {
        background: url(https://github.com/lime7/slider/blob/master/images/right.png?raw=true) no-repeat;
        float: right;
        right: 0.3%;
    }

    input#a-1:checked~#control>label:nth-child(4),
    input#a-2:checked~#control>label:nth-child(1),
    input#a-3:checked~#control>label:nth-child(2),
    input#a-4:checked~#control>label:nth-child(3) {
        background: url(https://github.com/lime7/slider/blob/master/images/left.png?raw=true) no-repeat;
        float: left;
        left: 0.3%;
    }

    .gallery .thm img {
        opacity: 0.7;
        border: 2px solid #333;
    }

    .gallery .thm img:hover {
        opacity: 0.9;
    }

    .gallery .thm .selected img {
        opacity: 1;
        border-color: #327798;
    }

    .fadein-enter-active,
    .fadein-leave-active {
        transition: opacity 0.5s, visibility 1s;
    }

    .fadein-enter,
    .fadein-leave-active {
        opacity: 0;
    }

</style>
