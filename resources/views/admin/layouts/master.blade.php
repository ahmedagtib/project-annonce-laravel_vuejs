@include('admin.layouts.header')
@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid"> 
      @yield('content')
      </div>
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
    <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Crée par <a href="#">Smartove</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">Smartove</a>.</strong> Tous les droits sont réservés.
  </footer>
</div>
  @include('admin.layouts.footer')
