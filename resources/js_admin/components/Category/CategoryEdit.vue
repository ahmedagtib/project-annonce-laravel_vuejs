<template>
    <div class="contanier">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        mettre à jour une Catégorie
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="updatecat">
                            <div class="form-group">
                                <label>Nom</label>
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <input type="submit" class="btn btn-primary" value="mettre à jour" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    export default {
        data() {
            return {
                form: new Form({
                    name: '',
                })

            }
        },
        methods: {
            updatecat: function () {
                const id = this.$route.params.id;
                this.form.put('/admin/Categorie/update/' + id).then((response) => {

                }).catch((err) => {

                });
            }
        }
    }

</script>
<style>
</style>
