@include('admin.layouts.header')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Connectez-vous pour commencer votre session</p>
         @if(Session::has('error'))
         <div class="alert alert-danger">
           {{Session::get('error')}}
         </div>

         @endif

      <form action="{{url('/admin/login')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
              <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="rememberme" value="1">Se souvenir moi
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

     
      <!-- /.social-auth-links -->
<!--  
      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p> -->
    </div>
  
  </div>
</div>


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
@include('admin.layouts.footer')


