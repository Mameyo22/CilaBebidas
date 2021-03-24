<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>CILA Bebidas :: <?= $title ?></title>

  <!-- Favicons -->
  <link href="<?= base_url(); ?>Dashio/img/favicon-32x32.png" rel="icon">
  

  <!-- Bootstrap core CSS -->
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="<?= base_url(); ?>Dashio/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?= base_url(); ?>Dashio/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?= base_url(); ?>Dashio/css/style.css" rel="stylesheet">
  <link href="<?= base_url(); ?>Dashio/css/style-responsive.css" rel="stylesheet">
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>

  <!-- DataTable-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<!-- Obtener datos del carrito -->
<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="<?= base_url();?>" class="logo"><b>CILA<span> Bebidas</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-shopping-cart"></i>
             	<span class="badge bg-important" id="badge_cart">0</span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green">Detalle</p>
              </li>
              <div id="detalle"></div>
				<li>
					<a href="<?= base_url();?>index.php/cila/view_cart">
						<div class="task-total">
							<div class="desc">Total</div>
							<div class="total" id="totalH"> </div>
						</div>
					</a>
              	</li>

            </ul>
          </li>
          <!-- settings end -->
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="<?= base_url();?>index.php/cila/logout">Salir</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
<script>
  $(document).ready(function(){

    function refresh_icon_cart(){
    	//Actualizar el icono del carrito
      var html="";
	  	//Obtener el detalle del carrito
		  $.get("<?= base_url();?>index.php/cila/ajax_cart",function(data){
			  var response = JSON.parse(data);
			  $('#badge_cart').html(response.length);
        //rellenar la tabla detalle
        var i;
        var total = 0;
        
        for(i=0; i < response.length; i++){
					
          total += response[i].cantidad * response[i].articuloprecio;

					html += '<li>';
					html += '<a href="<?= base_url();?>index.php/cila/view_cart">';
					html += '<div class="task-info">';
					html += '<div class="desc">'+ response[i].cantidad +' -  '+ response[i].articulodesc +'</div>';
					html += '<div class="percent">  $ '+ response[i].cantidad * response[i].articuloprecio +' </div>'
					html += '</div>';
					html += '</a></li>';

        }
        $('#detalle').html(html);
        $('#totalH').html(parseFloat(total).toFixed(2));

		  });
	  }
    
    refresh_icon_cart();

  });
</script>