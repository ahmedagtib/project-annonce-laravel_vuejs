<template>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>annonce</h1>
			</div>
			<div class="col-md-6">
		 	 	<router-link to="/admin/addAnnonce" class="btn btn-primary float-right">Add Annonce</router-link>
			</div>
		</div>
		<div class="row table-responsive">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Image</th>
					<th>Ville Id</th>
					<th>Categorie id</th>
					<th>Slug</th>
					<th>Titre</th>
					<th>Description</th>
					<th>détaille</th>
					<th>Type</th>
					<th>Stuts</th>
					<th>Prix</th>
				</tr>
				<tr v-for="(annonce, index) in annonces.data" :key="index">
					<td>{{ annonce.id }}</td>
					<td>
						<img width="40" class="image-responsive" v-if="annonce.images[0]" :src="imageDirectory(annonce.images[0].name)" alt="">
					</td>
					<td>{{ annonce.ville_id }}</td>
					<td>{{ annonce.categorie_id }}</td>
					<td>{{ annonce.slug }}</td>
					<td>{{ annonce.title }}</td>
					<td>{{ annonce.description.substr(0,20) }}</td>
					<td>{{ annonce.detaille }}</td>
					<td>{{ annonce.type }}</td>
					<td>{{ annonce.stuts }}</td>
					<td>{{ annonce.prix }}</td>
					<td>
						<router-link :to="'/admin/annonce/edit/'+ annonce.id" class="btn btn-primary">
							<i class="fa fa-pen"></i>
						</router-link>
					</td>
					<td>
						<!-- <router-link class="btn btn-primary">
							<i class="fa fa-pen"></i>
						</router-link> -->
					</td>
				</tr>
			</table>		
		</div>
		<pagination :data="annonces" @pagination-change-page="getResult">
		</pagination>
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
				annonces:{}
			}

		},
		methods: {
			imageDirectory(imageName) {
				return '/image/annonce/' + imageName
			},
			getAllAnnonces() {

				axios.get('/admin/Annonce/all').then(({ data }) => this.annonces = data)

			},
			getResult(page = 1) {

				axios.get('/admin/Annonce/all?page=' + page).then(({ data }) => this.annonces = data)

			}
		},
		updated() {
			console.log(this.annonces)
		},
		created() {
			this.getAllAnnonces();
		}
	}

</script>
<style type="text/css">
	
</style>