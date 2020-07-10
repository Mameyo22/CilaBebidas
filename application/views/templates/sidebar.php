    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php 
      //recuperar info de sesion
      $userid = $_SESSION['logged_in']['userid'];
      $username = $_SESSION['logged_in']['username'];
      $isadmin = $_SESSION['logged_in']['isAdmin'];
      $url_pic = $_SESSION['logged_in']['picture'];
      if (!isset($active)){
        $active = 1;
      }
    ?>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="<?= base_url()?>Dashio/img/users/<?= $url_pic; ?>" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?= $username; ?></h5>

          <!-- Menu -->
          <li class="mt">
            <a class="<?= ($active == 1?'active':''); ?>" href="<?= base_url();?> ">
              <i class="fa fa-dollar"></i>
              <span>Lista de Precios</span>
              </a>
          </li>
          <li class="sub-menu dcjq-parent-li"> 
            <a class="<?= ($active != 1?'active':''); ?> dcjq-parent" href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Maestros</span>
              <span class="dcjq-icon"></span>
            </a>
            <ul class="sub" style="display: block;">
              <li class="<?= ($active == 2?'active':''); ?>"><a href="<?= base_url();?>index.php/cila/articulos">Articulos</a></li>
              <li class="<?= ($active == 3?'active':''); ?>"><a href="<?= base_url();?>index.php/cila/users">Usuarios</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->