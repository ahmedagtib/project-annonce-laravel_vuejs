<template>
    <div class="container">

        <vue-progress-bar></vue-progress-bar>
        <div class="row">
            <div class="col-md-6">
                <div class="login">
                    <div class="wrapper fadeInDown">
                        <div id="formContent">
                            <div class="fadeIn first">
                                <img src="" id="icon" alt="vap logo" />
                                <h1>welcome</h1>
                                <div class="text-danger text-center" v-if="authError">
                                    {{authError}}
                                </div>
                            </div>
                            <form @submit.prevent="auth">
                                <input type="text" id="login" class="fadeIn second" v-model="form.email"
                                    placeholder="username">
                                <input type="password" id="password" class="fadeIn third" v-model="form.password"
                                    placeholder="password">
                                <input type="submit" class="fadeIn fourth" value="Log In">
                            </form>
                            <div id="formFooter">
                                <a class="underlineHover" href="#">Go to the Site</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <svgauth></svgauth>
            </div>
        </div>
    </div>
</template>
<script>
    import {
        login
    } from '../../helpers/auth';
    import router from '../../routes.js';
    import svgauth from './svgauth.vue'
    export default {
        name: "login",
        components: {
            svgauth
        },
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            }
        },
        methods: {
            auth: function () {
                this.$store.dispatch('login');
                this.$Progress.start()
                login(this.$data.form)
                    .then((res) => {
                        //console.log("log");
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({
                            path: '/'
												});
												this.$Progress.finish()
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {
                            error
												});
												this.$Progress.fail()
                        //console.log("nop");
                    })

            }
        },
        computed: {
            authError() {
                return this.$store.getters.autherror;
            }
        }
    }

</script>
<style scoped>

</style>
