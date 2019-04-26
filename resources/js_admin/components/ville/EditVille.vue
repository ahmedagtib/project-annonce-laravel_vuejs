<template>
    <div class="contanier">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        mettre à jour d'une ville
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="updateville">
                            <div class="form-group">
                                <label>Nom</label>
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Mettre à jour" />
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
            updateville: function () {
                const id = this.$route.params.id;
                this.form.put('/admin/ville/update/' + id).then((response) => {

                }).catch((err) => {

                });
            }
        }
    }

</script>
<style>
</style>
