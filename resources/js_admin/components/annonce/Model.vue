
<template>
    	
	<!-- Start Model -->
	<div class="container">
        <div class="row justify-content-end">
            <button class="btn btn-primary" v-on:click="backToAllAnnonce()" role="button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </button>
    </div>
        <form @submit.prevent="addAnnonce" @keydown="form.onKeydown($event)">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Coisire la Ville</label>
                    <select v-model="form.ville_id" name="ville_id" class="form-control">
                        <option disabled selected value="-1">Ville</option>
                        <option v-for="ville in villes" :key="ville.id" :value="ville.id">{{ ville.name }}</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label class="label-control" for="">Coisire la Category</label>
                    <select v-model="form.categorie_id" name="categorie_id" class="form-control">
                        <option disabled selected value="-1">Category</option>
                        <option v-for="category in categorys" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label class="label-control" for="">Title</label>
                    <input v-model="form.title" type="text" name="title" class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <label class="label-control" for="">Desciption</label>
                    <textarea v-model="form.description" name="desciption" class="form-control"></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label class="label-control" for="">détaille</label>
                    <input v-model="form.detaille" type="text" name="detaille" class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <label for="">Type</label>
                    <div class="row">
                        <div class="col-md-1 form-group">
                            <input v-model="form.type" value="free" type="radio" name="type" id="type_free">
                            <label for="type_free">Free</label>
                        </div>
                        <div class="col-md-1 form-group">
                            <input type="radio" v-model="form.type" value="pay" name="type" id="type_pay">
                            <label for="type_pay">Pay</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label>Stuts</label>
                    <select v-model="form.stuts" name="stuts" class="form-control">
                        <option value="published" selected>published</option>
                        <option value="pandding">pandding</option>
                        <option value="blocked">blocked</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label>Prix</label>
                    <input v-model="form.prix" type="text" name="prix" class="form-control">
                </div>
            
                <div class="col-md-12 from-group">
                    <label>AJOUTEZ JUSQU'À 6 PHOTOS ({{ imageRest }} IMAGES RESTANTES)</label>
                    <div class="row">
                        <draggable v-model="form.images" class="row col-md-12 gallery-item">
                            <div v-for="(image, index) in form.images" :key="index" class="col-md-3 position-relative newbtn">
                                <button @click="remove(image, index)" type="button" class="btn position-absolute"><i class="fa fa-times" aria-hidden="true"></i></button>
                                <img class="image-responsive" :src="image.img" alt="">
                            </div>
                        </draggable>
                        <div class="col-md-12 mb-4" v-if="!imageEnd">
                            <label for="images" class='newbtn'>
                                <img src="http://placehold.it/120x120" >
                                <input @change="pushFile" id="images" class="pic" type="file" >
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 d-flex justify-content-center">
                            <i class="fa fa-camera fa-3x mr-2"></i>
                        </div>
                        <div class="col-md-10">
                            <p class="mt-20 text-center text-md-left"> Savez vous que les annonces avec photos sont 10 fois plus consultés que celles qui n'en ont pas !</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="add new"/>
            </div>
        </form>
	</div>
	<!-- End Model -->
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        data() {
            return {
                villes:{},
                categorys:{},
                form: new Form({
                    user_id:0,
                    ville_id:-1,
                    categorie_id:-1,
                    title:'',
                    description:'',
                    detaille:'',
                    type:'',
                    stuts:'',
                    prix:'',
                    images: []
                }),
                imageEnd: false,
                imageRest: 6
            }
        },
        methods: {
            getVilles () {
                axios.get('ville/all').then(({ data }) => this.villes = data.data)
            },
            getCategories () {
                axios.get('Categorie/all').then(({ data }) => this.categorys = data.data)
            },
            backToAllAnnonce () {
               this.$router.push('/admin/annonce')
            },
            addAnnonce () {
                this.$Progress.start()
                if(this.form.images[0] !== undefined)
                    this.form.images[0].isMain = 1;
                this.form.post('Annonce/add',{ 
                // Transform form data to FormData
                transformRequest: [function (data, headers) {
                    return objectToFormData(data)
                }],
                }).then(({ data }) => {
                    console.log('DATA : ', data)
                    this.$Progress.finish()
                }).catch(() => {
                    this.$Progress.fail()
                })
                console.log(this.form.images)
            },
            pushFile (e) {
                console.log('Image Rest Before', this.imageRest)

                if (e.target.files.length > 0) {
                    if(this.form.images.length < 6) {
                        let file = e.target.files[0]
                        let reader = new FileReader()
                        reader.onloadend = () => {

                            this.form.images.push({ img:reader.result, isMain: 0 })
                            this.imageRest--
                        }
                        console.log('It\'s working...', e.target.value)
                        reader.readAsDataURL(file)
                    }
                }

                if (this.imageRest == 1) {

                    console.log('Before ',this.imageEnd)
                    this.imageEnd = true
                    console.log('After ',this.imageEnd)


                }

                console.log('Image Rest After', this.imageRest)

                e.target.value = ''
                console.log('It\'s not working...',e.target.value)


            },
            remove (img, i) {
                this.form.images.splice(i, 1)
                this.imageRest++
                if(this.imageEnd) {
                    this.imageEnd = false
                }
            }
        },
        updated() {
            console.log(this.form.images)
        },
        created() {
            this.getVilles();
            this.getCategories();
        }
    }
</script>

<style type="text/css">
    
/** Start Custom Input File */

    .pic{
        display: none;
    }
        
    .newbtn{
        cursor: pointer;
        max-height: 130px;
        max-width: 130px;
        overflow: hidden;
    }

    .newbtn button[type='button'] {
        right:20px;
        top:0
    }

    .newbtn img {
        max-width: 100%;
    }


/** End Custom Input File */
</style>
