<template>
    <div class="addannonce_free">

        <vue-progress-bar></vue-progress-bar>
        <div class="card_annonce">
            <h1 class="card__title">Ajouter une annonce</h1>
            <p class="card__description">salut monsieur rendre vos annonces plus importantes par clicker<a href="#">ici</a>
                <p>
                    <form @submit="onsubmit">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">title</label>
                                <input type="text" v-model="annonce.title" class="form-control" id="title"
                                    placeholder="title">
                                <span class="text-danger" v-if="valdation.title !=''">
                                    <span v-for="(val, index) in valdation.title" :key="index">
                                        {{val}}<br />
                                    </span>
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="prix">prix</label>
                                <input type="text" v-model="annonce.prix" class="form-control" id="prix"
                                    placeholder="prix">
                                <span class="text-danger" v-if="valdation.prix !=''">
                                    <span v-for="(val, index) in valdation.prix" :key="index">
                                        {{val}}<br />
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category">category</label>
                                <select class="custom-select" v-model="annonce.categorie_id">
                                    <option disabled selected value="-1">category</option>
                                    <option v-for="cat in allcategory" :key="cat.id" :value="cat.id">{{cat.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ville">ville</label>
                                <select class="custom-select" v-model="annonce.ville_id">
                                    <option disabled selected value="-1">ville</option>
                                    <option v-for="ville in allville" :key="ville.id" :value="ville.id">{{ville.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="detialle">detialle</label>
                                <textarea id="detialle" v-model="annonce.detialle" class="form-control"></textarea>
                                <span class="text-danger" v-if="valdation.detialle !=''">
                                    <span v-for="(val, index) in valdation.detialle" :key="index">
                                        {{val}}<br />
                                    </span>
                                </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">description</label>
                                <textarea id="description" v-model="annonce.description"
                                    class="form-control"></textarea>
                                <span class="text-danger" v-if="valdation.description !=''">
                                    <span v-for="(val, index) in valdation.description" :key="index">
                                        {{val}}<br />
                                    </span>
                                </span>
                            </div>
                            <div class="form-group">
                                <draggable v-model="annonce.images" class="row col-md-12 gallery-item">
                                    <div v-for="(image, index) in annonce.images" :key="index"
                                        class="col-md-4 position-relative newbtn">
                                        <button @click="remove(image, index)" type="button"
                                            class="btn position-absolute"><i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                        <img class="image-responsive" :src="image.img" alt="" width="100" height="100">
                                    </div>
                                </draggable>
                                <div class="col-md-12 mb-4" v-if="!imageEnd">
                                    <label for="images" class='newbtn'>
                                        <img src="http://placehold.it/120x120">
                                        <input @change="pushFile" id="images" class="pic" type="file">
                                        <br>
                                        <span class="text-danger" v-if="valdation.images !=''">
                                            <span v-for="(val, index) in valdation.images" :key="index">
                                                {{val}}<br />
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">

                            </div>
                            <input type="submit" name="" class="btn btn-primary btn-block">
                        </div>

                    </form>
        </div>
    </div>


</template>

<script type="text/javascript">
    import draggable from 'vuedraggable';
    import {
        addfreeads
    } from '../../helpers/auth';
    import {
        mapGetters,
        mapActions
    } from "vuex";
    export default {
        components: {
            draggable
        },
        data() {
            return {
                annonce: {
                    user_id: '',
                    ville_id: -1,
                    categorie_id: -1,
                    title: '',
                    detialle: '',
                    description: '',
                    prix: '',
                    images: []
                },
                valdation: [],
                v_ville: '',
                v_cat: '',
                imageEnd: false,
                imageRest: 6
            }
        },
        methods: {
            ...mapActions(['getville', 'getcategory']),
            onsubmit(e) {
                e.preventDefault();
                if (this.annonce.images.length != '') {
                    this.annonce.images[0].isMain = 1;
                }

                this.$Progress.start()
                addfreeads(this.$data.annonce).then((res) => {
                        if (res.state == 'error') {
                            this.valdation = res.val;
                            console.log(res);
                        }

                        this.$Progress.finish()
                    })
                    .catch((err) => {
                        this.$Progress.fail()
                    })
            },
            pushFile(e) {
                if (e.target.files.length > 0) {
                    if (this.annonce.images.length < 6) {
                        let file = e.target.files[0]
                        let reader = new FileReader()
                        reader.onloadend = () => {

                            this.annonce.images.push({
                                img: reader.result,
                                isMain: 0
                            })
                            this.imageRest--
                        }
                        console.log('It\'s working...', e.target.value)
                        reader.readAsDataURL(file)
                    }
                }


                if (this.imageRest == 1) {

                    console.log('Before ', this.imageEnd)
                    this.imageEnd = true
                    console.log('After ', this.imageEnd)


                }

                e.target.value = ''
                console.log('It\'s not working...', e.target.value)

            },
            remove(img, i) {
                this.annonce.images.splice(i, 1)
                this.imageRest++
            }
        },
        computed: mapGetters(['allville', 'allcategory']),
        created() {
            this.getville();
            this.getcategory();
        },
        mounted() {
            this.annonce.user_id = this.$store.getters.currentUser.id;
        }
    }

</script>
<style scoped>
    .addannonce_free {
        width: 100%;
        height: 100%;
        background: linear-gradient(to top right, #2C3E50, rgba(222, 185, 224, 0), rgba(44, 62, 80, 0));
        padding-bottom: 2%;
    }



    .card_annonce {
        width: 60%;
        margin: 2% auto;
        margin-bottom: 0px;
        padding: 2% 5%;
        border-radius: 10px;
        box-shadow: 2px 2px 6px rgba(0, 0, 0, .4);
        background-color: #ffffff;
        font-family: sans-serif;
        opacity: 0.8;

    }

    .card__title {
        text-align: center;
    }

    .card__description {
        text-align: center;
    }

    .addannonce_free .btn-primary {
        background-color: #324455;
        border-color: #2c3e50;
    }

</style>
