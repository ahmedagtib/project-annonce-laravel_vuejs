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
		<div class="row">
			<div class="col-md-4" v-for="(annonce, index) in annonces" :key="index">
				<div class="card text-left">
				  <img class="card-img-top" v-if="annonce.imageAnnonce" :src="imageDirectory(annonce.imageAnnonce.name)" alt="">
				  <div class="card-body">
					<h4 class="card-title">{{ annonce.annonce.title }}</h4>
				  </div>
				</div>
			</div>
		</div>
	</div>


</template>
<script type="text/javascript">

	export default{
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

				axios.get('Annonce/all').then(({ data }) => this.annonces = data)

			}
		},
		created() {
			this.getAllAnnonces();
		}
	}

</script>
<style type="text/css">
	
</style>