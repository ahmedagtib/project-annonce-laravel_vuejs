<template>

    <div class="container-fluid bg-image">
        <div class="container">
            <div class="body wrapper fadeInDown">
                <h1 class="heading text-center">VAP</h1>
                <h2 class="heading text-center">Bla bla bla</h2>
                <router-link to="/annonce" class="btn btn-primary p-3 btn-custom"
                    href="#" role="button">
                    Crée votre annonce gratuit.
                </router-link>
            </div>
        </div>
    </div>

</template>

<script>
    import $ from 'jquery';

    export default {
        methods: {

            imgone(imageName) {
                return '/image/slider/' + imageName
            }

        }
    }
    // let text;
    // $(function () {

    //   let desc = $('.main .description');

    //   text = desc.text();

    //   desc.text('');

    //   let txt = '';
    //   let i = 0;
    //   // setInterval(function () {
    //   //   txt += text[i];
    //   //   desc.text(txt);
    //   //   i++;
    //   //     console.log('Stop it?!!');
    //   //     clearInterval(100);
    //   // }, 100);

    //   // clearInterval();




    // });

</script>

<style lang="scss">
    body {
        font-family: 'Baloo', cursive;
    }

    .bg-image {

        min-height: 532px;

        /* background-color: #FFF; */
        background-image: url('images/home2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        z-index: 9999;
        text-align: center;

        .overlay {
            left: 0;
            background-color: rgba(127, 127, 127, 0.53) !important;           
            z-index: -1;
        }

        .body {
            padding-top: 80px;
        }

        .heading {
            font-size: 80px;
        }
    }

    .btn-custom {

        background: #140028 !important;
        border-color: #140028;
        border-radius: 0;
        display: inline-block;

    }

    .btn-custom:hover {

        border-color: #190130;

    }

</style>
