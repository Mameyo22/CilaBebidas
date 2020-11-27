<!--main content start-->
	<section id="main-content">
    	<section class="wrapper">
			<h3>Venta</h3>
			<div class="col-md-8">
				<div class="">
					<input type="search" class="form-control" name="searchtext" id="searchtext" placeholder="utilice el lector de barras">
				</div>
				<br>
			</div>
			<div class="col-md-8">
				<div class="showback ">
					<h4>Items</h4>
					<table id="carrito" class="display table table-striped table-advance table-hover" style="width:100%">
						<thead>
							<th>Cantidad</th>
							<th>Articulo</th>
							<th>Precio U</th>
							<th>Total</th>
							<th>Acciones</th>
						</thead>
						<tbody>
						<?php 
						$total=0;
						foreach($carrito as $item){ 
							$total += $item['cantidad'] * $item['articuloprecio'];
						?>
						<tr>
							<td><?= $item['cantidad'] ?></td>

							<td><?= $item['articulodesc'] ?></td>
							<td>$ <?= number_format($item['articuloprecio'],2) ?></td>
							<td>$ <?= number_format($item['cantidad'] * $item['articuloprecio'],2) ?></td>
							<td>
								<button class="btn btn-default btn_sust" data-id="<?= $item['carritoitem'] ?>" data-cant="<?= $item['cantidad'] ?>" title="Disminuir Cantidad"><i class="fa fa-minus"></i></button>
								<button class="btn btn-default btn_add" data-id="<?= $item['carritoitem'] ?>" data-cant="<?= $item['cantidad'] ?>" title="Aumentar Cantidad"><i class="fa fa-plus"></i></button>
								&nbsp;| &nbsp;
								<button class="btn btn-danger btn_dlt" data-id="<?= $item['carritoitem'] ?>" title="Eliminar"><i class="fa fa-trash"></i> </button>
								
							</td>
						</tr>
						<?php } ?>
						
						</tbody>
					</table>
					
				</div>
			</div>
			<div class="col-md-4">
				<div class="showback">
					<h4>Pago </h4>
					<div class="form-group ">
                    	<label for="total" class="control-label ">Total a Pagar</label>
                   		<input type="text" class="form-control" id="total" value="<?= $total ?> " readonly>
                    </div>
					<div class="form-group ">
                    	<label for="pago" class="control-label ">Su Pago</label>
                      	<input type="number" class="form-control danger" id="pago" min=0.00 value="0">
                    </div>
					<div class="form-group ">
                    	<label for="vuelto"  id="labelvuelto" class="control-label ">Resta Pagar</label>
                      	<input type="text" class="form-control red" id="vuelto"  value="<?= $total ?> " readonly disabled="true">
						<input type="hidden" naem="userid" id="userid" value="<?=  $userid = $_SESSION['logged_in']['userid']; ?>">
                    </div>
					<button class="btn btn-success btn-lg" id="fincompra" disabled>Finalizar Compra</button>
					<button class="btn btn-danger btn-lg" id="vaciar" >Eliminar</button>
				</div>

			</div>
		</section>
	</section>
<script>
$(document).ready(function(){
	var id = 0;
	var total =  0;
	var pago = 0;
	var vuelto = total;
	var userid = $('#userid').val();
	var cantidad = 0;
	 //Llevar el foco al inicio
	 $('#searchtext').focus();

	//Borrar Articulo 
	$('.btn_dlt').click(function(){
        //obtener el id
        id = $(this).attr('data-id');
		console.log('Id a eliminar' + id);
		//eliminar el articulo
		$.post("<?= base_url();?>index.php/cila/del_to_cart/"+id).done(function(data){
                 console.log(data);
			 });
		location.reload(true);
	});

	//Cambio de pago
	$('#pago').change(function(){
		total =  $('#total').val();
		pago = $(this).val();
		vuelto = total - pago;
		console.log('total '+ total + ' vuelto: ' + vuelto);
		if (eval(total) > eval(pago)){
			$('#labelvuelto').html('Resta Pagar');
			$('#vuelto').val(vuelto);
			$('#fincompra').attr('disabled',true);
		}else{
			$('#labelvuelto').html('Vuelto');
			$('#vuelto').val(vuelto * -1);
			$('#fincompra').attr('disabled',false);
		}
	});
	//Finalizar Compra
	$('#fincompra').click(function(){
		//validar que no haya resto a pagar
		if (eval(total) > eval(pago)){
			alert('completar el Pago');
		}else{

			$.post("<?= base_url();?>index.php/cila/clear_cart/"+userid).done(function(data){
                 console.log(data);
			 });
			location.reload(true);
		}

	});

	//Eliminar Compra
	$('#vaciar').click(function(){
			$.post("<?= base_url();?>index.php/cila/clear_cart/"+userid).done(function(data){
                 console.log(data);
			 });
			location.reload(true);
	});

	//agregar añ carrito
	$('#searchtext').change(function(){
		var barcode = $(this).val();
		console.log(barcode);
	
		//Llamar al ajax que agregue un item al carrito
		$.post("<?= base_url();?>index.php/cila/add_to_cart_bc/"+userid+"/"+barcode+"/1",function(data,status) {
			alert("Data: \nStatus: " + status);
		});
		//TODO
		//Cambiar reload por agregar el articulo al DOM
		
		//location.reload(true);
	});
	
	//cambiar cantidad
	$('.btn_sust').click(function(){
		id = $(this).attr('data-id');
		var cantidad = eval($(this).attr('data-cant'));
		if (cantidad > 1){
			cantidad--;
			console.log(id + ' -> ' +cantidad);
			$.post("<?= base_url();?>index.php/cila/upd_to_cart/"+id+"/"+cantidad).done(function(data){
				console.log(data);
			});
		}
		location.reload(true);
	});

	$('.btn_add').click(function(){
		id = $(this).attr('data-id');
		var cantidad = eval($(this).attr('data-cant'));
		cantidad++;
		console.log(id + ' -> ' +cantidad);
		$.post("<?= base_url();?>index.php/cila/upd_to_cart/"+id+"/"+cantidad).done(function(data){
				console.log(data);
			});
		location.reload(true);
	});
	


});
</script>