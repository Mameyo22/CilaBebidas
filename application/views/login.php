<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Cila, Bebidas, Holmberg, Cerveza, Vinos, Kiosco, Cigarrillos, Paladium">
  <title><?= $title ?></title>

  <!-- Favicons -->
  <link href="<?= base_url(); ?>Dashio/img/favicon-32x32.png" rel="icon">
  

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>Dashio/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?= base_url() ?>Dashio/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?= base_url() ?>Dashio/css/style.css" rel="stylesheet">
  <link href="<?= base_url() ?>Dashio/css/style-responsive.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <!-- <form class="form-login" action="index.html"> -->
      <?php echo form_open('login', 'class="form-login"');?>
	  <?php echo validation_errors();?>          
        <h2 class="form-login-heading">CILA Bebidas</h2>
        <div class="login-wrap">
          <input type="text" id="username" class="form-control" placeholder="Usuario" autofocus>
          <br>
          <input type="password" id="userpassword" class="form-control" placeholder="Contraseña">
          <label class="checkbox">
            <span class="pull-right">
            <a data-toggle="modal" href="login.html#myModal"> Olvido su Contraseña?</a>
            </span>
          </label>
        <hr>
          <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Ingresar</button>
        </div>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Olvido su Contraseña?</h4>
              </div>
              <div class="modal-body">
                <p>Ingrese su e-mail para resetear su contraseña.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                <button class="btn btn-theme" type="button">Enviar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal -->
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?= base_url() ?>Dashio/lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>Dashio/lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="<?= base_url() ?>Dashio/lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("<?= base_url() ?>Dashio/img/login-bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>
