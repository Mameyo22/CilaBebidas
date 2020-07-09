    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="<?= base_url()?>Dashio/img/users/usr-1.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">Administrador</h5>

          <!-- Menu -->
          <li class="mt">
            <a class="<?= ($active == 1?'active':''); ?>" href="<?= base_url();?> ">
              <i class="fa fa-dollar"></i>
              <span>Lista de Precios</span>
              </a>
          </li>
          <li>
            <a class="<?= ($active == 2?'active':''); ?>" href="<?= base_url();?>index.php/cila/users">
              <i class="fa fa-users"></i>
              <span>Usuarios</span>
              </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->