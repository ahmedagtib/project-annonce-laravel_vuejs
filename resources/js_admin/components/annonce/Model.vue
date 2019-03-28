
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
                    <label class="label-control" for="">Slug</label>
                    <input v-model="form.slug" type="text" name="slug" class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <label class="label-control" for="">Title</label>
                    <input v-model="form.title" type="text" name="title" class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <label class="label-control" for="">Desciption</label>
                    <textarea v-model="form.desciption" name="desciption" class="form-control"></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label class="label-control" for="">détaille</label>
                    <input v-model="form.detaille" type="text" name="detaille" class="form-control">
                </div>
                <div class="row col-md-12 form-group">
                    <label for="">Type</label>
                    <div class="col-md-1 form-group">
                        <input v-model="form.type" value="free" type="radio" name="type" id="type_free">
                        <label for="type_free">Free</label>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="radio" v-model="form.type" value="pay" name="type" id="type_pay">
                        <label for="type_pay">Pay</label>
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
                    <input type="text" name="prix" class="form-control">
                </div>
            
                <div class="col-md-12 from-group">
                    <label>AJOUTEZ JUSQU'À 6 PHOTOS (6 IMAGES RESTANTES)</label>
                    <div class="row">
                        <div v-for="(image, index) in form.images" :key="index" class="col-md-3 position-relative newbtn">
                            <button @click="remove(image, index)" type="button" class="btn position-absolute"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <img :src="image" alt="">
                        </div>
                        <div class="col-3 mb-4" v-if="!imageEnd">
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
    export default {
        data() {
            return {
                villes:{},
                categorys:{},
                form: new Form({
                    ville_id:-1,
                    categorie_id:-1,
                    slug:'',
                    title:'',
                    desciption:'',
                    detaille:'',
                    type:'',
                    stuts:'',
                    prix:'',
                    images: []
                }),
                imageEnd: false
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
                this.form.post('Annonce/add',{ 
                // Transform form data to FormData
                transformRequest: [function (data, headers) {
                    return objectToFormData(data)
                }],
                }).then(({ data }) => console.log('DATA : ', data))
                console.log(this.form.images)
            },
            pushFile (e) {
                if(e.target.files.length > 0) {
                    if(this.form.images.length < 6) {
                        let file = e.target.files[0]
                        let reader = new FileReader()
                        reader.onloadend = () => {

                            this.form.images.push(reader.result)

                        }
                        console.log('It\'s working...', e.target.value)
                        reader.readAsDataURL(file)
                    } else {

                        console.log('It\'s not working...',this.form.images)
                        this.imageEnd = true

                    }
                }

                e.target.value = ''
                console.log('It\'s not working...',e.target.value)


            },
            remove (img, i) {
                this.form.images.splice(i, 1)
               // console.log('fdsqf',this.form.images)
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
