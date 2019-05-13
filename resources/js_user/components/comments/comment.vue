<template>

    <div class="row media">
        <div class="col-md-2">
            <img :src="imgPath(comment.userprofiale.image)" class="mr-3 img-fluid" alt="">
        </div>
        <div class="media-body">
            <h5 class="mt-0">{{comment.comments.user.name}}</h5>
            {{comment.comments.body}}
        </div>
    </div>

</template>
<script type="text/javascript">
    export default {
        props: ['comment'],
        data() {
            return {

            }
        },
        methods: {
            imgPath(imgName) {
                return '/image/users/' + imgName
            }
        },
        mounted() {
            console.log('Commnet', this.comment)
        }
    }

</script>
<style scoped>

</style>
