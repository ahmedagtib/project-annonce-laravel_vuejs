<template>
    <div class="upper_bar">
        <div class="container">
            <div class="row">
                <div class="col-sm mt-1">
                    <span><i class="fas fa-envelope"></i> smartove@gmail.com,</span>
                    <span><i class="fa fa-phone"></i> 0600000000</span>
                </div>
                <ul class="nav">
                    <div class="col-sm text-right">
                        <ul class="list-inline">
                            <template v-if="!currentUser">
                                <li class="list-inline-item">
                                    <router-link class="nav-link" to="/annonce">Créez votre annonce</router-link>
                                </li>
                                <li class="list-inline-item">
                                    <router-link to="/login">s'identifier</router-link>
                                </li>
                                <li class="list-inline-item">
                                    <router-link to="/register">registre</router-link>
                                </li>
                            </template>
                            <template v-else>
                                <li class="list-inline-item">
                                    <router-link class="nav-link" to="/annonce">Créez une annonce</router-link>
                                </li>
                                <li class="list-inline-item">
                                    <router-link class="nav-link" to="/mystore">Mes annonces</router-link>
                                </li>
                                <li class="list-inline-item dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{currentUser.name}}<span class="sr-only"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <router-link class="dropdown-item" to="/myprofil">Profil</router-link>
                                        <router-link class="dropdown-item" to="/edituser">Modifier</router-link>
                                        <div class="dropdown-divider"></div>
                                        <a class="nav-link" href="#" @click.prevent="logout">Déconnexion</a>
                                        <a class="nav-link" href="#">
                                            <label for="mode">Mode de nuit </label>
                                            <button @click="setDarkMode" class="btn btn-dark">Nuit</button>
                                            <button @click="setLightMode" class="btn btn-light">Default</button>
                                        </a>
                                    </div>
                                </li>

                            </template>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isDark: false
            }
        },
        methods: {
            logout: function () {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            changeMode() {
                // if(this.isDark) {
                //     document.body.className = 'dark'
                //     this.$store.commit('setDarkMode')
                // }else
                //     document.body.className = ''
                 
                 

                console.log('Store', this.$store.getters.getMode)
            },
            darkMode() {

                console.log('if', document.body.className, 'store', this.$store.getters.getMode)
                if(this.$store.getters.getMode == 'dark') {

                    document.body.className = this.$store.getters.getMode
                    console.log('if', document.body.className, 'store', this.$store.getters.getMode)
                    this.$store.commit('setDarkMode')

                } else {

                    document.body.className = ''
                    this.$store.commit('setWhiteMode')
                    console.log('Else', document.body.className)

                }

            },

            setMode() {
                document.body.className = this.$store.getters.getMode
            },
            setDarkMode(e) {
                e.preventDefault()
                this.$store.commit('setDarkMode')
                this.setMode()
            },
            setLightMode(e) {
                e.preventDefault()
                this.$store.commit('setWhiteMode')
                this.setMode()
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
        },
        mounted() {
            this.setMode()
        }
    }

</script>
<style type="text/css">
</style>
