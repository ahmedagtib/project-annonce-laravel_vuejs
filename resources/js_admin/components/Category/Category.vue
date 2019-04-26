<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <alert-success :form="form">category created Done</alert-success>
                <div class="col-md-12">
                    <div class="card card-light">
                        <div class="card-header">
                            Gérer les catégories
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#exampleModal">
                                Ajouter une Catégorie
                            </button>
                        </div>
                        <div class="card-body pd-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Création</th>
                                        <th scope="col">action</th>
                                    </tr>
                                    <tr v-for="cat in categories">
                                        <td scope="row">{{cat.id}}</td>
                                        <td>{{cat.name}}</td>
                                        <td>{{cat.created_at}}</td>
                                        <td>
                                            <router-link :to="'/admin/categorie/edit/'+cat.id" class="btn btn-warning">
                                                <i class="fa fa-edit"></i></router-link>
                                            <a @click="onDelete(cat.id,cat.name)" class="btn btn-danger"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <form @submit.prevent="createcategories">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="  exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une Catégorie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nom</label>
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" class="btn btn-primary" value="Ajouter" />
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>
<script type="text/javascript">
    export default {
        data() {
            return {
                form: new Form({
                    name: '',
                }),
                categories: {}
            }
        },
        methods: {
            createcategories: function () {
                this.form.post('/admin/Categorie/all').then((response) => {
                    this.getcategories();
                }).catch((err) => {

                });
            },
            getcategories: function () {
                axios.get('/admin/Categorie/all').then((response) => {
                    this.categories = response.data.data;
                }).catch((err) => {

                });
            },
            onDelete: function (id, name) {
                if (confirm('do you want delete ' + name)) {
                    axios.delete('/admin/Categorie/delete/' + id).then((response) => {
                        this.getcategories();
                    }).
                    catch((err) => {

                    })
                }
            }
        },
        created() {
            this.getcategories();
        }
    }

</script>
<style type="text/css">

</style>
