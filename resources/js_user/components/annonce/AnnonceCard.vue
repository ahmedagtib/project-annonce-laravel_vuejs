<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3 mb-4">
        <div class="card mb-2">
          <img :src="imgone('three.png')">
          <div class="card-link">
            <a href="#">product</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
export default {
  methods: {
    imgone(imageName) {
      return "/image/slider/" + imageName;
    }
  }
};
</script>
<style scoped="">
.col-md-3 {
  height: 350px;
}
.card {
  position: relative;
  overflow: hidden;
  box-shadow: 0 2px 20px rgba(25, 29, 50, 0.23);
  transition: all 0.3s linear;
  height: 100%;
}
.card .card-link a {
  text-decoration: none;
  color: #fff;
}

.card .card-link {
  position: absolute;
  bottom: 50px;
  color: #fff;
  text-align: center;
  right: 100%;
  width: 100%;
  /*background-color:rgba(255, 165, 0, 0.19);*/
  background-color: rgba(44, 62, 80, 0.52);
  transition: all 0.3s linear;
  padding: 10px 10px;
  text-transform: uppercase;
  letter-spacing: 3px;
}
.card:hover .card-link {
  right: 0;
}
.card img {
  height: 100%;
  transition: all 0.3s linear;
}
.card:hover img {
  transform: scale(1.2);
}
</style>