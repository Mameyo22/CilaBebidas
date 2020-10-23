

    <!-- **********************************************************************************************************************************************************
        Por defecto se muestra la lista de precios
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <section id="cart-shop">
			<div>
				
			</div>
        </section>
		
        <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>      
            <input type="search" id="searchtext" placeholder="Ingrese el texto a buscar ..." class="form-control">
            <hr>
            <table id="arttable" class="display" style="width:100%">
                <thead>
                    <th>Código</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
					<th>BarCode</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php foreach($articulos as $articulo){ ?>
                    <tr>
                        <td><?= $articulo['articuloid']; ?></td>
                        <td><?= $articulo['articulodesc']; ?></td>
                        <td><?= $articulo['articuloprecio']; ?></td>
						<td><?= $articulo['articulobarcode']; ?></td>
                        <td>
							<a href="<?= base_url(); ?>index.php/cila/viewarticulo/<?= $articulo['articuloid']; ?> ">
							<button type="button" class="btn btn-info" data-toggle="tooltip" title="Ver Articulo" id="ver" ?><i class="fa fa-search"></i></button>
							</a>
                            
                            <button type="button" class="btn btn-success btn_cart" data-toggle="modal" data-target="#myModal" title="Agregar a Carrito" id="add" data-id="<?= $articulo['articuloid'] ?>" data-desc="<?= $articulo['articulodesc'] ?>" data-precio="<?= $articulo['articuloprecio'] ?>" ><i class="fa fa-shopping-cart"></i></button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
				<!-- Modal para carrito -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">Agregar Artículo</h4>
						</div>
						<div class="modal-body">
							<div class=""></div>
								<div class="form-group">
									<label for="articulodesc">Articulo</label>
									<input class="form-control" type="text" id="articulodesc" readonly>
								</div>
								<div class="form-group">
									<label for="articuloprecio">Precio</label>
									<input class="form-control" type="text" id="articuloprecio" readonly>
								</div>
								<div class="form-group">
									<label for="cantidad">Cantidad</label>
									<input class="form-control" id="cantidad" name="cantidad" min="1" type="number" required value="1">
								</div>
								<div class="form-group">
									<label for="cantidad">Total</label>
									<input class="form-control" id="total" type="text" readonly>
									<input type="hidden" naem="userid" id="userid" value="<?=  $userid = $_SESSION['logged_in']['userid']; ?>">
								</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" id="agregar">Agregar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>       
    </section>
    </section>
    <!--main content end-->
 

<script>
$(document).ready(function(){
	var articuloid= 0;
	var articulodesc = '';
	var articuloprecio = 0.00;
	var cantidad = 1;
	var total = 0.00;
	var userid = 0;

    var arttable = $('#arttable').DataTable({
		dom: 'Brtip',
		responsive: true,
        buttons: ['copy', 'excel', 'pdf', 'print'],
		"columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false
            }
        ]       
        
    });
    $('.dataTables_filter input').hide();
    //Busqueda
    $('#searchtext').keyup(function(){
      arttable.search($(this).val()).draw() ;
    });
    //Llevar el foco al inicio
    $('#searchtext').focus();


	//Carrito de Compras
	$('.btn_cart').click(function(){
		//obtener el id
		articuloid = $(this).attr('data-id');
		articulodesc = $(this).attr('data-desc');
		articuloprecio = $(this).attr('data-precio');
		total = cantidad * articuloprecio;
		$('#articulodesc').val(articulodesc);
		$('#articuloprecio').val('$ ' + articuloprecio);
		$('#total').val('$ ' + total);

		console.log(articuloid+ ' ' + articulodesc + ' ' + articuloprecio);
		
		userid = $('#userid').val();
		console.log(userid);
		//llamar a la carga del carrito
    });

	$('#cantidad').change(function(){
		cantidad = $(this).val();
		total = cantidad * articuloprecio;
		$('#total').val('$ ' + total);

	});

	//Agregar al carrito
	$('#agregar').click(function(){
		//llamar al evento ajax que graba el carrito
		$.post("<?= base_url();?>index.php/cila/add_to_cart/"+userid+"/"+articuloid + "/" + cantidad).done(function(data){
                 console.log(data);
             });
		//Cerrar el modal
		$("#myModal").modal('hide');
		//actualizar icono de carrito
		location.reload();
	});
});
</script>
 