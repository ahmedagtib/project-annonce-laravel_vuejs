<template>
    <div class="container">
        <vue-progress-bar></vue-progress-bar>
        <div class="row">
            <div class="col-md-6">
                <svgreg></svgreg>
            </div>
            <div class="col-md-6">
                <div class="row justify-content-center mb-4">
                    <div class="reg fadeInDown">
                        <div id="formContent">
                            <div class="fadeIn first">
                                <img src="" id="icon" alt="vap logo" />
                                <h1>Registre</h1>
                            </div>
                            <form @submit.prevent="register">
                                <input type="text" class="fadeIn second" v-model="formRegister.name"
                                    placeholder="Nom" />
                                </br>
                                <span class="text-danger" v-if="valdation.name !=''">
                                    <span v-for="val in valdation.name">
                                        {{val}}</br>
                                    </span>
                                </span>
                                <input type="text" class="fadeIn second" v-model="formRegister.email"
                                    placeholder="email" />
                                </br>
                                <span class="text-danger" v-if="valdation.email !=''">
                                    <span v-for="val in valdation.email">
                                        {{val}}</br>
                                    </span>
                                </span>
                                <input type="password" class="fadeIn second" v-model="formRegister.password"
                                    placeholder="Mot de passe" />

                                <input type="password" class="fadeIn third" placeholder="confirmer le mot de passe"
                                    v-model="passwordc" /></br>
                                <span class="text-danger" v-if="confirmation != ''">
                                    {{confirmation}}
                                </span>
                                </br>
                                <span class="text-danger" v-if="valdation.password !=''">
                                    <span v-for="val in valdation.password">
                                        {{val}}</br>
                                    </span>
                                </span>


                                <input type="submit" class="fadeIn fourth" value="S'inscrire" />
                            </form>
                            <div id="formFooter">
                                <a class="underlineHover" href="#">Accueil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import {
        registerUser
    } from '../../helpers/auth';
    import svgreg from './svgreg';
    export default {
        components: {
            svgreg
        },
        data() {
            return {
                formRegister: {
                    name: '',
                    email: '',
                    password: ''
                },
                passwordc: '',
                confirmation: '',
                error: null,
                valdation: {
                    name: '',
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            register() {
                const pass1 = this.formRegister.password;
                const pass2 = this.passwordc;
                if (pass1 != pass2) {
                    this.confirmation = "le champe des password invalid";

                } else {

                    this.$Progress.start()
                    registerUser(this.$data.formRegister)
                        .then((res) => {
                            //console.log(res.val);
                            if (res.state == "error") {
                                this.valdation = res.val;

                                this.$Progress.fail()
                            } else {
                                this.$store.commit("registerSuccess", res);
                                this.$router.push({
                                    path: '/login'
                                });
                
                                this.$Progress.finish()
                            }
                        })
                        .catch((error) => {
                            this.$store.commit("registerFailed", {
                                error
                            });
                            this.$Progress.fail()
                        })
                }
            }

        },
        computed: {
            regError() {
                return this.$store.getters.regError;
            }
        },


    }

</script>

<style scoped>
    .error {
        text-align: center;
        color: red;
    }

</style>
