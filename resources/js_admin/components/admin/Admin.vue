<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-light">
                        <div class="card-header">
                            Gérer les administrators
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#exampleModal">
                                Ajouter un admine
                            </button>
                        </div>
                        <div class="card-body pd-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Création</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    <tr v-for="(admin, index) in admins.data" :key="index">
                                        <td scope="row">{{admin.id}}</td>
                                        <td>{{admin.name}}</td>
                                        <td>{{admin.email}}</td>
                                        <td>{{admin.created_at}}</td>
                                        <td>
                                            <router-link :to="'/admin/admin/edit/'+admin.id" class="btn btn-warning"><i
                                                    class="fa fa-edit"></i></router-link>
                                            <a @click="onDelete(admin.id,admin.name)" class="btn btn-danger"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            <pagination :data="admins" @pagination-change-page="getResult">
                            </pagination>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <form @submit.prevent="createadmin">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="  exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="email" name="email" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Mot de pass</label>
                                <input v-model="form.password" type="password" name="password" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" class="btn btn-primary" value="AJouter" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script type="text/javascript">
    import pagination from 'laravel-vue-pagination'

    export default {
        components: {
            pagination
        },
        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                    password: ''
                }),
                admins: {}
            }
        },
        methods: {
            createadmin: function () {
                this.form.post('/admin/admin/all')
            },
            getadmin: function () {
                axios.get('/admin/admin/all').then((response) => {
                    this.admins = response.data.data;
                    console.log('this', this.admins.data)
                })
            },
            getResult: function (page = 1) {
                axios.get('/admin/admin/all?page=' + page).then((response) => {
                    this.admins = response.data.data;
                    console.log('this', this.admins.data)
                })
            },
            onDelete: function (id, admin) {
                if (confirm('do you want delete' + admin)) {
                    axios.delete('/admin/admin/delete/' + id).then((response) => {
                        this.getadmin();
                    }).
                    catch((err) => {

                    })
                }
            }
        },
        created() {
            this.getadmin();
        }
    }

</script>
<style scoped>
i{
    color:#FFF;
}
</style>
