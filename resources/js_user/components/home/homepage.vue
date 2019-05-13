<template>
    <div class="bg-image">
        <div class="overlay"></div>
        <slider></slider>
        <sectionone></sectionone>
    </div>
</template>
<script type="text/javascript">
    import slider from './slider.vue';
    import sectionone from './sectionone.vue';
    export default {
        components: {
            slider,
            sectionone
        }
    }

</script>

<style lang="scss">
    .bg-image {
        background-image: url('../annonce/imagedoodle.jpg');
        position: relative;
        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(14, 160, 159, 0.5)
        }
    }

</style>
