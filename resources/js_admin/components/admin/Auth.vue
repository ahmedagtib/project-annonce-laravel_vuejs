<template>
    <div>
        <div class="login-logo">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Connectez-vous pour commencer votre session</p>
                <!-- @if(Session::has('error')) -->
                <div class="alert alert-danger">
                    <!-- {{Session::get('error')}} -->
                </div>

                <!-- @endif -->
                <form @submit.prevent="login">
                    <!-- @csrf -->
                    <div class="input-group mb-3">
                        <input v-model="form.email" type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <span class="fa fa-envelope input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input v-model="form.password" type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="checkbox icheck">
                                <label>
                                    <input v-model="form.rememberMe" type="checkbox" name="rememberme">Se souvenir moi
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Se connecter</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
      data() {
        return {
          loginUrl: '/admin/login',
          form: new Form({
            email:'',
            password: '',
            rememberMe: false
          }),
          error: ''
        }
      },
      methods: {
        login() {
            this.$store.dispatch('login')
            this.form.post(this.loginUrl).then((res) => {
              console.log(res);
              if(res.data.login == 'true') {
                  this.$store.commit('loginSuccess', res)
                  window.location.replace('admin')
              } else {
                  this.error = 'Email ou mot de pass sont incorect'
              }
          }).catch(() => {

          })

        }
      }
    }

</script>
