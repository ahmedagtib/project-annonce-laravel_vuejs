 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('image/digital-campaign.png')}}" alt="annonce" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Annonce</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('image/man.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            Admin
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
            <router-link to="/admin/dashbord" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Panneau
              </p>
            </router-link>
          </li>  
          <li class="nav-item">
            <router-link to="/admin/admin" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Les admins
              </p>
            </router-link>
          </li>   
          <li class="nav-item">
            <router-link to="/admin/user" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
              Utilisateurs
              </p>
            </router-link>
          </li> 
          <li class="nav-item">
            <router-link to="/admin/annonce" class="nav-link">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                Annonces
              </p>
            </router-link>
          </li> 
          <li class="nav-item">
            <router-link  to="/admin/categorie" class="nav-link">
              <i class="nav-icon fas fa-map-signs"></i>
              <p>
                Catégories
              </p>
            </router-link >
          </li> 
           <li class="nav-item">
            <router-link to="/admin/ville" class="nav-link">
              <i class="nav-icon fas fa-map-signs"></i>
              <p>
                Villes
              </p>
            </router-link>
          </li> 
           <li class="nav-item">
            <router-link to="/admin/comment" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
              Commentaires
              </p>
            </router-link>
          </li> 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
              Réglages
              </p>
            </a>
          </li> 
            <li class="nav-item">
            <a href="#" @click.prevent="logout" class="nav-link">
              <i class="nav-icon fa fa-power-off red"></i>
              <p>
              Déconnexion
              </p>
            </a>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>